<?php

namespace App\Repositories;

class SectorRepository
{
    private const SECTORES = [
        [
            'id' => 1,
            'sector' => 'Comercio', // string, 30
        ],
        [
            'id' => 2,
            'sector' => 'Servicio',
        ],
        [
            'id' => 3,
            'sector' => 'Industrial',
        ],
    ];

    public static function obtieneSectores(): array {
        // TODO: Implementar catálogo en tabla de la bd u obtener lista de otra fuente
        return self::SECTORES;
    }
}
