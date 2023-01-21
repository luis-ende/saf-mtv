<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class GrupoPrioritarioRepository
{
    private const GRUPOS_PRIORITARIOS = [
        [
            'id' => 1,
            'grupo' => 'MIPYMES', //string, 60
        ],
        [
            'id' => 2,
            'grupo' => 'Cooperativas',
        ],
        [
            'id' => 3,
            'grupo' => 'Empresas lideradas por mujeres',
        ],
        [
            'id' => 4,
            'grupo' => 'Comunidades Indigenas',
        ],
    ];

    public static function obtieneGruposPrioritarios(): array {
        return  DB::table('cat_grupos_prioritarios')->select('id', 'grupo')->get()->toArray();
    }

    public static function findGrupoPrioritario($id): ?string
    {
        return DB::table('cat_grupos_prioritarios')->where('id', $id)->value('grupo');
    }
}
