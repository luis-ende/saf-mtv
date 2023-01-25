<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OportunidadRepository;

class OportunidadesController extends Controller
{
    public function index(Request $request, OportunidadRepository $oportunidadesRepo)
    {
        // $oportunidadesRepository = new OportunidadRepository();
        // $convocatorias = $oportunidadesRepository->extraerConvocatorias();
        // $categorias = $oportunidadesRepository->agruparConvocatoriasPorCategoria($convocatorias);
        // $estadisticas = $oportunidadesRepository->obtenerConvocatoriasEstadisticas($convocatorias);

        $filtros_opciones['capitulos'] = $oportunidadesRepo->obtieneRubros();

        return view('oportunidades.show', compact('filtros_opciones'));
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
