<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CatAsentamientosRepository
{    
    public static function obtieneAcaldias()
    {
        return DB::table('cat_asentamientos')->select('id_municipio as id', 'municipio as alcaldia')
                                             ->distinct()
                                             ->orderBy('municipio')
                                             ->get();
    }    
}
