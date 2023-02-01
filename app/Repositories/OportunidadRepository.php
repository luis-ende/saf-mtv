<?php

namespace App\Repositories;

use RoachPHP\Roach;

use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;
use App\Spiders\ConvocatoriasOportunidadesSpider;
use Illuminate\Database\Eloquent\Collection;

/**
 * Clase para extraer convocatorias de la página de concurso digital o de alguna otra fuente de datos establecida.
 */
class OportunidadRepository
{
    public const BUSQUEDA_OPORTUNIDADES_PAGINATION_OFFSET = 30;

    public function obtieneRubros() 
    {
        return DB::table('cat_capitulos')->select('id', 'numero', 'nombre')->get();
    }

    public function obtieneTiposContratacion() 
    {
        return DB::table('cat_tipos_contratacion')->select('id', 'tipo')->get();
    }

    public function obtieneMetodosContratacion() 
    {
        return DB::table('cat_metodos_contratacion')->select('id', 'metodo')->get();
    }

    public function obtieneEtapasProcedimiento()
    {
        return DB::table('cat_etapas_procedimiento')->select('id', 'etapa')
                                                          ->orderBy('secuencia')
                                                          ->get();
    }

    public function obtieneEstatusContratacion()
    {
        return DB::table('cat_estatus_contratacion')->select('id', 'estatus')->get();
    }

    public function obtieneInstitucionesCompradoras()
    {
        return DB::table('cat_unidades_compradoras')->select('id', 'nombre')->get();
    }

    public function buscarOportunidadesNegocio(?string $terminoBusqueda = null, ?int $userId, array $filtros = [], int $offset = 0) 
    {
        $query = OportunidadNegocio::from('oportunidades_negocio AS opn')
                                        ->select('opn.id', 'opn.nombre_procedimiento', 'opn.fecha_publicacion', 
                                                 'opn.fecha_presentacion_propuestas', 'opn.id_etapa_procedimiento',
                                                 'opn.id_unidad_compradora', 'uc.nombre AS unidad_compradora',
                                                 'ec.estatus AS estatus_contratacion', 'tc.tipo as tipo_contratacion',
                                                 'mc.metodo AS metodo_contratacion', 'etp.etapa as etapa_procedimiento',
                                                 'etp.secuencia as etapa_secuencia')
                                        ->leftJoin('cat_unidades_compradoras AS uc', 'uc.id', 'opn.id_unidad_compradora')
                                        ->leftJoin('cat_estatus_contratacion AS ec', 'ec.id', 'opn.id_estatus_contratacion')
                                        ->leftJoin('cat_tipos_contratacion AS tc', 'tc.id', 'opn.id_tipo_contratacion')
                                        ->leftJoin('cat_metodos_contratacion AS mc', 'mc.id', 'opn.id_metodo_contratacion')
                                        ->leftJoin('cat_etapas_procedimiento AS etp', 'etp.id', 'opn.id_etapa_procedimiento');
        
        if ($userId) {
            $opnClass = OportunidadNegocio::class;
            $query = $query->addSelect(DB::raw("EXISTS((SELECT 1 FROM markable_bookmarks AS mb " . 
                                               "WHERE mb.markable_id = opn.id " .
                                               "AND mb.markable_type = '{$opnClass}' " . 
                                               "AND mb.user_id = {$userId})) AS alerta_estatus"));
        } else {
            $query = $query->addSelect(DB::raw('false AS alerta_estatus'));
        }

        if (isset($filtros['unidad_compradora_filtro'])) {
            $unidadesCompr = $filtros['unidad_compradora_filtro'];

            $query = $query->where(function($query) use($unidadesCompr) {
                $query->whereIn(DB::raw('opn.id_unidad_compradora'), $unidadesCompr);
            });
        }

        if (isset($filtros['tipo_contr_filtro'])) {
            $tiposContr = $filtros['tipo_contr_filtro'];

            $query = $query->where(function($query) use($tiposContr) {
                $query->whereIn(DB::raw('opn.id_tipo_contratacion'), $tiposContr);
            });
        }

        if (isset($filtros['metodo_contr_filtro'])) {
            $metodosContr = $filtros['metodo_contr_filtro'];

            $query = $query->where(function($query) use($metodosContr) {
                $query->whereIn(DB::raw('opn.id_metodo_contratacion'), $metodosContr);
            });
        }        

        if (isset($filtros['etapa_proc_filtro'])) {
            $etapasProc = $filtros['etapa_proc_filtro'];

            $query = $query->where(function($query) use($etapasProc) {
                $query->whereIn(DB::raw('opn.id_etapa_procedimiento'), $etapasProc);
            });
        }        

        if (isset($filtros['estatus_contr_filtro'])) {
            $estatusContr = $filtros['estatus_contr_filtro'];

            $query = $query->where(function($query) use($estatusContr) {
                $query->whereIn(DB::raw('opn.id_estatus_contratacion'), $estatusContr);
            });
        }        

        if ($terminoBusqueda) {
            $query = $query->where(function ($orQuery) use($terminoBusqueda) {
                $orQuery->orWhere(DB::raw('LOWER(opn.nombre_procedimiento)'), 
                                          'like', 
                                          '%' . strtolower($terminoBusqueda) . '%');
            });
        }
        
        // TODO Sólo debe haber un trimestre seleccionado
        // TODO Si existe un trimestre seleccionado los filtros de fecha inicio y fecha fin no se toman en cuenta y visceversa


        if (isset($filtros['fecha_inicio_filtro'])) {
            $fechaInicio = $filtros['fecha_inicio_filtro'];
            $query = $query->where(function ($orQuery) use($fechaInicio) {
                $orQuery->orWhere('opn.fecha_publicacion', '>=', $fechaInicio);
            });
        }      
        
        if (isset($filtros['fecha_final_filtro'])) {
            $fechaFin = $filtros['fecha_final_filtro'];
            $query = $query->where(function ($orQuery) use($fechaFin) {
                $orQuery->orWhere('opn.fecha_publicacion', '<=', $fechaFin);
            });                
        }

        // Aplicar ordenamientos
        $query->orderByDesc('opn.fecha_publicacion');
        $query->orderBy('etp.secuencia');

        // Paginación
        $query = $query->offset($offset)
                       ->limit(self::BUSQUEDA_OPORTUNIDADES_PAGINATION_OFFSET);        
                    
        $oportunidades = $query->get();

        return $oportunidades;
    }

    /**
     * Calcula las estadísticas de un conjunto de oportunidades.
     * Usado en el header del buscador de oportunidades.
     */
    public function obtieneEstadisticas(Collection $oportunidades): array 
    {        
        $etapas = DB::table('cat_etapas_procedimiento')->select('id', 'etapa')
                                                             ->orderBy('secuencia')
                                                             ->get();
        $estadisticas = [
            'conteo_etapas' => [],
        ];
        foreach($etapas as $row) {
            $etapaId = $row->id;
            $estadisticas['conteo_etapas'][$etapaId] = [
                'nombre_etapa' => $row->etapa,
                'conteo' => $oportunidades->reduce(function($carry, $op) use($etapaId) {
                    if ($op->id_etapa_procedimiento === $etapaId) {
                        return $carry + 1;
                    }

                    return $carry;
                }, 0),
            ];
        }

        $unidadesCompradoras = $oportunidades->unique('id_unidad_compradora');
        $estadisticas['conteo_dependencias'] = $unidadesCompradoras->values()->count();
                
        return $estadisticas;
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

    private function validaTrimestres(array $filtros)  {

    }
}