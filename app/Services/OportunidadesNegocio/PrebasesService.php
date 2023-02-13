<?php declare(strict_types = 1);

namespace App\Services\OportunidadesNegocio;

use Carbon\Carbon;
use RoachPHP\Roach;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;
use App\Spiders\PrebasesProyectoSpider;
use App\Spiders\PrebasesOportunidadesSpider;
use RoachPHP\Spider\Configuration\Overrides;

/**
 * Clase para procesar la extracción de oportunidades de negocio provienientes de la página de Prepbases (proyectos), 
 * correspondiente a la etapa "Prebases" en MTV.
 * 
 * Ver: https://prebasestianguisdigital.cdmx.gob.mx/
 */
class PrebasesService 
{
/**
     * Importa proyectos de prebases a la tabla de oportunidades_negocio de MTV.
     */
    public function importaOportunidadesNegocio() 
    {
        $proyectos = $this->extraerProyectosPrebases();

        $tipoContratacionBien = DB::table('cat_tipos_contratacion')->where('tipo', 'Adquisición de Bienes')->value('id');
        $tipoContratacionServicio = DB::table('cat_tipos_contratacion')->where('tipo', 'Prestación de Servicios')->value('id');
        $tipoMetodoContratacionLP = DB::table('cat_metodos_contratacion')->where('metodo', 'Licitación pública')->value('id');
        $tipoMetodoContratacionIR = DB::table('cat_metodos_contratacion')->where('metodo', 'Invitación restringida')->value('id');
        $etapaLicEnProc = DB::table('cat_etapas_procedimiento')->where('etapa', 'Prebases')->value('id');
        $estatusContrVigente = DB::table('cat_estatus_contratacion')->where('estatus', 'En proceso')->value('id');
        $estatusContrCerrado = DB::table('cat_estatus_contratacion')->where('estatus', 'Cerrado')->value('id');
        
        foreach($proyectos as $proyecto) {
            $fechaPublicacion = $proyecto['fecha_publicacion'] ? 
                                    Carbon::createFromFormat('d/m/Y', substr(trim($proyecto['fecha_publicacion']), 0, 10)) : 
                                    Carbon::now();            
                
            OportunidadNegocio::updateOrInsert([
                    'nombre_procedimiento' => $proyecto['nombre_proyecto'],
                    'fecha_publicacion' => $fechaPublicacion,
                ],
                [                    
                    'id_unidad_compradora' => DB::table('cat_unidades_compradoras')->where('nombre', $proyecto['ente_publico'])->value('id'),
                    'id_tipo_contratacion' => strtolower($proyecto['tipo_contratacion']) === 'adquisición de bienes' ? $tipoContratacionBien : $tipoContratacionServicio,
                    'id_metodo_contratacion' => strtolower($proyecto['metodo_contratacion']) === 'licitación pública' ?  $tipoMetodoContratacionLP : $tipoMetodoContratacionIR,
                    'id_etapa_procedimiento' => $etapaLicEnProc,
                    'id_estatus_contratacion' => strtolower($proyecto['estatus']) === 'abierto' ? $estatusContrVigente : $estatusContrCerrado,
                    'fuente_url' => $proyecto['fuente_url'],
                    'created_at' => now(),
                    'updated_at' => now(),
            ]);                    
        }    
    }    

    /**
     * Extraer proyectos de prebases desde https://prebasestianguisdigital.cdmx.gob.mx/ via web scrapping.
     */
    public function extraerProyectosPrebases(?string $filtro = null): array 
    {
        Roach::startSpider(PrebasesOportunidadesSpider::class);
        $proyectos = Roach::collectSpider(PrebasesOportunidadesSpider::class);
        $proyectos = $proyectos[0]->all();

        // Obtener datos faltantes de la página de detalle del proyecto Prebases
        Roach::startSpider(PrebasesProyectoSpider::class);
        array_walk($proyectos, function(&$p) {
            $proyectoPrebases = Roach::collectSpider(PrebasesProyectoSpider::class, 
                                                        new Overrides(startUrls: [$p['fuente_url']]));            
            $p = array_merge($p, $proyectoPrebases[0]->all());
        });

        return $proyectos;
    }
}