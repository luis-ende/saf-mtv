<?php declare(strict_types = 1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ConsultaPadronProveedoresService
{
    public function consultaPadronProveedores(string $rfc): array
    {
        $response = Http::get( env('API_URL_BUSQUEDA_RFC_PADRON_PROVEEDORES') . $rfc);

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

    public function consultaMultiplePadronProveedores(array $listRfc): array
    {
        $provEtapas = [];

        if (count($listRfc) === 0) {
            return $provEtapas;
        }

        $response = Http::post( env('API_URL_PADRON_PROVEEDORES_CONSULTA_MULTIPLE_RFC'), [
            'data' => $listRfc,
        ]);

        if ($response->successful()) {
            $estatusData = $response->json();
            if ($estatusData !== 'no existe') {
                $provEtapas = $estatusData;
            }
        }

        return $provEtapas;
    }

    public function consultaPadronProveedoresLista(array $listaRFC): array
    {
        $listaEstatus = [];
        $proveedoresEstatus = $this->consultaMultiplePadronProveedores($listaRFC);
        foreach ($listaRFC as $rfc) {
            $rfcItem = array_filter($proveedoresEstatus, function($e) use($rfc) {
                return $e['rfc'] === $rfc;
            });

            if ($rfcItem && isset($rfcItem['id_etapa'])) {
                $listaEstatus[$rfc] = $rfcItem['id_etapa'];
            } else {
                $listaEstatus[$rfc] = 0;
            }
        }

        return $listaEstatus;
    }
}