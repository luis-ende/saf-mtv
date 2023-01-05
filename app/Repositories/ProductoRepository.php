<?php

namespace App\Repositories;

use App\Models\Producto;
use App\Models\CatalogoProductos;
use Illuminate\Support\Facades\DB;

class ProductoRepository
{
    /**
     * Obtiene producto con nombre CAMBS y lista de categorías SCIAN asociadas.
     */
    public function obtieneProductoCABMSCategorias(int $productoId)
    {
        $producto = DB::table('productos')
            ->select('productos.id', 'productos.tipo', 'productos.id_cabms', 'cat_cabms.nombre_cabms')
            ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
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
}
