<?php

namespace App\Http\Controllers;

use App\Models\CategoriaScian;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Services\BuscadorMTVService;
use App\Repositories\ProductoRepository;
use App\Repositories\PerfilNegocioRepository;

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

        $filtros_opciones = $this->obtieneFiltrosOpciones();

        return view('catalogo-productos.search-index', compact('num_productos_registrados',
                                                                'num_proveedores_registrados',
                                                                           'tipo_busqueda', 'filtros_opciones'));
    }

    public function search(Request $request, ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo)
    {
        $this->validate($request, [
            'productos_search' => 'string',
            'proveedores_search' => 'string',
            'tipo_busqueda' => [
                'required',
                Rule::in([BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS,
                          BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES]),
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
            if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS) {
                $resultadosBusqueda = $productoRepo->buscaProductosPorTermino($busquedaTermino);
            }

            if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES) {
                $resultadosBusqueda = $perfNegRepo->buscaProveedoresPorTermino($busquedaTermino);
            }
        }

        list($num_productos_registrados, $num_proveedores_registrados) =
            $this->productosProveedoresRegistrados($productoRepo, $perfNegRepo);

        $filtros_opciones = $this->obtieneFiltrosOpciones();

        return view('catalogo-productos.search-index', [
            'term_busqueda' => $busquedaTermino,
            'num_productos_registrados' => $num_productos_registrados,
            'num_proveedores_registrados' => $num_proveedores_registrados,
            'num_resultados' => count($resultadosBusqueda),
            'resultados' => $resultadosBusqueda,
            'tipo_busqueda' => $request->input('tipo_busqueda'),
            'filtros_opciones' => $filtros_opciones,
        ]);
    }

    private function productosProveedoresRegistrados(ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo)
    {
        return [
            $productoRepo->obtieneNumeroProductosRegistrados(),
            $perfNegRepo->obtieneNumeroProveedoresRegistrados(),
        ];
    }

    private function obtieneFiltrosOpciones(): array
    {
        return [
            'sectores' => Sector::all(),
            'categorias' => CategoriaScian::all(),
            'partidas' => DB::table('cat_cabms')->distinct()
                                                    ->orderBy('partida')
                                                    ->pluck('partida'),
        ];
    }
}
