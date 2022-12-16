<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CatCiudadanoCABMSRepository
{
    public function obtieneSectores()
    {
        $sectores = DB::table('cat_ciudadano_cabms')
                        ->select('sector as id', 'sector')
                        ->distinct( 'sector')
                        ->get()
                        ->toArray();

        return $sectores;
    }

    public function obtieneCategoriasScianPorSector(string $sector)
    {
        $giros = DB::table('cat_ciudadano_cabms')
                    ->select('giro as id', 'giro as categoria_scian') // TODO: Obtener de tabla cat_categorias_scian
                    ->distinct('giro')
                    ->where('sector', $sector)
                    ->orderBy('giro')
                    ->get()
                    ->toArray();

        return $giros;
    }

}
