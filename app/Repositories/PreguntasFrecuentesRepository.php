<?php

namespace App\Repositories;

use App\Models\PreguntasFrecuentes\PreguntaFrecuente;
use Illuminate\Support\Collection;

class PreguntasFrecuentesRepository
{
    public static array $categorias = [];

    public static function obtieneCategorias()
    {
        if (empty(self::$categorias)) {
            self::$categorias = [
                [
                    'categoria_id' => PreguntaFrecuente::CATEGORIA_PUBLICO,
                    'nombre' => 'Público en general',
                    'subcategorias' => [
                        [
                            'subcategoria_id' => PreguntaFrecuente::SUBCATEGORIA_PUBLICO_CONCEPTOS,
                            'nombre' => 'Conceptos',
                        ],
                        [
                            'subcategoria_id' => PreguntaFrecuente::SUBCATEGORIA_PUBLICO_COMPRAS,
                            'nombre' => 'Compras públicas',
                        ],
                        [
                            'subcategoria_id' => PreguntaFrecuente::SUBCATEGORIA_PUBLICO_MTV,
                            'nombre' => 'Mi Tiendita Virtual',
                        ],
                    ],
                ],
                [
                    'categoria_id' => PreguntaFrecuente::CATEGORIA_PROVEEDORES,
                    'nombre' => 'Proveedores',
                    'subcategorias' => [
                        [
                            'subcategoria_id' => PreguntaFrecuente::SUBCATEGORIA_PROVEEDORES_PADRON,
                            'nombre' => 'Padrón de Proveedores',
                        ],
                        [
                            'subcategoria_id' => PreguntaFrecuente::SUBCATEGORIA_PROVEEDORES_PRECOTIZACIONES,
                            'nombre' => 'Precotizaciones',
                        ],
                    ],
                ],
                [
                    'categoria_id' => PreguntaFrecuente::CATEGORIA_INSTITUCIONES,
                    'nombre' => 'Instituciones compradoras',
                    'subcategorias' => [
                        [
                            'subcategoria_id' => PreguntaFrecuente::SUBCATEGORIA_INSTITUCIONES_PAAPS,
                            'nombre' => 'Sistema PAAAPS',
                        ],
                    ],
                ]
            ];
        }

        return self::$categorias;
    }

    public function obtienePreguntasFrecuentes(?int $categoria = null, ?int $subcategoria = null): Collection
    {
        $query = PreguntaFrecuente::select('categoria', 'subcategoria', 'pregunta', 'respuesta');

        if ($categoria || $subcategoria) {
            if ($categoria) {
                $query = $query->where('categoria', $categoria);
            }
            if ($subcategoria) {
                $query = $query->where('subcategoria', $subcategoria);
            }

            return $query->get();
        }

        return $query->get();
    }
}