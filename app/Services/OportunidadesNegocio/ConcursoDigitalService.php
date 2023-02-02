<?php declare(strict_types = 1);

namespace App\Services\OportunidadesNegocio;

use Carbon\Carbon;
use RoachPHP\Roach;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;
use App\Spiders\ConvocatoriasOportunidadesSpider;


/**
 * Clase para procesar oportunidades de negocio provienientes de la página de concurso digital, 
 * correspondiente a la etapa "Licitación en proceso".
 * 
 * Ver: https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas
 */
class ConcursoDigitalService 
{
    /**
     * Importa concursos a la tabla de oportunidades_negocio de MTV.
     */
    public function importaOportunidadesNegocio() 
    {        
        $oportunidades = $this->extraerConvocatorias();
    
        $tipoContratacionBien = DB::table('cat_tipos_contratacion')->where('tipo', 'Adquisición de Bienes')->value('id');
        $tipoContratacionServicio = DB::table('cat_tipos_contratacion')->where('tipo', 'Prestación de Servicios')->value('id');
        $tipoMetodoContratacionLP = DB::table('cat_metodos_contratacion')->where('metodo', 'Licitación pública')->value('id');
        $tipoMetodoContratacionIR = DB::table('cat_metodos_contratacion')->where('metodo', 'Invitación restringida')->value('id');
        $etapaLicEnProc = DB::table('cat_etapas_procedimiento')->where('etapa', 'Licitación en proceso')->value('id');
        $estatusContrVigente = DB::table('cat_estatus_contratacion')->where('estatus', 'En proceso')->value('id');
        $estatusContrCerrado = DB::table('cat_estatus_contratacion')->where('estatus', 'Cerrado')->value('id');
        
        foreach($oportunidades as $oportunidad) {
            $fechaPublicacion = $oportunidad['fecha_publicacion'] ? 
                                    Carbon::createFromFormat('Y-m-d', substr($oportunidad['fecha_publicacion'], 0, 10)) : 
                                    Carbon::now();
            $fechaPresentacionP = $oportunidad['fecha_presentacion_propuestas'] ? 
                                    Carbon::createFromFormat('Y-m-d', substr($oportunidad['fecha_presentacion_propuestas'], 0, 10)) : 
                                    Carbon::now();            
    
            // TODO Abrir transacción
            OportunidadNegocio::updateOrInsert([
                    'nombre_procedimiento' => $oportunidad['nombre_procedimiento'],
                    'fecha_publicacion' => $fechaPublicacion,
                ],
                [
                    'fecha_presentacion_propuestas' => $fechaPresentacionP,
                    'id_unidad_compradora' => DB::table('cat_unidades_compradoras')->where('nombre', $oportunidad['entidad_convocante'])->value('id'),
                    'id_tipo_contratacion' => $oportunidad['tipo_contratacion'] === 'Adquisición de Bienes' ? $tipoContratacionBien : $tipoContratacionServicio,
                    'id_metodo_contratacion' => $oportunidad['metodo_contratacion'] === 'LP - Licitación Pública' ?  $tipoMetodoContratacionLP : $tipoMetodoContratacionIR,
                    'id_etapa_procedimiento' => $etapaLicEnProc,
                    'id_estatus_contratacion' => $estatusContrVigente,
            ]);
            
            // Actualizar estatus de oportunidades de negocio con fecha de presentación de propuestas haya transcurrido.
            DB::table('oportunidades_negocio')->where('fecha_presentacion_propuestas', '<=', Carbon::now())
                                              ->update(['id_estatus_contratacion' => $estatusContrCerrado]);
        }    
    }

    /**
     * Extraer concursos de https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas via Webscrapping.
     */
    public function extraerConvocatorias(?string $filtro = null): array
    {
        Roach::startSpider(ConvocatoriasOportunidadesSpider::class);
        $convocatorias = Roach::collectSpider(ConvocatoriasOportunidadesSpider::class);
        $convocatorias = $convocatorias[0]->all();

        if ($filtro && $filtro !== '') {
            $convocatorias = array_filter($convocatorias, function($c) use($filtro) {
                return str_contains(strtolower($c['nombre_procedimiento']), strtolower($filtro));
            });
        }

        return $convocatorias;
    }

    /**
     * Obtiene convocatorias agrupadas por Entidad convocante.
     */
    public function agruparConvocatoriasPorCategoria(array $convocatorias): array
    {
        $categorias = [];        
        foreach($convocatorias as $convocatoria) {
            $categorias[$convocatoria['entidad_convocante']][] = $convocatoria;            
        }

        return $categorias;        
    }

    /**
     * Obtiene número de convocatorias por método de contratación.
     */
    public function obtenerConvocatoriasEstadisticas(array $convocatorias) 
    {
        $numInvRestringidas = 0;
        $numAdjDirectas = 0;
        $numLicitacionesPublicas = 0;
        foreach($convocatorias as $convocatoria) {
            $categorias[$convocatoria['entidad_convocante']][] = $convocatoria;
            if ($convocatoria['metodo_contratacion'] === 'Invitación restringida') {
                $numInvRestringidas++;
            }
            if ($convocatoria['metodo_contratacion'] === 'Adjudicación directa') {
                $numAdjDirectas++;
            }
            if ($convocatoria['metodo_contratacion'] === 'LP - Licitación Pública') {
                $numLicitacionesPublicas++;
            }
        }

        return [
            'procedimientos_proximos' => count($convocatorias),
            'invitaciones_restringidas' => $numInvRestringidas,
            'adjudicaciones_directas' => $numAdjDirectas,
            'licitaciones_publicas' => $numLicitacionesPublicas,
        ];
    }    
}