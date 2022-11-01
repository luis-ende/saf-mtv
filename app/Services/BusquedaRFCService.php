<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BusquedaRFCService
{
    private const ID_ETAPA_CON_CONSTANCIA = 7;



    public function consultaRFCEstatus($rfc) {
        $response = Http::get( config('app.api_url_busqueda_rfc_padron_proveedores') . $rfc);

        $responseData = [
            'rfc' => $rfc,
            'id_etapa' => 0,
            'nombre_etapa' => '',
        ];


//        0	Object { rfc: "JUAA810316M17", es_usuario: true, id_etapa: 1, … }
//            rfc	"JUAA810316M17"
//            es_usuario	true
//            id_etapa	1
//            etapa	"SOLICITUD EN PROCESO"

        if ($response->successful()) {
            $estatusData = $response->json();

            if ($estatusData == "no existe") {
                $responseData['existe_en_padron_proveedores'] = false;
            } else {
                if (isset($estatusData['es_usuario']) && $estatusData['es_usuario'] === 1) {
                    if ($estatusData['id_etapa'] === self::ID_ETAPA_CON_CONSTANCIA) {
                        $responseData['estatus'] = 1;
                    }
                }
            }

            return $estatusData;
        }

        $responseData['http_status'] = $response->status();

        return $responseData;
    }
}
