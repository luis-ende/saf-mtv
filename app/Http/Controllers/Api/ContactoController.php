<?php

namespace App\Http\Controllers\Api;

use App\Services\BusquedaCURPService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\CatAsentamientosRepository;

class ContactoController extends Controller
{
    public function consultaCURP($curp, BusquedaCURPService $busquedaCURPService): JsonResponse {
        $curpDatos = $busquedaCURPService->obtieneCURPDatos($curp);

        return response()->json($curpDatos);
    }

    /**
     * Consulta asentamientos por código postal.
     */
    public function consultaInfoDomicilio(string $cp, CatAsentamientosRepository $catAsentamientosRepo): JsonResponse
    {
        $asentamientos = $catAsentamientosRepo->buscaCPAsentamiento($cp);

        return response()->json($asentamientos);
    }
}
