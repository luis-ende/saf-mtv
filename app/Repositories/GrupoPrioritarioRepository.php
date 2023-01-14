<?php

namespace App\Repositories;

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
        return self::GRUPOS_PRIORITARIOS;
    }

    public static function findGrupoPrioritario($id)
    {
        return self::GRUPOS_PRIORITARIOS[$id + 1]['grupo'];
    }
}
