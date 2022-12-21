<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\CatCiudadanoCABMSRepository;

class CatalogoCABMSController extends Controller
{
    public function buscaClavesCABMS(Request $request, string $criterioBusqueda, CatCiudadanoCABMSRepository $catCCABMSRepository): JsonResponse {        
        // Regla: solamente buscar entre cabms de la categoría scian asociada al perfil de negocio
        $perfilCategoriaScianId = $request->user()->persona->perfil_negocio->id_categoria_scian;         
        $busquedaResultados = $catCCABMSRepository->obtieneClavesCABMS($perfilCategoriaScianId, $criterioBusqueda);        

        return response()->json($busquedaResultados);
    }
}
