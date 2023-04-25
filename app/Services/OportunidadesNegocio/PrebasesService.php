<?php declare(strict_types = 1);

namespace App\Services\OportunidadesNegocio;

use App\Models\EtapaProcedimiento;
use App\Models\MetodoContratacion;
use App\Models\TipoContratacion;
use App\Repositories\OportunidadNegocioRepository;
use Carbon\Carbon;
use RoachPHP\Roach;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;
use App\Models\EstatusContratacion;
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
    public function importaOportunidadesNegocio(array $proyectos): void
    {
        $opnRepo = new OportunidadNegocioRepository();

        $etapaPrebasesId = DB::table('cat_etapas_procedimiento')->where('etapa', EtapaProcedimiento::Prebase->value)->value('id');
        $tiposContr = $opnRepo->obtieneTiposContratacion();
        $metodosContr = $opnRepo->obtieneMetodosContratacion();
        $estatusContr = $opnRepo->obtieneEstatusContratacion();

        foreach($proyectos as $proyecto) {
            $fechaPublicacion = $proyecto['fecha_publicacion'] ? 
                                    Carbon::createFromFormat('d/m/Y', substr(trim($proyecto['fecha_publicacion']), 0, 10)) : 
                                    Carbon::now();

            $partidas = null;
            if (!empty($proyecto['partidas'])) {
                // Encontrar y usar solamente los números de partida sin descripciones
                preg_match_all('/\d+/', $proyecto['partidas'], $matches);
                if ($matches[0]) {
                    $partidas = implode(',', $matches[0]);
                }                
            }

            if (strtolower($proyecto['estatus']) === 'abierto') {
                $estatusContrId = $estatusContr->where('estatus', EstatusContratacion::ESTATUS_CONTRATACION_VIGENTE)->value('id');
            } else if (strtolower($proyecto['estatus']) === 'programado') {
                $estatusContrId = $estatusContr->where('estatus', EstatusContratacion::ESTATUS_CONTRATACION_PROGRAMADO)->value('id');
            } else {
                $estatusContrId = $estatusContr->where('estatus', EstatusContratacion::ESTATUS_CONTRATACION_FINALIZADO)->value('id');
            }

            if (strtolower($proyecto['tipo_contratacion']) === 'adquisición de bienes') {
                $tipoContrId = $tiposContr->where('tipo', TipoContratacion::AdquisicionBienes->value)->value('id');
            } else {
                $tipoContrId = $tiposContr->where('tipo', TipoContratacion::PrestacionServicios->value)->value('id');
            }

            $metodoContrId = $metodosContr->where('metodo', MetodoContratacion::LicitacionPublica->value)->value('id');
            if (strtolower($proyecto['metodo_contratacion']) === 'invitación restringida') {
                $metodoContrId = $metodosContr->where('metodo', MetodoContratacion::InvitacionRestringida->value)->value('id');
            }

            // Actualizar solamente si ya existe
            OportunidadNegocio::updateOrInsert([
                    'nombre_procedimiento' => $proyecto['nombre_proyecto'],
                    'fecha_publicacion' => $fechaPublicacion,
                    'id_etapa_procedimiento' => $etapaPrebasesId,
                ],
                [                    
                    'id_unidad_compradora' => DB::table('cat_unidades_compradoras')->where('nombre', $proyecto['ente_publico'])->value('id'),
                    'id_tipo_contratacion' => $tipoContrId,
                    'id_metodo_contratacion' => $metodoContrId,
                    'id_etapa_procedimiento' => $etapaPrebasesId,
                    'id_estatus_contratacion' => $estatusContrId,
                    'partidas' => $partidas,
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