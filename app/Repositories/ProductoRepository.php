<?php

namespace App\Repositories;

use App\Models\Producto;
use App\Models\User;
use App\Services\RegistroProductosService;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class ProductoRepository
{
    public const BUSQUEDA_PRODUCTOS_PAGINATION_OFFSET = 30;

    /**
     * Obtiene producto con nombre CAMBS y lista de categorías SCIAN asociadas.
     */
    public function obtieneProductoCABMSCategorias(int $productoId): array
    {
        $producto = DB::table('productos')
            ->select('productos.id', 'productos.tipo', 'productos.id_cabms',
                     'cat_cabms.nombre_cabms', 'cat_categorias_scian.categoria_scian', 'cat_sectores.sector')
            ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
            ->leftJoin('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'cat_cabms.id_categoria_scian')
            ->leftJoin('cat_sectores', 'cat_sectores.id', '=', 'cat_categorias_scian.id_sector')
            ->where('productos.id', '=', $productoId)
            ->get();
        $producto = isset($producto[0]) ? $producto[0] : null;

        $categoriasRows = DB::table('productos_categorias')
            ->select('cat_categorias_scian.id', 'cat_categorias_scian.categoria_scian')
            ->join('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'productos_categorias.id_categoria_scian')
            ->where('productos_categorias.id_producto', '=', $productoId)
            ->get()
            ->toArray();
        $categorias = array_map(function($item) {
            return $item->categoria_scian;
        }, $categoriasRows);
        $categoriasIds = array_map(function($item) {
            return $item->id;
        }, $categoriasRows);

        return [
            'id' => $productoId,
            'tipo' => $producto?->tipo,
            'id_cabms' => $producto?->id_cabms,
            'nombre_cabms' => $producto?->nombre_cabms,
            'categoria_scian' => $producto?->categoria_scian,
            'sector' => $producto?->sector,
            'ids_categorias_scian' => $categoriasIds,
            'categorias_scian' => implode(', ', $categorias),
        ];
    }

    /**
     * Obtiene productos importados por carga masiva de un catálogo.
     */
    public function obtieneProductosImportados(int $catalogoId): array
    {
        return Producto::select('id', 'tipo', 'nombre', 'descripcion', 'id_cabms')
                            ->where([
                                        ['id_cat_productos', '=', $catalogoId],
                                        ['es_importado', '=', true],
                                    ])
                            ->orderBy('id') // Orden en el que fueron importados
                            ->get()
                            ->toArray();
    }

    public function obtieneProductosPorCatalogo(int $catalogoProductosId) {
        $productos = Producto::select('productos.id', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                      'cat_cabms.cabms', 'cat_cabms.partida',
                                      $this->subqueryProductoFavoritos())
                                ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
                                ->where([
                                    ['id_cat_productos', '=', $catalogoProductosId],
                                    // Descartar registros de productos que por alguna razón no se completaron
                                    ['registro_fase', '>=', RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS]
                                ])
                                ->orderBy('tipo')
                                ->orderBy('nombre')
                                ->get();

        $productos->each(function (&$producto) {
            $producto['foto_info'] = $producto->getFirstMedia('fotos');
        });

        return $productos;
    }

    /**
     * Realiza búsqueda de productos por término y filtros aplicados (Buscador MTV).
     */
    public function buscaProductosPorTermino(?string $terminoBusqueda, array $filtros = [], int $offset = 0)
    {
        // Se filtran siempre registros de productos que por alguna razón no se completaron
        $condiciones = [
            ['registro_fase', '>=', RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS],
        ];

        $terminoBusqueda = strtolower($terminoBusqueda);

        $query = Producto::select('productos.id', 'productos.id_cat_productos', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                  'cat_cabms.cabms', 'cat_cabms.partida',
                                  'perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio',
                                  $this->subqueryProductoFavoritos())
                            ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
                            ->leftJoin('cat_productos', 'cat_productos.id', '=', 'productos.id_cat_productos')
                            ->leftJoin('perfil_negocio', 'perfil_negocio.id_persona', '=', 'cat_productos.id_persona')
                            ->where($condiciones);

        if (isset($filtros['partida_filtro'])) {
            $partidas = $filtros['partida_filtro'];
            $query = $query->where(function($query) use($partidas) {
                $query->whereIn('cat_cabms.partida', $partidas);
            });
        }

        if (isset($filtros['capitulo_filtro'])) {
            $capitulos = array_map(function($cap) {
                // Obtiene primer caracter del capítulo, por ejemplo: '2000' = '2'
                return $cap[0];
            }, $filtros['capitulo_filtro']);

            $query = $query->where(function($query) use($capitulos) {
                $query->whereIn(DB::raw('LEFT(partida, 1)'), $capitulos);
            });
        }

        if (isset($filtros['sector_filtro'])) {
            $sectores = $filtros['sector_filtro'];
            $query = $query->leftJoin('cat_categorias_scian', 'cat_categorias_scian.id', 'cat_cabms.id_categoria_scian')
                            ->where(function ($query) use($sectores) {
                                $query->leftJoin('cat_categorias_scian', 'cat_categorias_scian.id', 'cat_cabms.id_categoria_scian')
                                        ->whereIn('cat_categorias_scian.id_sector', $sectores)
                                        ->orWhereExists(function($query) use($sectores) {
                                            $query->select('cat_categorias_scian.id_sector')
                                                    ->from('productos_categorias')
                                                    ->leftJoin('cat_categorias_scian', 'cat_categorias_scian.id', 'productos_categorias.id_categoria_scian')
                                                    ->whereRaw('productos_categorias.id_producto = productos.id')
                                                    ->whereIn('cat_categorias_scian.id_sector', $sectores);
                                        });
                            });
        }

        if ($terminoBusqueda) {
            $query = $query->where(function ($orQuery) use($terminoBusqueda) {
                $orQuery->orWhere(DB::raw('LOWER(productos.nombre)'), 'like', '%' . $terminoBusqueda . '%')
                        ->orWhere(DB::raw('LOWER(cat_cabms.nombre_cabms)'), 'like', '%' . $terminoBusqueda . '%')
                        ->orWhere(DB::raw('cat_cabms.cabms'), $terminoBusqueda);
            });
        }

        if (isset($filtros['sort_productos'])) {
            $query = $query->orderBy($filtros['sort_productos']);
        }

        $query = $query->offset($offset)
                       ->limit(self::BUSQUEDA_PRODUCTOS_PAGINATION_OFFSET);

        $productos = $query->get();

        $productos->each(function (&$producto) {
            $producto['foto_info'] = $producto->getFirstMedia('fotos');
        });

        return $productos;
    }

    public function obtieneProductosFavoritos(User $user)
    {
        $productos = Producto::whereHasFavorite($user)
                                ->select('productos.id', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                            'cat_cabms.cabms', 'cat_cabms.partida',
                                            'perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio',
                                            $this->subqueryProductoFavoritos())
                                            ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
                                            ->leftJoin('cat_productos', 'cat_productos.id', '=', 'productos.id_cat_productos')
                                            ->leftJoin('perfil_negocio', 'perfil_negocio.id_persona', '=', 'cat_productos.id_persona')
                                            ->where([
                                                // Descartar registros de productos que por alguna razón no se completaron
                                                ['registro_fase', '>=', RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS]
                                            ])
                                            ->orderBy('tipo')
                                            ->orderBy('nombre')
                                            ->get();

        $productos->each(function (&$producto) {
            $producto['foto_info'] = $producto->getFirstMedia('fotos');
        });

        return $productos;
    }

    /**
     * Obtiene productos para la descarga de favoritos en Excel de la URG.
     * Ver app/Exports/ProductosFavoritosExport.php
     */
    public function obtieneProductosFavoritosDescarga(User $user): mixed
    {
        $productos = Producto::whereHasFavorite($user)
                                ->select(DB::raw('ROW_NUMBER() OVER (ORDER BY productos.tipo, productos.nombre)'),
                                    'productos.tipo', 'productos.nombre', 'productos.descripcion',
                                    'cat_cabms.cabms', 'cat_cabms.partida', 'cat_cabms.nombre_cabms',
                                    DB::raw("(SELECT STRING_AGG(cat_categorias_scian.categoria_scian, ',') " .
                                                  "FROM productos_categorias LEFT JOIN cat_categorias_scian ON " .
                                                  "cat_categorias_scian.id = productos_categorias.id_categoria_scian " .
                                                  "WHERE productos_categorias.id_producto = productos.id) AS categoria"))
                                ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
                                ->leftJoin('cat_productos', 'cat_productos.id', '=', 'productos.id_cat_productos')
                                ->where([
                                    // Descartar registros de productos que por alguna razón no se completaron
                                    ['registro_fase', '>=', RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS]
                                ])
                                ->orderBy('tipo')
                                ->orderBy('nombre')
                                ->get();

        return $productos;
    }

    public function obtieneProductoInfo(int $productoId, bool $conProveedor = false)
    {
        $query = Producto::select('productos.id', 'productos.id_cat_productos', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                'productos.descripcion', 'productos.marca', 'productos.modelo', 'productos.color',
                                'productos.material', 'productos.codigo_barras',
                                'cat_cabms.cabms', 'cat_cabms.nombre_cabms', 'cat_cabms.partida', 'cat_cabms.id_categoria_scian',
                                $this->subqueryProductoFavoritos())
                                ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms');

        if ($conProveedor) {
            $query = $query->addSelect('perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio', 'personas.email AS proveedor_email')
                           ->leftJoin('cat_productos', 'cat_productos.id', '=', 'productos.id_cat_productos')
                           ->leftJoin('personas', 'personas.id', '=', 'cat_productos.id_persona')
                           ->leftJoin('perfil_negocio', 'perfil_negocio.id_persona', '=', 'cat_productos.id_persona');
        }

        $productoInfo = $query->where('productos.id', '=', $productoId)
                              ->firstOrFail();

        $categoriasScian = DB::table('productos_categorias')
                                ->select('cat_categorias_scian.categoria_scian')
                                ->join('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'productos_categorias.id_categoria_scian')
                                ->where('productos_categorias.id_producto', '=', $productoId)
                                ->get()
                                ->implode('categoria_scian', ', ');
        $productoInfo['categorias_scian'] = $categoriasScian;

        return $productoInfo;
    }

    public function obtieneNumeroProductosRegistrados(): int
    {
        return DB::table('productos')->count();
    }

    public function obtieneProductosPorCategoriasSCIAN(array $categorias)
    {
        $productos = Producto::select('productos.id', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                      'cat_cabms.cabms', 'cat_cabms.partida',
                                      'perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio',
                                      $this->subqueryProductoFavoritos())
                                        ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
                                        ->leftJoin('cat_productos', 'cat_productos.id', '=', 'productos.id_cat_productos')
                                        ->leftJoin('perfil_negocio', 'perfil_negocio.id_persona', '=', 'cat_productos.id_persona')
                                        // Se filtran registros de productos que por alguna razón no se completaron
                                        ->where('productos.registro_fase', '>=', RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS)
                                        ->where(function ($query) use($categorias) {
                                            $query->whereIn('cat_cabms.id_categoria_scian', $categorias)
                                                  ->orWhereExists(function($query) use($categorias) {
                                                      $query->select('id_categoria_scian')
                                                            ->from('productos_categorias')
                                                            ->whereRaw('productos_categorias.id_producto = productos.id')
                                                            ->whereIn('id_categoria_scian', $categorias);
                                                  });
                                        })
                                        ->orderBy('nombre')
                                        ->limit(10)
                                        ->get();

        // TODO Obtener información en join!
        $productos->each(function (&$producto) {
            $producto['foto_info'] = $producto->getFirstMedia('fotos');
        });

        return $productos;
    }

    /**
     * Obtiene todas las categorías SCIAN de un producto.
     */
    public function obtieneProductoCategorias(Producto $producto): array
    {
        $productoCategorias = DB::table('productos_categorias')
                                ->where('id_producto', $producto->id)
                                ->pluck('id_categoria_scian')
                                ->toArray();

        $categorias = [];
        if (isset($producto->id_categoria_scian)) {
            $categorias[] = $producto->id_categoria_scian;
        }

        return array_unique(array_merge($categorias, $productoCategorias));
    }

    public function actualizaProducto(Producto $producto, array $productoData, ?array $categorias, array $fotosInfo, array $adjuntos): void
    {
        $producto->update($productoData);
        $producto->actualizaCategoriasScian($categorias);
        $producto->actualizaFotos($fotosInfo['producto_fotos'] ?? null, $fotosInfo['producto_fotos_eliminadas']);
        if (isset($adjuntos['eliminar_ficha_tecnica']) &&
            $adjuntos['eliminar_ficha_tecnica'] == true) {
            $producto->clearMediaCollection('fichas_tecnicas');
        }
        if (isset($adjuntos['ficha_tecnica_file'])) {
            $producto->clearMediaCollection('fichas_tecnicas');
            $producto->addMedia($adjuntos['ficha_tecnica_file'])->toMediaCollection('fichas_tecnicas');
        }
        if (isset($adjuntos['eliminar_otro_documento']) &&
            $adjuntos['eliminar_otro_documento'] == true) {
            $producto->clearMediaCollection('otros_documentos');
        }
        if (isset($adjuntos['otro_documento_file'])) {
            $producto->clearMediaCollection('otros_documentos');
            $producto->addMedia($adjuntos['otro_documento_file'])->toMediaCollection('otros_documentos');
        }
    }

    public function obtieneNumProductosPorProveedor(int $personaId): int
    {
        return DB::table('productos AS p')
                    ->join('cat_productos AS cp', 'p.id_cat_productos', 'p.id')
                    ->join('personas AS per', 'cp.id_persona', 'per.id')
                    ->where('per.id', $personaId)
                    // Se filtran registros de productos que por alguna razón no se completaron
                    ->where('p.registro_fase', '>=', RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS)
                    ->count();
    }

    public static function obtieneCapitulos()
    {
        return DB::table('cat_capitulos')->pluck('numero');
    }

    /**
     * Optiene expresión de subquery para obtener el número de favoritos de productos.
     */
    private function subqueryProductoFavoritos(): Expression
    {
        $productoClass = Producto::class;
        return DB::raw("(SELECT COUNT(markable_id) FROM markable_favorites WHERE markable_id = productos.id AND markable_type = '{$productoClass}') AS num_favoritos");
    }
}
