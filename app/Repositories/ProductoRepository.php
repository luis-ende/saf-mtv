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
        return Producto::select('productos.id', 'productos.tipo', 'productos.id_cabms', 'productos.nombre', 
                                'productos.descripcion', 'cat_cabms.cabms', 'cat_cabms.partida')
                            ->leftJoin('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')                            
                            ->where('id_cat_productos', '=', $catalogoProductosId)                            
                            ->orderBy('tipo')
                            ->orderBy('nombre')
                            ->get();                            
    }
}
