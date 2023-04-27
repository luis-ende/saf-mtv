<?php declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class VerificacionRFCService
{
    /**
     * Verifica si el RFC ya existe en el Padrón de Proveedores o en MTV y obtiene detalles sobre el registro existente.
     */
    public function verficaRFCEstatus(string $rfc): array
    {
        $responseData = $this->verificaRFCExisteEnPadronProveedores($rfc);

        $responseData['existe_en_mtv'] = false;
        if ($this->verificaRFCExisteEnMTV($rfc)) {
            $responseData['existe_en_mtv'] = true;
            $responseData['permitir_registro_login'] = false;
        }

        return $responseData;
    }

    public function verificaRFCExisteEnPadronProveedores(string $rfc): array
    {
        $response = Http::get( env('API_URL_BUSQUEDA_RFC_PADRON_PROVEEDORES') . $rfc);

        $responseData = [
            'rfc' => $rfc,
            'permitir_registro_login' => false,
            'existe_en_padron_proveedores' => false,
            'etapa_en_padron_proveedores' => '',
            'error' => false,
        ];

        $responseData['http_status'] = $response->status();
        if ($response->successful() || env('TEST_MODE')) {
            $estatusData = $this->getRFCConsultaDatos($response, $rfc);
            if ($estatusData === 'no existe') {
                $responseData['permitir_registro_login'] = true;
            } else {
                $estatusData = $estatusData[0];
                if (isset($estatusData['es_usuario'])) {
                    if ($estatusData['es_usuario'] === true) {
                        $responseData['existe_en_padron_proveedores'] = true;
                        $responseData['etapa_en_padron_proveedores'] = $estatusData['etapa'];
                    }

                    // Permitir el registro en MTV aún si existe en Padrón de Proveedores.
                    $responseData['permitir_registro_login'] = true;
                }
            }
        } else {
            $responseData['error'] = true;
            $responseData['permitir_registro_login'] = false;
        }

        return $responseData;
    }

    protected function verificaRFCExisteEnMTV($rfc): bool
    {
        return User::firstWhere('rfc', $rfc) != null;
    }

    protected function getRFCConsultaDatos(Response $response, string $rfc) {
        if (env('TEST_MODE') === true) {
            // TODO: Datos de prueba para modo local de desarrollo y prototipo, remover en producción
            $testRFCs = [
                [
                    'rfc' => "FOGG851019M17",
                    'es_usuario' => true,
                    'id_etapa' => 7,
                    'etapa' => "CONSTANCIA",
                ],
                [
                    'rfc' => "FOGG851019M18",
                    'es_usuario' => false,
                    'id_etapa' => '',
                    'etapa' => "",
                ],
                [
                    'rfc' => "FOGG851019M19",
                    'es_usuario' => true,
                    'id_etapa' => 10,
                    'etapa' => "SOLICITUD VENCIDA",
                ]
            ];

            $testRFC = array_filter($testRFCs, function($item) use($rfc) {
                return $item['rfc'] === $rfc;
            });

            if (count($testRFC) == 0) {
                $testRFC = [[
                    'rfc' => $rfc,
                    'es_usuario' => true,
                    'id_etapa' => 10,
                    'etapa' => "VENCIDO / PRUEBA",
                ]];
            }

            return array_values($testRFC);
        }

        return $response->json();
    }
}
