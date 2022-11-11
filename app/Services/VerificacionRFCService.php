<?php declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class VerificacionRFCService
{
    private const ETAPAS_PROVEEDORES_REGISTRO_PERMITIDO = [
        10, // SOLICITUD VENCIDA
        12, // RECHAZADO CON SOLICITUD VENCIDA
    ];

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
        $response = Http::get( config('app.api_url_busqueda_rfc_padron_proveedores') . $rfc);

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
                        // Permitir el registro en MTV aún si existe en Padrón de Proveedores pero con estatus vencido.
                        if (in_array($estatusData['id_etapa'], self::ETAPAS_PROVEEDORES_REGISTRO_PERMITIDO)) {
                            $responseData['permitir_registro_login'] = true;
                        }
                    } else {
                        $responseData['permitir_registro_login'] = true;
                    }
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
                    'rfc' => "JUAA810316M17",
                    'es_usuario' => true,
                    'id_etapa' => '7',
                    'etapa' => "CONSTANCIA",
                ],
                [
                    'rfc' => "JUAA810316M18",
                    'es_usuario' => false,
                    'id_etapa' => '',
                    'etapa' => "",
                ],
                [
                    'rfc' => "JUAA810316M19",
                    'es_usuario' => true,
                    'id_etapa' => '10',
                    'etapa' => "SOLICITUD VENCIDA",
                ]
            ];

            $testRFC = array_filter($testRFCs, function($item) use($rfc) {
                return $item['rfc'] === $rfc;
            });

            return array_values($testRFC);
        }

        return $response->json();
    }
}
