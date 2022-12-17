<?php

namespace App\Repositories;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CatCiudadanoCABMSRepository
{
    public function obtieneSectores()
    {
        $sectores = DB::table('cat_sectores')
                        ->select('id', 'sector')
                        ->orderBy('sector')
                        ->get()
                        ->toArray();

        return $sectores;
    }

    public function obtieneCategoriasScianPorSector(int $idSector)
    {
        $giros = DB::table('cat_categorias_scian')
                    ->select('id', 'categoria_scian')
                    ->where('id_sector', $idSector)
                    ->orderBy('categoria_scian')
                    ->get()
                    ->toArray();

        return $giros;
    }

    public function obtieneClavesCABMS(string $tipoProducto, string $criterioBusqueda): array {
        $clavesCABMS = [];

        if (env('APP_ENV') === 'local') {
            // TODO: Falta establecer fuente de datos del catálogo para producción
            if ($criterioBusqueda === '') {
                return $clavesCABMS;
            }

            $searchCriteria = [
                [
                    DB::raw('LOWER(nombre_cabms)'),
                    'LIKE',
                    DB::raw("LOWER('%{$criterioBusqueda}%')"),
                ]
            ];

            // Tipo de producto 'Servicio'
            if ($tipoProducto === Producto::TIPO_PRODUCTO_SERVICIO_ID) {
                $searchCriteria[] = ['cabms', 'LIKE', '3%'];
            } else {
                $searchCriteria[] = ['cabms', 'NOT LIKE', '3%'];
            }

            $query = DB::table('cat_cabms')
                ->select( 'id', 'cabms', 'nombre_cabms', 'partida AS partida_especifica')
                ->where($searchCriteria);

            $clavesCABMS = $query->get()->toArray();
        }

        return $clavesCABMS;
    }
}
