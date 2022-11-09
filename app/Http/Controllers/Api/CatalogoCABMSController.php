<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CatalogoCABMSRepository;
use Illuminate\Http\JsonResponse;

class CatalogoCABMSController extends Controller
{
    public function buscaClavesCABMS(string $tipoProducto, string $criterioBusqueda): JsonResponse {
        $busquedaResultados = CatalogoCABMSRepository::obtieneClavesCABMS($tipoProducto, $criterioBusqueda);

        return response()->json($busquedaResultados);
    }
}
