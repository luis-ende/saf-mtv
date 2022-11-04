<?php

namespace App\Http\Controllers\Api;

use App\Services\BusquedaCPService;
use App\Services\BusquedaCURPService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ContactoController extends Controller
{
    public function consultaCURP($curp, BusquedaCURPService $busquedaCPService): JsonResponse {
        $curpDatos = $busquedaCPService->obtieneCURPDatos($curp);

        return response()->json($curpDatos);
    }

    /**
     * Consulta asentamientos por código postal.
     */
    public function consultaInfoDomicilio(string $cp, BusquedaCPService $busquedaCPService): JsonResponse
    {
        $asentamientos = $busquedaCPService->buscaCPDomicilio($cp);

        return response()->json($asentamientos);
    }
}
