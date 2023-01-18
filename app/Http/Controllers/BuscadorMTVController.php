<?php

namespace App\Http\Controllers;

use App\Models\CategoriaScian;
use App\Models\Sector;
use App\Repositories\GrupoPrioritarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Services\BuscadorMTVService;
use App\Repositories\ProductoRepository;
use App\Repositories\PerfilNegocioRepository;
use App\Services\PadronProveedoresService;

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
            'productos_search' => 'nullable|string',
            'proveedores_search' => 'nullable|string',
            'tipo_busqueda' => [
                'required',
                Rule::in([BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS,
                          BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES]),
            ],
        ]);        

        $filtros = [];
        $tipoBusqueda = $request->input('tipo_busqueda');

        if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS) {
            $this->validate($request, [
                'sort_productos' => [Rule::in(['nombre', 'cabms', 'partida'])],
                'capitulo_filtro' => 'array',
                'partida_filtro' => 'array',
                'sector_filtro' => 'array',
            ]);

            $filtros = $request->only('sort_productos', 'capitulo_filtro', 'partida_filtro', 'sector_filtro');
        } elseif($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES) {
            $this->validate($request, [
                'sort_proveedores' => [Rule::in(['nombre_negocio', 'sector', 'categoria_scian'])],                
                'sector_prov_filtro' => 'array',
                'categoria_filtro' => 'array',
                'grupo_p_filtro' => 'array',
            ]);

            $filtros = $request->only('sort_proveedores', 'sector_prov_filtro', 'categoria_filtro', 'grupo_p_filtro');
        }

        $busquedaTermino = '';
        if ($tipoBusqueda === 'productos') {
            $busquedaTermino = $request->input('productos_search');
        } elseif ($tipoBusqueda === 'proveedores') {
            $busquedaTermino = $request->input('proveedores_search');
        }

        $resultadosBusqueda = [];        
        if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS) {
            $resultadosBusqueda = $productoRepo->buscaProductosPorTermino($busquedaTermino, $filtros);
        }

        if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES) {
            $resultadosBusqueda = $perfNegRepo->buscaProveedoresPorTermino($busquedaTermino, $filtros);
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
            'capitulos' => [1000, 2000, 3000, 4000, 5000],
            'grupos_prioritarios' => GrupoPrioritarioRepository::obtieneGruposPrioritarios(),            
            'padron_prov_estatus' => array_filter(PadronProveedoresService::ETAPAS_PADRON_PROVEEDORES, function($v, $k) {
                return $k === 4 || $k === 7;
            }, ARRAY_FILTER_USE_BOTH),
        ];
    }
}
