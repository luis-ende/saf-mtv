<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProductoRepository
{
    /**
     * Obtiene producto con nombre CAMBS y lista de categorías SCIAN asociadas.
     */
    public function obtieneProductoCABMSCategorias(int $productoId)
    {
        $producto = DB::table('productos')
            ->select('productos.id', 'cat_cabms.nombre_cabms')
            ->join('cat_cabms', 'cat_cabms.id', '=', 'productos.id_cabms')
            ->where('productos.id', '=', $productoId)
            ->get();
        $nombre_cabms = isset($producto[0]) ? $producto[0]->nombre_cabms : '';

        $categorias = array_map(function($item) { return $item->categoria_scian; }, DB::table('productos_categorias')
            ->select('categoria_scian')
            ->join('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'productos_categorias.id_categoria_scian')
            ->where('productos_categorias.id_producto', '=', $productoId)
            ->get()
            ->toArray());        

        return [
            'id' => $productoId,
            'nombre_cabms' => $nombre_cabms,
            'categorias_scian' => implode(',', $categorias),
        ];
    }
}