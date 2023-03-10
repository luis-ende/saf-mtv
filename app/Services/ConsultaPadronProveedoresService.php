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
                $provEtapa['id_etapa'] = $estatusData[0]['id_etapa'];
                $provEtapa['etapa'] = $estatusData[0]['etapa'];
            }
        } else {
            return [
                'error' => 'Consulta no disponible',
            ];
        }

        return $provEtapa;
    }

    public function consultaPadronProveedoresLista(array $listaRFC): array
    {
        $listaEstatus = [];
        foreach ($listaRFC as $rfc) {
            // TODO Sustituir por llamada a servicio que acepta la lista completa de RFC.
            $result = $this->consultaPadronProveedores($rfc);
            if (isset($result['error'])) {
                $listaEstatus[$rfc] = -1;
            } else {
                $listaEstatus[$rfc] = $result['id_etapa'];
            }
        }

        return $listaEstatus;
    }
}