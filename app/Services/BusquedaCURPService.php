<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BusquedaCURPService
{
    public function obtieneCURPDatos($curp) {
        $response = Http::post(config('app.api_url_consulta_curp'), [
            'security' => [
                'tokenId' => env('API_BUSQUEDA_CURP_TOKEN')
            ],
            'data' => [
                'CURP' => $curp
            ],
        ]);


//        {
//            "error": {
//            "msg": "Datos obtenidos correctamente",
//    "code": 0
//  },
//  "data": [
//    {
//        "CURP": "FOGG851019HDFLRL02",
//      "nombres": "GUILLERMO NATIVIDAD",
//      "apellido1": "FLORES",
//      "apellido2": "GARDUÑO",
//      "sexo": "H",
//      "cveEntidadNac": "DF",
//      "fechNac": "19/10/1985",
//      "nacionalidad": "MEX",
//      "anioReg": "1985",
//      "statusCurp": "RCN"
//    }
//  ]
//}

//        {
//            "error": {
//            "msg": "Sin acceso, consulta con tu administrador quedará registro de la solicitud",
//    "code": 0
//  }
//}

        return $response->json();
    }
}
