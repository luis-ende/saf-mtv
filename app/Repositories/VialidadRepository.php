<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class VialidadRepository
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public static function obtieneTiposVialidad() {
        return DB::table('cat_tipo_vialidad')->get();
    }
}
