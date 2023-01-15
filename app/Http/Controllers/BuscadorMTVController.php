<?php

namespace App\Http\Controllers;

use App\Repositories\PerfilNegocioRepository;
use Illuminate\Http\Request;
use App\Repositories\ProductoRepository;
use Illuminate\Validation\Rule;

/**
 * Controlador para las búsquedas de productos y proveedores.
 */
class BuscadorMTVController extends Controller
{
    public function index(ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo, ?string $tipoBusqueda = 'productos')
    {
        list($num_productos_registrados, $num_proveedores_registrados) =
            $this->productosProveedoresRegistrados($productoRepo, $perfNegRepo);
        $tipo_busqueda = $tipoBusqueda ?? 'productos';

        return view('catalogo-productos.search-index', compact('num_productos_registrados',
                                                                'num_proveedores_registrados',
                                                                           'tipo_busqueda'));
    }

    public function search(Request $request, ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo)
    {
        $this->validate($request, [
            'productos_search' => 'string',
            'proveedores_search' => 'string',
            'tipo_busqueda' => [
                'required',
                Rule::in(['productos', 'proveedores']),
            ],
        ]);

        $tipoBusqueda = $request->input('tipo_busqueda');

        $busquedaTermino = '';
        if ($tipoBusqueda === 'productos') {
            $busquedaTermino = $request->input('productos_search');
        } elseif ($tipoBusqueda === 'proveedores') {
            $busquedaTermino = $request->input('proveedores_search');
        }

        $resultadosBusqueda = [];
        if ($busquedaTermino) {
            if ($tipoBusqueda === 'productos') {
                $resultadosBusqueda = $productoRepo->buscaProductosPorTermino($busquedaTermino);
            }

            if ($tipoBusqueda === 'proveedores') {
                $resultadosBusqueda = $perfNegRepo->buscaProveedoresPorTermino($busquedaTermino);
            }
        }

        list($num_productos_registrados, $num_proveedores_registrados) =
            $this->productosProveedoresRegistrados($productoRepo, $perfNegRepo);

        return view('catalogo-productos.search-index', [
            'term_busqueda' => $busquedaTermino,
            'num_productos_registrados' => $num_productos_registrados,
            'num_proveedores_registrados' => $num_proveedores_registrados,
            'num_resultados' => count($resultadosBusqueda),
            'resultados' => $resultadosBusqueda,
            'tipo_busqueda' => $request->input('tipo_busqueda'),
        ]);
    }

    private function productosProveedoresRegistrados(ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo)
    {
        return [
            $productoRepo->obtieneNumeroProductosRegistrados(),
            $perfNegRepo->obtieneNumeroProveedoresRegistrados(),
        ];
    }
}
