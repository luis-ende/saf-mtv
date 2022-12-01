<?php

namespace App\Repositories;

use RoachPHP\Roach;

use App\Spiders\ConvocatoriasOportunidadesSpider;

/**
 * Clase para extraer convocatorias de la página de concurso digital o de alguna otra fuente de datos establecida.
 */
class OportunidadRepository
{
    /**
     * Extraer concursos de https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas
     */
    public function extraerConvocatorias(?string $filtro = null): array
    {
        Roach::startSpider(ConvocatoriasOportunidadesSpider::class);
        $convocatorias = Roach::collectSpider(ConvocatoriasOportunidadesSpider::class);
        $convocatorias = $convocatorias[0]->all();

        if ($filtro && $filtro !== '') {
            $convocatorias = array_filter($convocatorias, function($c) use($filtro) {
                return str_contains($c['nombre_procedimiento'], $filtro);
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