<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ProveedoresController extends Controller
{
    /**
     * Consulta si existe RFC en Padrón de Proveedores.
     *
     * @param $rfc
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($rfc)
    {
        return response()->json([0]);
    }
}
