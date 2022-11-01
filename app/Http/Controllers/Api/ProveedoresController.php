<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;

use App\Services\BusquedaRFCService;
use App\Http\Controllers\Controller;

class ProveedoresController extends Controller
{
    /**
     * Consulta si existe RFC en Padrón de Proveedores.
     *
     * @param $rfc
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($rfc, BusquedaRFCService $busquedaRFCService)
    {
        $rfcEstatus = $busquedaRFCService->consultaRFCEstatus($rfc);

        return response()->json($rfcEstatus);
    }
}
