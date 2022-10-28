<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ContactoController extends Controller
{
    /**
     * Consulta asentamientos por código postal.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function consultaInfoDomicilio($cp)
    {
//        $asentamientos = DB::table('cat_asentamientos')
//            ->select('id', 'asentamiento as colonia', 'municipio as alcaldia', 'entidad')
//            ->where('cp', $cp)
//            ->get();

        // TODO: Datos de prueba en ambiente de desarrollo
        $asentamientos = [
            [
                'colonia' => 'San Ángel',
                'alcaldia' => 'Álvaro Obregón',
                'entidad' => 'Ciudad de México',
            ],
        ];

        return response()->json($asentamientos);
    }
}
