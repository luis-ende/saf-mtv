<?php

namespace App\Repositories;

use App\Models\Producto;
use App\Services\RegistroProductosService;
use Illuminate\Support\Facades\DB;

class ProductoRepository
{
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
                                      'cat_cabms.cabms', 'cat_cabms.partida')
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

    public function buscaProductosPorTermino(string $terminoBusqueda)
    {
        $terminoBusqueda = strtolower($terminoBusqueda);
        $productos = Producto::select('productos.id', 'productos.id_cat_productos', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                      'cat_cabms.cabms', 'cat_cabms.partida',
                                      'perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio')
                                        ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
                                        ->leftJoin('cat_productos', 'cat_productos.id', '=', 'productos.id_cat_productos')
                                        ->leftJoin('perfil_negocio', 'perfil_negocio.id_persona', '=', 'cat_productos.id_persona')
                                        // Se filtran registros de productos que por alguna razón no se completaron
                                        ->where([
                                            ['registro_fase', '>=', RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS],
                                            [DB::raw('LOWER(productos.nombre)'), 'like', '%' . $terminoBusqueda . '%'],
                                        ])
                                        ->orWhere(DB::raw('LOWER(cat_cabms.nombre_cabms)'), 'like', '%' . $terminoBusqueda . '%')
                                        ->orWhere(DB::raw('cat_cabms.cabms'), $terminoBusqueda)
                                        ->orderBy('nombre')
                                        ->limit(100)
                                        ->get();

        // TODO Obtener información en join!
        $productos->each(function (&$producto) {
            $producto['foto_info'] = $producto->getFirstMedia('fotos');
        });

        return $productos;
    }

    public function obtieneProductoInfo(int $productoId, bool $conProveedor = false)
    {
        $query = Producto::select('productos.id', 'productos.id_cat_productos', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                'productos.descripcion', 'productos.marca', 'productos.modelo', 'productos.color',
                                'productos.material', 'productos.codigo_barras',
                                'cat_cabms.cabms', 'cat_cabms.nombre_cabms', 'cat_cabms.partida', 'cat_cabms.id_categoria_scian')
                                ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms');

        if ($conProveedor) {
            $query = $query->addSelect('perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio')
                           ->leftJoin('cat_productos', 'cat_productos.id', '=', 'productos.id_cat_productos')
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

    public function obtieneNumeroProductosRegistrados()
    {
        return DB::table('productos')->count();
    }

    public function actualizaProducto(Producto $producto, array $productoData, ?array $categorias, array $fotosInfo, array $adjuntos) {
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


    public function obtieneProductosPorCategoriasSCIAN(array $categorias)
    {
        $productos = Producto::select('productos.id', 'productos.tipo', 'productos.id_cabms', 'productos.nombre',
                                      'cat_cabms.cabms', 'cat_cabms.partida',
                                      'perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio')
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
}
