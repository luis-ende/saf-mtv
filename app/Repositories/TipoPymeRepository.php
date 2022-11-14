<?php

namespace App\Repositories;

class TipoPymeRepository
{
    private const TIPOS_PYME = [
        [
            'id' => 1,
            'tipo_pyme' => 'Micro', // string, 10
        ],
        [
            'id' => 2,
            'tipo_pyme' => 'Pequeña',
        ],
        [
            'id' => 3,
            'tipo_pyme' => 'Mediana',
        ],
    ];

    public static function obtieneTiposPyme(): array {
        // TODO: Implementar catálogo en tabla de la bd u obtener lista de otra fuente
        return self::TIPOS_PYME;
    }
}
