<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PaisesRepository
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public static function obtienePaises() {
        return Cache::rememberForever('cat_paises', function() {
            return DB::table('cat_paises')->get();
        });        
    }

    public static function obtienePaisNombre(int $paisId): ?string
    {
        return DB::table('cat_paises')->where('id', $paisId)->value('pais');
    }
}
