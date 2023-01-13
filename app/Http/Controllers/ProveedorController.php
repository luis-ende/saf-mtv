<?php

namespace App\Http\Controllers;

use App\Models\CatalogoProductos;
use App\Models\Producto;
use App\Repositories\PerfilNegocioRepository;
use App\Repositories\ProductoRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProveedorController extends Controller
{
    public function showProducto(int $productoId, ProductoRepository $productoRepo) 
    {
        $productoInfo = $productoRepo->obtieneProductoInfo($productoId, true);
        $productoInfo['fotos_info'] = $productoInfo->getMedia('fotos');
        $productoInfo['ficha_tecnica'] = $productoInfo->getFirstMedia('fichas_tecnicas');
        $productoInfo['otro_documento'] = $productoInfo->getFirstMedia('otros_documentos');

        return view('productos.views.view-guest', [
            'producto' => $productoInfo,
        ]);
    }

    public function showCatalogoProductos(int $catalogoId, ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo) 
    {
        $catProductos = CatalogoProductos::select('id_persona')->where('id', $catalogoId)->firstOrFail();
        
        $proveedorInfo = $perfNegRepo->obtieneDatosProveedor($catProductos->id_persona);

        $productos = $productoRepo->obtieneProductosPorCatalogo($catalogoId);

        $productosBien = $productos->filter(function ($producto) {
            return $producto->tipo === Producto::TIPO_PRODUCTO_BIEN_ID;
        });
        $productosServicio = $productos->filter(function ($producto) {
            return $producto->tipo === Producto::TIPO_PRODUCTO_SERVICIO_ID;
        });        

        return view('proveedor.catalogo-productos', [
            'proveedor' => $proveedorInfo,
            'productos_bien' => $productosBien,
            'productos_servicio' => $productosServicio,
        ]);
    }
}