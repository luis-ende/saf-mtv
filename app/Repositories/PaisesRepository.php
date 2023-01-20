<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PaisesRepository
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public static function obtienePaises() {
        return DB::table('cat_paises')->get();
    }

    public static function obtienePaisNombre(int $paisId): ?string
    {
        return DB::table('cat_paises')->where('id', $paisId)->value('pais');
    }
}
