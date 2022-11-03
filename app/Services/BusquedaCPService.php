<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BusquedaCPService
{
    public function buscaCPDomicilio(string $cp): array {
        $asentamientos = DB::table('cat_asentamientos')
            ->select('id', 'asentamiento as colonia', 'municipio as alcaldia', 'entidad')
            ->where('cp', $cp)
            ->get()
            ->toArray();

        // TODO: Datos de prueba en ambiente de desarrollo
//        $asentamientos = [
//            [
//                'colonia' => 'San Ángel',
//                'alcaldia' => 'Álvaro Obregón',
//                'entidad' => 'Ciudad de México',
//            ],
//        ];

        return $asentamientos;
    }
}
