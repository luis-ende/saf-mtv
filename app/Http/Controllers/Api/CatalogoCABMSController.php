<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CatCiudadanoCABMSRepository;
use Illuminate\Http\JsonResponse;

class CatalogoCABMSController extends Controller
{
    public function buscaClavesCABMS(string $tipoProducto, string $criterioBusqueda, CatCiudadanoCABMSRepository $catCCABMSRepository): JsonResponse {
        $busquedaResultados = $catCCABMSRepository->obtieneClavesCABMS($tipoProducto, $criterioBusqueda);

        // TODO: Implementar tratamiento de excepciones

        return response()->json($busquedaResultados);
    }
}
