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

}
