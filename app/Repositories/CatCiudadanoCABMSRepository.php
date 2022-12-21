<?php

namespace App\Repositories;

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

    public function obtieneClavesCABMS(int $perfilCategoriaScianId, string $criterioBusqueda): array {
        $clavesCABMS = [];
    
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

        $query = DB::table('cat_cabms')
            ->select( 'cat_cabms.id', 'cat_cabms.cabms', 'cat_cabms.nombre_cabms', 'cat_cabms.partida AS partida')
            ->join('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'cat_cabms.id_categoria_scian')                                         
            ->where($searchCriteria)
            ->where('id_categoria_scian', '=', $perfilCategoriaScianId);

        $clavesCABMS = $query->get()->toArray();        

        return $clavesCABMS;
    }
}
