<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class GrupoPrioritarioRepository
{
    public static function obtieneGruposPrioritarios(): array {
        return  DB::table('cat_grupos_prioritarios')->select('id', 'grupo')->get()->toArray();
    }

    public static function findGrupoPrioritario($id): ?string
    {
        return DB::table('cat_grupos_prioritarios')->where('id', $id)->value('grupo');
    }
}
