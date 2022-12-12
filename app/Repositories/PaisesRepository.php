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
}
