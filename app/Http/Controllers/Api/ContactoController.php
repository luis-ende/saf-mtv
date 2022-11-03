<?php

namespace App\Http\Controllers\Api;

use App\Services\BusquedaCPService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ContactoController extends Controller
{
    /**
     * Consulta asentamientos por código postal.
     */
    public function consultaInfoDomicilio(string $cp, BusquedaCPService $busquedaCPService): JsonResponse
    {
        $asentamientos = $busquedaCPService->buscaCPDomicilio($cp);

        return response()->json($asentamientos);
    }
}
