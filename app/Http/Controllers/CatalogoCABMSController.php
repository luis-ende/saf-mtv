<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\CatCiudadanoCABMSRepository;

class CatalogoCABMSController extends Controller
{
    public function buscaClavesCABMS(Request $request, string $criterioBusqueda, CatCiudadanoCABMSRepository $catCCABMSRepository): JsonResponse
    {
        $tipoProducto = Producto::TIPO_PRODUCTO_BIEN_ID;
        if ($request->query('tipo_producto')) {
            $tipoProducto = $request->query('tipo_producto');
        }
        $busquedaResultados = $catCCABMSRepository->obtieneClavesCABMS($criterioBusqueda, $tipoProducto);

        return response()->json($busquedaResultados);
    }

    public function buscaCategorias(Request $request, int $cabmsId, CatCiudadanoCABMSRepository $catCCABMSRepository)
    {
        $busquedaResultados = $catCCABMSRepository->obtieneCategoriasScianPorCABMS($cabmsId);

        return response()->json($busquedaResultados);
    }
}
