<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BusquedaCPService
{
    public function buscaCPAsentamiento(string $cp): array {
        $asentamientos = DB::table('cat_asentamientos')
            ->select('id', 'asentamiento as colonia', 'municipio as alcaldia', 'entidad')
            ->where('cp', $cp)
            ->get()
            ->toArray();

        // TODO: Datos de prueba en ambiente de desarrollo
//        $asentamientos = [
//            [
//                'id' => 1,
//                'cp' => '1000',
//                'colonia' => 'San Ángel',
//                'alcaldia' => 'Álvaro Obregón',
//                'entidad' => 'Ciudad de México',
//            ],
//            [
//                'id' => 2,
//                'cp' => '1010',
//                'colonia' => 'Los Alpes',
//                'alcaldia' => 'Álvaro Obregón',
//                'entidad' => 'Ciudad de México',
//            ],
//            [
//                'id' => 3,
//                'cp' => '1020',
//                'colonia' => 'Guadalupe Inn',
//                'alcaldia' => 'Álvaro Obregón',
//                'entidad' => 'Ciudad de México',
//            ],
//        ];

//        $asentamientos = array_filter($asentamientos, function($item) use($cp) {
//            return $item['cp'] === $cp;
//        });

        return $asentamientos;
    }
}
