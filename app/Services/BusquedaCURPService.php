<?php declare(strict_types = 1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BusquedaCURPService
{
    public function obtieneCURPDatos(string $curp): array
    {
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

        $response = null;
        try {
            if (env('TEST_MODE') === true) {
                $response = Http::get(config('app.api_url_consulta_curp') . $curp);
            } else {
                $response = Http::post(config('app.api_url_consulta_curp'), [
                    'security' => [
                        'tokenId' => env('API_BUSQUEDA_CURP_TOKEN')
                    ],
                    'data' => [
                        'CURP' => $curp
                    ],
                ]);
            }

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
        } catch (Exception $e) {
            $responseData['error'] = true;
            $responseData['error_msg'] = $e->getMessage();
        }

        if ($responseData['error']) {
            if (isset($response['error']['msg'])) {
                $responseData['error_msg'] = $response['error']['msg'];
            } elseif ($response)  {
                $responseData['error_msg'] = $response->reason();
            }
        }

        return $responseData;
    }
}
