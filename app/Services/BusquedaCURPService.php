<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BusquedaCURPService
{
    public function obtieneCURPDatos($curp) {
        $responseData = [
            'curp' => $curp,
            'curp_invalido' => false,
            'curp_no_localizado' => false,
            'curp_datos' => [],
            'error' => false,
            'error_msg' => '',
        ];

        if (strlen($curp) != 18) {
            $responseData['curp_invalido'] = true;

            return $responseData;
        }

        $response = Http::post(config('app.api_url_consulta_curp'), [
            'security' => [
                'tokenId' => env('API_BUSQUEDA_CURP_TOKEN')
            ],
            'data' => [
                'CURP' => $curp
            ],
        ]);

        $curpResponseData = $response->json();
        if ($response->successful()) {
            if ($curpResponseData['error']['code'] === 0) {
                if (isset($curpResponseData['data'])) {
                    $responseData['curp_datos'] = $curpResponseData['data'][0];
                    $genero = $responseData['curp_datos']['sexo'];
                    if ($genero === 'H') {
                        $responseData['curp_datos']['sexo'] = 'M';
                    } elseif ($genero === 'M') {
                        $responseData['curp_datos']['sexo'] = 'F';
                    }
                } else {
                    $responseData['error'] = true;
                }
            } else {
                $responseData['curp_no_localizado'] = true;
            }
        } else {
            $responseData['error'] = true;
        }

        if ($responseData['error']) {
            $responseData['error_msg'] = $response['error']['msg'];
        }


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

        return $responseData;
    }
}
