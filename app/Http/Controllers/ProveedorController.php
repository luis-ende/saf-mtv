<?php

namespace App\Http\Controllers;

use App\Models\CatalogoProductos;
use App\Models\CategoriaScian;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\Sector;
use App\Repositories\PerfilNegocioRepository;
use App\Repositories\ProductoRepository;

class ProveedorController extends Controller
{
    public function showProducto(int $productoId, ProductoRepository $productoRepo)
    {
        $productoInfo = $productoRepo->obtieneProductoInfo($productoId, true);
        $productoInfo['fotos_info'] = $productoInfo->getMedia('fotos');
        $productoInfo['ficha_tecnica'] = $productoInfo->getFirstMedia('fichas_tecnicas');
        $productoInfo['otro_documento'] = $productoInfo->getFirstMedia('otros_documentos');

        $categoriasScian = $productoRepo->obtieneProductoCategorias($productoInfo);
        $productosRelacionados = $productoRepo->obtieneProductosPorCategoriasSCIAN($categoriasScian);

        return view('productos.views.view-guest', [
            'producto' => $productoInfo,
            'productos_relacionados' => $productosRelacionados,
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

    public function showPerfilNegocio(int $personaId)
    {
        $persona = Persona::findOrFail($personaId);
        $sector = Sector::where('id', $persona->perfil_negocio->id_sector)->value('sector');
        $categoria_scian = CategoriaScian::where('id', $persona->perfil_negocio->id_categoria_scian)
                                            ->value('categoria_scian');
        $carta_presentacion = $persona->perfil_negocio->getFirstMedia('documentos');
        $catalogo_pdf = $persona->perfil_negocio->getFirstMedia('catalogos_pdf');

        return view('proveedor.perfil-negocio-info',
            compact('persona', 'sector', 'categoria_scian',
                             'carta_presentacion', 'catalogo_pdf'));
    }
}
