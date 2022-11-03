<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class BusquedaRFCService
{
    /**
     * Consulta si el RFC ya existe en el Padrón de Proveedores o en MTV.
     *
     * @param string $rfc
     * @return array
     */
    public function consultaRFCEstatus(string $rfc): array {
        $response = Http::get( config('app.api_url_busqueda_rfc_padron_proveedores') . $rfc);

        $responseData = [
            'rfc' => $rfc,
            'permitir_registro' => false,
            'existe_en_mtv' => false,
            'existe_en_padron_proveedores' => false,
            'etapa_en_padron_proveedores' => '',
            'error' => false,
        ];

        $responseData['http_status'] = $response->status();
        if ($response->successful()) {
            $estatusData = $response->json();
            if ($estatusData === 'no existe') {
                $responseData['permitir_registro'] = true;
            } else {
                $estatusData = $estatusData[0];
                if (isset($estatusData['es_usuario'])) {
                    if ($estatusData['es_usuario'] === true) {
                        $responseData['existe_en_padron_proveedores'] = true;
                        $responseData['etapa_en_padron_proveedores'] = $estatusData['etapa'];
                    } else {
                        $responseData['permitir_registro'] = true;
                    }
                }
            }
        } else {
            $responseData['error'] = true;
        }

        $usuarioExistente = User::firstWhere('rfc', $rfc);
        if ($usuarioExistente) {
            $responseData['existe_en_mtv'] = true;
            $responseData['permitir_registro'] = false;
        }

        return $responseData;
    }
}
