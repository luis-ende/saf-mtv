<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\CategoriaScian;
use App\Models\CatalogoProductos;
use App\Repositories\ProductoRepository;
use App\Repositories\PerfilNegocioRepository;
use App\Services\RedesSocialesEnlacesService;
use App\Services\ConsultaPadronProveedoresService;

class ProveedorController extends Controller
{
    public function showProducto(int $productoId, ProductoRepository $productoRepo)
    {
        $productoInfo = $productoRepo->obtieneProductoInfo($productoId, true);
        $productoInfo['fotos_info'] = $productoInfo->getMedia('fotos');
        $productoInfo['ficha_tecnica'] = $productoInfo->getFirstMedia('fichas_tecnicas');
        $productoInfo['otro_documento'] = $productoInfo->getFirstMedia('otros_documentos');

        $categoriasScian = $productoRepo->obtieneProductoCategorias($productoInfo);        
        $productosRelacionados = $productoRepo->obtieneProductosPorCategoriasSCIAN($categoriasScian)
                                              ->reject(function ($prod, $key) use($productoId) {
                                                return $prod->id === $productoId;
                                              });        

        return view('productos.views.view-guest', [
            'producto' => $productoInfo,
            'productos_relacionados' => $productosRelacionados,
        ]);
    }

    public function showCatalogoProductos(int $catalogoId, 
                                          ProductoRepository $productoRepo, 
                                          PerfilNegocioRepository $perfNegRepo, 
                                          ConsultaPadronProveedoresService $consultaPadron)
    {
        $catProductos = CatalogoProductos::select('id_persona')->where('id', $catalogoId)->firstOrFail();
        $proveedor = $perfNegRepo->obtieneDatosProveedor($catProductos->id_persona);
        $productos = $productoRepo->obtieneProductosPorCatalogo($catalogoId);
        $productos_bien = $productos->filter(function ($producto) {
            return $producto->tipo === Producto::TIPO_PRODUCTO_BIEN_ID;
        });
        $productos_servicio = $productos->filter(function ($producto) {
            return $producto->tipo === Producto::TIPO_PRODUCTO_SERVICIO_ID;
        });

        $etapa_padron_prov = $this->obtieneTextoEtapaProveedor($proveedor->persona->rfc);        
        
        $compartir_enlaces = RedesSocialesEnlacesService::generaEnlaces(url()->current(), 'Catálogo Mi Tiendita Virtual');    

        return view('proveedor.catalogo-productos', 
                    compact('proveedor', 'productos_bien', 'productos_servicio', 'etapa_padron_prov', 'compartir_enlaces'));
    }

    public function showPerfilNegocio(int $personaId)
    {
        $persona = Persona::findOrFail($personaId);
        $sector = Sector::where('id', $persona->perfil_negocio->id_sector)->value('sector');
        $categoria_scian = CategoriaScian::where('id', $persona->perfil_negocio->id_categoria_scian)
                                            ->value('categoria_scian');
        $carta_presentacion = $persona->perfil_negocio->getFirstMedia('documentos');
        $catalogo_pdf = $persona->perfil_negocio->getFirstMedia('catalogos_pdf');

        $etapa_padron_prov = $this->obtieneTextoEtapaProveedor($persona->rfc);

        return view('proveedor.perfil-negocio-info',
            compact('persona', 'sector', 'categoria_scian', 'etapa_padron_prov',
                    'carta_presentacion', 'catalogo_pdf'));
    }

    /**
     * Realiza consulta de etapa de solicitud en la que se encuentra un rfc asociado a un proveedor en el Padrón de Proveedores.
     */
    private function obtieneTextoEtapaProveedor(string $rfc): string
    {
        $consultaPadron = new ConsultaPadronProveedoresService();
        $etapa_padron_prov = $consultaPadron->consultaPadronProveedores($rfc);        

        return isset($etapa_padron_prov['etapa']) ? $etapa_padron_prov['etapa'] : '';
    }
}
