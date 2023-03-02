<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Query\Expression;
use App\Services\CalculadoraFechasService;

/**
 * Clase repositorio para oportunidades de negocio.
 */
class OportunidadNegocioRepository
{
    public const BUSQUEDA_OPORTUNIDADES_PAGINATION_OFFSET = 30;

    public function obtieneRubros() 
    {
        return Cache::rememberForever('cat_capitulos', function() {
            return DB::table('cat_capitulos')->select('id', 'numero', 'nombre')->get();
        });
    }

    public function obtieneTiposContratacion(): Collection
    {
        return Cache::rememberForever('cat_tipos_contratacion', function() {
            return DB::table('cat_tipos_contratacion')->select('id', 'tipo')->get();
        });                
    }

    public function obtieneMetodosContratacion() 
    {
        return Cache::rememberForever('cat_metodos_contratacion', function() {
            return DB::table('cat_metodos_contratacion')->select('id', 'metodo')->get();
        });        
    }

    public function obtieneEtapasProcedimiento()
    {
        return Cache::rememberForever('cat_etapas_procedimiento', function() {
            return DB::table('cat_etapas_procedimiento')->select('id', 'etapa')
                                                        ->orderBy('secuencia')
                                                        ->get();
        });        
    }

    public function obtieneEstatusContratacion()
    {
        return Cache::rememberForever('cat_estatus_contratacion', function() {
            return DB::table('cat_estatus_contratacion')->select('id', 'estatus')->get();
        });        
    }

    public function obtieneInstitucionesCompradoras(bool $cached = true)
    {
        if ($cached) {
            return Cache::rememberForever('cat_unidades_compradoras', function() {
                return DB::table('cat_unidades_compradoras')->select('id', 'nombre')
                                                                  ->orderBy('nombre')
                                                                  ->get();
            });        
        } else {
            return DB::table('cat_unidades_compradoras')->select('id', 'nombre')
                                                              ->orderBy('nombre')
                                                              ->get();
        }
    }

    /**
     * Obtiene un arreglo de números iniciales de los capítulos filtrados.
     */
    public function obtieneCapitulosNumeros(array $capituloFiltros): array 
    {
        $capitulos = Cache::rememberForever('cat_capitulos_numeros', function() {
            return DB::table('cat_capitulos')
                    ->select('id', DB::raw('SUBSTRING(numero, 1, 1) AS num_capitulo'))
                    ->get();
        });       

        return $capitulos->filter(function($c) use($capituloFiltros) {
                                    return in_array($c->id, $capituloFiltros);
                                  })
                         ->map(function($c) { return $c->num_capitulo; })
                         ->toArray();
    }

    public function buscarOportunidadesNegocio(?string $terminoBusqueda = null, ?int $userId, array $filtros = [], int $offset = 0) 
    {
        $querySelectNumBookmarks = self::subqueryOportunidadBookmarks();

        $query = OportunidadNegocio::from('oportunidades_negocio AS opn')
                                    ->select('opn.id', 'opn.nombre_procedimiento', 'opn.fecha_publicacion', 
                                             'opn.fecha_presentacion_propuestas', 'opn.id_etapa_procedimiento',
                                             'opn.fuente_url', 'opn.id_unidad_compradora', 'opn.partidas',
                                             DB::raw("SUBSTRING((STRING_TO_ARRAY(partidas, ','))[1], 1, 1) || '000' AS capitulo"),
                                             'uc.nombre AS unidad_compradora',
                                             'ec.estatus AS estatus_contratacion', 'tc.tipo as tipo_contratacion',
                                             'mc.metodo AS metodo_contratacion', 'etp.etapa as etapa_procedimiento',
                                             'etp.secuencia as etapa_secuencia', $querySelectNumBookmarks)
                                    ->leftJoin('cat_unidades_compradoras AS uc', 'uc.id', 'opn.id_unidad_compradora')
                                    ->leftJoin('cat_estatus_contratacion AS ec', 'ec.id', 'opn.id_estatus_contratacion')
                                    ->leftJoin('cat_tipos_contratacion AS tc', 'tc.id', 'opn.id_tipo_contratacion')
                                    ->leftJoin('cat_metodos_contratacion AS mc', 'mc.id', 'opn.id_metodo_contratacion')
                                    ->leftJoin('cat_etapas_procedimiento AS etp', 'etp.id', 'opn.id_etapa_procedimiento');
        
        if ($userId) {
            $opnClass = OportunidadNegocio::class;
            // Seleccionar si el usuario tiene una alerta (bookmark) en la oportunidad de negocio
            $query = $query->addSelect(DB::raw("EXISTS((SELECT 1 FROM markable_bookmarks AS mb " . 
                                               "WHERE mb.markable_id = opn.id " .
                                               "AND mb.markable_type = '{$opnClass}' " . 
                                               "AND mb.user_id = {$userId})) AS alerta_estatus"));            
        } else {
            $query = $query->addSelect(DB::raw('false AS alerta_estatus'));
        }

        if (isset($filtros['unidad_compradora_filtro'])) {
            $unidadesCompr = $filtros['unidad_compradora_filtro'];
            // Unidad compradora = 0 equivale a la opción de filtro "Todos"
            if (!in_array("0", $unidadesCompr, true)) {
                $query = $query->where(function($query) use($unidadesCompr) {
                    $query->whereIn(DB::raw('opn.id_unidad_compradora'), $unidadesCompr);
                });
            }
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

        if (isset($filtros['capitulo_filtro'])) {
            $capitulos = $this->obtieneCapitulosNumeros($filtros['capitulo_filtro']);

            $query = $query->where(function($orQuery) use($capitulos) {                
                $orQuery->orWhereIn(DB::raw('SUBSTRING(opn.partidas, 1, 1)'), $capitulos);
            });
        }

        if ($terminoBusqueda) {
            $query = $query->where(function ($orQuery) use($terminoBusqueda) {
                $orQuery->orWhere(DB::raw('LOWER(opn.nombre_procedimiento)'), 
                                          'like', 
                                          '%' . strtolower($terminoBusqueda) . '%');
            });
        }

        // Si existe un trimestre seleccionado los filtros de fecha inicio y fecha fin corresponden al inicio y fin del trimestre
        $filtros_fechas = $this->obtieneFiltroRangoFechas($filtros);

        if (isset($filtros_fechas['fecha_inicio'])) {
            $fechaInicio = $filtros_fechas['fecha_inicio'];
            $query = $query->where(function ($orQuery) use($fechaInicio) {
                $orQuery->orWhere('opn.fecha_publicacion', '>=', $fechaInicio);
            });
        }      
        
        if (isset($filtros_fechas['fecha_final'])) {
            $fechaFin = $filtros_fechas['fecha_final'];
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

        //dd($query->toSql());
                    
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
                'id' => $etapaId,
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
     * Optiene expresión de subquery para obtener el número de bookmarks de oportunidades de negocio.
     */
    public static function subqueryOportunidadBookmarks(string $tableAlias = 'opn'): Expression
    {
        $opnClass = OportunidadNegocio::class;
        return DB::raw("(SELECT COUNT(markable_id) FROM markable_bookmarks " . 
                       "WHERE markable_id = {$tableAlias}.id AND markable_type = '{$opnClass}') AS num_bookmarks");
    }

    /**
     * Devuelve el rango de fechas a utilizar para el filtro.
     * Si existe un trimestre seleccionado, el rango de fechas corresponde al inicio y fin del trimestre.
     * Si no existe un trimestre seleccionado, se toman los filtros de Fecha inicial y Fecha final.
     */
    private function obtieneFiltroRangoFechas(array $filtros): array
    {
        $rangoFechas = [];
        $trimestre = 0;

        // Buscar trimestre seleccionado si existe
        for($t = 1; $t <= 4; $t++) {
            if (array_key_exists("fecha_trimestre{$t}_filtro", $filtros)
                && $filtros["fecha_trimestre{$t}_filtro"]) {
                $trimestre = $t;

                break;
            }
        }

        if ($trimestre !== 0) {
            $anio = (int)Carbon::now()->format('Y'); // Trimestres del año en curso
            $rangoFechas = CalculadoraFechasService::calculaRangoFechasTrimestre($trimestre, $anio);
        } else {
            if (isset($filtros['fecha_inicio_filtro'])) {
                $fechaInicio = $filtros['fecha_inicio_filtro'];
                $rangoFechas['fecha_inicio'] = $fechaInicio;
            }

            if (isset($filtros['fecha_final_filtro'])) {
                $fechaFin = $filtros['fecha_final_filtro'];
                $rangoFechas['fecha_final'] = $fechaFin;
            }
        }

        return $rangoFechas;
    }        
}