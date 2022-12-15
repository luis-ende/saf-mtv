<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CatCiudadanoCABMSRepository
{
    public function obtieneSectores() 
    {
        $sectores = DB::table('cat_ciudadano_cabms')->select('sector as id', 'sector')->distinct( 'sector')->get()->toArray();
        
        return $sectores;
    }

    public function obtieneGiros(string $sector): array
    {
        $giros = DB::table('cat_ciudadano_cabms')->select( 'giro')->where('sector', $sector);

        return [];
    }

}