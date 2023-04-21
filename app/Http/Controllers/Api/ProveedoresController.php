<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

use App\Services\VerificacionRFCService;
use App\Http\Controllers\Controller;

class ProveedoresController extends Controller
{
    /**
     * Consulta si existe RFC en Padrón de Proveedores o en MTV.
     */
    public function verificaRFCRegistro($rfc, VerificacionRFCService $verificacionRFCService): JsonResponse
    {
        $rfcEstatus = $verificacionRFCService->verficaRFCEstatus($rfc);

        return response()->json($rfcEstatus);
    }
}
