<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OportunidadRepository;

class OportunidadesController extends Controller
{
    public function index(Request $request, OportunidadRepository $oportunidadesRepo)
    {
        //$oportunidadesRepository = new OportunidadRepository();
        //$oportunidades = $oportunidadesRepository->extraerConvocatorias();
        // $categorias = $oportunidadesRepository->agruparConvocatoriasPorCategoria($convocatorias);
        // $estadisticas = $oportunidadesRepository->obtenerConvocatoriasEstadisticas($convocatorias);

        $oportunidades = [1, 2, 3, 4, 5, 6, 7, 8, 9];

        $filtros_opciones['capitulos'] = $oportunidadesRepo->obtieneRubros();
        $filtros_opciones['unidades_compradoras'] = $oportunidadesRepo->obtieneInstitucionesCompradoras();
        $filtros_opciones['tipos_contratacion'] = $oportunidadesRepo->obtieneTiposContratacion();
        $filtros_opciones['metodos_contratacion'] = $oportunidadesRepo->obtieneMetodosContratacion();
        $filtros_opciones['etapas_procedimiento'] = $oportunidadesRepo->obtieneEtapasProcedimiento();
        $filtros_opciones['estatus_contratacion'] = $oportunidadesRepo->obtieneEstatusContratacion();

        return view('oportunidades.show', compact('filtros_opciones', 'oportunidades'));
    }

    public function search(Request $request) 
    {            
        $oportunidadesRepository = new OportunidadRepository();
        $convocatorias = $oportunidadesRepository->extraerConvocatorias($request->input('oportunidades-search'));
        $categorias = $oportunidadesRepository->agruparConvocatoriasPorCategoria($convocatorias);
        $estadisticas = $oportunidadesRepository->obtenerConvocatoriasEstadisticas($convocatorias);        

        return view('oportunidades.show', [
            'term_busqueda' => $request->input('oportunidades-search'),
            'num_resultados' => count($convocatorias),
            'categorias' => $categorias,
            'entidades_convocantes' => count($categorias),
            ...$estadisticas,
        ]);
    }    
}
