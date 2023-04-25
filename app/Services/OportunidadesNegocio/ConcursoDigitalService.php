<?php declare(strict_types = 1);

namespace App\Services\OportunidadesNegocio;

use App\Models\EtapaProcedimiento;
use App\Models\MetodoContratacion;
use App\Models\TipoContratacion;
use App\Models\UnidadCompradora;
use App\Services\Traits\BusquedaUnidadDeCompra;
use Carbon\Carbon;
use RoachPHP\Roach;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;
use App\Models\EstatusContratacion;
use App\Spiders\ConvocatoriasOportunidadesSpider;


/**
 * Clase para procesar la extracción de oportunidades de negocio provienientes de la página de Concurso Digital (convocatorias), 
 * correspondiente a la etapa "Licitaciones en proceso" en MTV.
 * 
 * Ver: https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas
 */
class ConcursoDigitalService 
{
    use BusquedaUnidadDeCompra;

    /**
     * Importa concursos a la tabla de oportunidades_negocio de MTV.
     */
    public function importaOportunidadesNegocio(array $convocatorias): void
    {
        $tipoContratacionBien = DB::table('cat_tipos_contratacion')->where('tipo', TipoContratacion::AdquisicionBienes->value)->value('id');
        $tipoContratacionServicio = DB::table('cat_tipos_contratacion')->where('tipo', TipoContratacion::PrestacionServicios->value)->value('id');
        $tipoMetodoContratacionLP = DB::table('cat_metodos_contratacion')->where('metodo', MetodoContratacion::LicitacionPublica->value)->value('id');
        $tipoMetodoContratacionIR = DB::table('cat_metodos_contratacion')->where('metodo', MetodoContratacion::InvitacionRestringida->value)->value('id');
        $etapaLicEnProc = DB::table('cat_etapas_procedimiento')->where('etapa', EtapaProcedimiento::LicitacionEnProceso->value)->value('id');
        $estatusContrVigente = DB::table('cat_estatus_contratacion')->where('estatus', EstatusContratacion::ESTATUS_CONTRATACION_VIGENTE)->value('id');
        $estatusContrCerrado = DB::table('cat_estatus_contratacion')->where('estatus', EstatusContratacion::ESTATUS_CONTRATACION_FINALIZADO)->value('id');
        
        foreach($convocatorias as $convocatoria) {
            $fechaPublicacion = $convocatoria['fecha_publicacion'] ?
                Carbon::createFromFormat('Y-m-d', substr($convocatoria['fecha_publicacion'], 0, 10)) :
                Carbon::now();
            $fechaPresentacionP = $convocatoria['fecha_presentacion_propuestas'] ?
                Carbon::createFromFormat('Y-m-d', substr($convocatoria['fecha_presentacion_propuestas'], 0, 10)) :
                Carbon::now();

            $unidadCompraId = $this->buscaUnidadCompraHomologada($convocatoria['entidad_convocante']);
//            $unidadCompradoraId = DB::table('cat_unidades_compradoras')->where('nombre', $convocatoria['entidad_convocante'])->value('id');
//            if (is_null($unidadCompradoraId)) {
//                $uc = UnidadCompradora::create([
//                    'nombre' => $convocatoria['entidad_convocante'],
//                ]);
//                $unidadCompradoraId = $uc->id;
//            }

            $convData = [
                'fecha_presentacion_propuestas' => $fechaPresentacionP,
                'id_unidad_compradora' => $unidadCompraId,
                'id_tipo_contratacion' => $convocatoria['tipo_contratacion'] === 'Adquisición de Bienes' ? $tipoContratacionBien : $tipoContratacionServicio,
                'id_metodo_contratacion' => $convocatoria['metodo_contratacion'] === 'Licitación Pública' ?  $tipoMetodoContratacionLP : $tipoMetodoContratacionIR,
                'id_estatus_contratacion' => $estatusContrVigente,
                'fuente_url' => $convocatoria['fuente_url'],
                'partidas' => $convocatoria['partidas'] ?? '',
                'cabms' => $convocatoria['cabms'] ?? '',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (!empty($convocatoria['partidas'])) {
                $convData['partidas'] = $convocatoria['partidas'];
            }

            if (!empty($convocatoria['cabms'])) {
                $convData['cabms'] = $convocatoria['cabms'];
            }

            // Algunas convocatorias aparecen duplicadas, por lo que si ya existe una oportunidad con
            // mismo nombre de procedimiento y fecha de publicación no se agrega de nuevo.
            OportunidadNegocio::updateOrInsert([
                    'nombre_procedimiento' => $convocatoria['nombre_procedimiento'],
                    'fecha_publicacion' => $fechaPublicacion,
                    'id_etapa_procedimiento' => $etapaLicEnProc,
                ],
                $convData,
            );
            
            // Actualizar estatus de oportunidades de negocio con fecha de presentación de propuestas que haya expirado.
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
}