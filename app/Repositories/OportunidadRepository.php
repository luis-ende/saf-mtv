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

    public function buscarOportunidadesNegocio() 
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

        // Aplicar ordenamientos
        $query->orderByDesc('opn.fecha_publicacion');
        $query->orderBy('etp.secuencia');

        return $query->get();
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
}