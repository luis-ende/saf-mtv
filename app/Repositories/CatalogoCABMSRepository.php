<?php

namespace App\Repositories;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CatalogoCABMSRepository
{
    public static function obtieneClavesCABMS(string $tipoProducto, string $criterioBusqueda): array {
        $clavesCABMS = [];

        if (env('APP_ENV') === 'local') {
            // TODO: Falta establecer fuente de datos del catálogo para producción
            if ($criterioBusqueda === '') {
                return $clavesCABMS;
            }

            $searchCriteria = [
                [
                    DB::raw('LOWER(concepto_cabms)'),
                    'LIKE',
                    DB::raw("LOWER('%{$criterioBusqueda}%')"),
                ]
            ];

            // Tipo de producto 'Servicio'
            if ($tipoProducto === Producto::TIPO_PRODUCTO_SERVICIO_ID) {
                $searchCriteria[] = ['clave_cabms', 'LIKE', '3%'];
            } else {
                $searchCriteria[] = ['clave_cabms', 'NOT LIKE', '3%'];
            }

            $query = DB::table('cabms')
                ->select( 'clave_cabms', 'concepto_cabms', 'id_partida_especifica AS partida_especifica')
                ->where($searchCriteria);

            $clavesCABMS = $query->get()->toArray();
        }

        return $clavesCABMS;
    }
}
