<?php declare(strict_types = 1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ConsultaPadronProveedoresService
{
    public function consultaPadronProveedores(string $rfc): array
    {
        $response = Http::get( env('API_URL_BUSQUEDA_RFC_PADRON_PROVEEDORES') . $rfc);

        // Servicio de consulta devuelve:
        // [
        //     {
        //       "rfc": "AEJL690531RB3",
        //       "es_usuario": true,
        //       "id_etapa": 1,
        //       "etapa": "SOLICITUD EN PROCESO"
        //     }
        // ]

        $provEtapa = [];
        if ($response->successful()) {
            $estatusData = $response->json();            
            if ($estatusData === 'no existe') {
                $provEtapa['id_etapa'] = 0;
                $provEtapa['etapa'] = 'SIN REGISTRO';
            } else {
                $provEtapa['id_etapa'] = $estatusData['id_etapa'];
                $provEtapa['etapa'] = $estatusData['etapa'];
            }
        } else {
            return [
                'error' => 'Consulta no disponible',
            ];
        }

        return $provEtapa;
    }
}