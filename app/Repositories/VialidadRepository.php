<?php

namespace App\Repositories;

class VialidadRepository
{
    private const VIALIDADES = [
        [
            'id' => 1,
            'tipo_vialidad' => 'CALLE',
        ],
        [
            'id' => 2,
            'tipo_vialidad' => 'AVENIDA',
        ],
        [
            'id' => 3,
            'tipo_vialidad' => 'CALZADA',
        ],
        [
            'id' => 4,
            'tipo_vialidad' => 'EJE VIAL',
        ],
        [
            'id' => 5,
            'tipo_vialidad' => 'ANDADOR',
        ],
        [
            'id' => 6,
            'tipo_vialidad' => 'CALLEJON',
        ],
        [
            'id' => 7,
            'tipo_vialidad' => 'BOULEVARD',
        ],
        [
            'id' => 8,
            'tipo_vialidad' => 'CARRETERA',
        ],
        [
            'id' => 9,
            'tipo_vialidad' => 'PRIVADA',
        ],
        [
            'id' => 10,
            'tipo_vialidad' => 'CIRCUNVALACIÓN',
        ],
        [
            'id' => 11,
            'tipo_vialidad' => 'BRECHA',
        ],
        [
            'id' => 12,
            'tipo_vialidad' => 'DIAGONAL',
        ],
        [
            'id' => 13,
            'tipo_vialidad' => 'CORREDOR',
        ],
        [
            'id' => 14,
            'tipo_vialidad' => 'CIRCUITO',
        ],
        [
            'id' => 15,
            'tipo_vialidad' => 'PASAJE',
        ],
        [
            'id' => 16,
            'tipo_vialidad' => 'VEREDA',
        ],
        [
            'id' => 17,
            'tipo_vialidad' => 'VIADUCTO',
        ],
        [
            'id' => 18,
            'tipo_vialidad' => 'PROLONGACIÓN',
        ],
        [
            'id' => 19,
            'tipo_vialidad' => 'PEATONAL',
        ],
        [
            'id' => 20,
            'tipo_vialidad' => 'RETORNO',
        ],
        [
            'id' => 21,
            'tipo_vialidad' => 'CAMINO',
        ],
        [
            'id' => 22,
            'tipo_vialidad' => 'CERRADA',
        ],
        [
            'id' => 23,
            'tipo_vialidad' => 'AMPLIACIÓN',
        ],
        [
            'id' => 24,
            'tipo_vialidad' => 'CONTINUACIÓN',
        ],
        [
            'id' => 25,
            'tipo_vialidad' => 'TERRACERÍA',
        ],
        [
            'id' => 26,
            'tipo_vialidad' => 'PERIFÉRICO',
        ],
    ];

    public static function obtieneTiposVialidad(): array {
        // TODO: Implementar catálogo en tabla de la bd u obtener lista de otra fuente
        return self::VIALIDADES;
    }
}
