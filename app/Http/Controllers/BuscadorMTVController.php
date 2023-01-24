<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
//use App\Models\CategoriaScian;
use App\Models\Sector;
use App\Repositories\CatAsentamientosRepository;
use App\Repositories\GrupoPrioritarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
        list($resultadosBusqueda, $busquedaTermino) =
            $this->buscaProductosOProveedores($request, $productoRepo, $perfNegRepo);

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
            //'categorias' => CategoriaScian::all(),
            'alcaldias' => CatAsentamientosRepository::obtieneAcaldias(),
            'partidas' => DB::table('cat_cabms')->distinct()
                                                ->orderBy('partida')
                                                ->pluck('partida'),
            'capitulos' => Capitulo::CABMS_CAPITULOS,
            'grupos_prioritarios' => GrupoPrioritarioRepository::obtieneGruposPrioritarios(),            
            'padron_prov_estatus' => array_filter(PadronProveedoresService::ETAPAS_PADRON_PROVEEDORES, function($v, $k) {
                return $k === 4 || $k === 7;
            }, ARRAY_FILTER_USE_BOTH),
        ];
    }

    /**
     * Devuelve las tarjetas de más resultados (productos o proveedores) encontrados (para infinite scroll de la búsqueda).
     */
    public function getItemsCards(Request $request, ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo)
    {
        list($resultadosBusqueda) =
            $this->buscaProductosOProveedores($request, $productoRepo, $perfNegRepo);

        $tipoBusqueda = $request->input('tipo_busqueda');
        $modo = 'busqueda';

        if (request()->ajax()) {
            if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS) {
                $productos = $resultadosBusqueda;

                return View::make('components.productos.productos-cards',
                    compact('modo','productos'))->render();
            }

            if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES) {
                $proveedores = $resultadosBusqueda;

                return View::make('components.proveedores.proveedores-cards',
                    compact('modo','proveedores'))->render();
            }
        }

        return [
            'error' => 'Tipo de busqueda no reconocida.',
        ];
    }

    private function buscaProductosOProveedores(Request $request, ProductoRepository $productoRepo, PerfilNegocioRepository $perfNegRepo): array
    {
        $this->validate($request, [
            'productos_search' => 'nullable|string',
            'proveedores_search' => 'nullable|string',
            'tipo_busqueda' => [
                'required',
                Rule::in([BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS,
                          BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES]),
            ],
            'offset' => 'integer',
        ]);

        $filtros = [];
        $tipoBusqueda = $request->input('tipo_busqueda');

        if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS) {
            $this->convierteFiltro($request, 'capitulo_filtro');
            $this->convierteFiltro($request, 'partida_filtro');
            $this->convierteFiltro($request, 'sector_filtro');

            $this->validate($request, [
                'sort_productos' => [Rule::in(['nombre', 'cabms', 'partida'])],
                'capitulo_filtro' => 'array',
                'partida_filtro' => 'array',
                'sector_filtro' => 'array',
            ]);

            $filtros = $request->only('sort_productos', 'capitulo_filtro', 'partida_filtro', 'sector_filtro');
        } elseif($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES) {
            $this->convierteFiltro($request, 'sector_prov_filtro');
            $this->convierteFiltro($request, 'alcaldia_filtro');
            // $this->convierteFiltro($request, 'categoria_filtro');
            $this->convierteFiltro($request, 'grupo_p_filtro');

            $this->validate($request, [
                // 'sort_proveedores' => [Rule::in(['nombre_negocio', 'sector', 'categoria_scian'])],
                'sort_proveedores' => [Rule::in(['nombre_negocio', 'sector', 'categoria_scian'])],
                'sector_prov_filtro' => 'array',
                'alcaldia_filtro' => 'array',
                // 'categoria_filtro' => 'array',
                'grupo_p_filtro' => 'array',
            ]);

            // $filtros = $request->only('sort_proveedores', 'sector_prov_filtro', 'categoria_filtro', 'grupo_p_filtro');
            $filtros = $request->only('sort_proveedores', 'sector_prov_filtro', 'alcaldia_filtro', 'grupo_p_filtro');
        }

        $busquedaTermino = '';
        if ($tipoBusqueda === 'productos') {
            $busquedaTermino = $request->input('productos_search');
        } elseif ($tipoBusqueda === 'proveedores') {
            $busquedaTermino = $request->input('proveedores_search');
        }

        $offset = 0;
        if ($request->has('offset')) {
            $offset = $request->integer('offset');
        }
        $resultadosBusqueda = [];
        if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PRODUCTOS) {
            $resultadosBusqueda = $productoRepo->buscaProductosPorTermino($busquedaTermino, $filtros, $offset);
        }

        if ($tipoBusqueda === BuscadorMTVService::TIPO_BUSQUEDA_PROVEEDORES) {
            $resultadosBusqueda = $perfNegRepo->buscaProveedoresPorTermino($busquedaTermino, $filtros);
        }

        return [
            $resultadosBusqueda,
            $busquedaTermino,
        ];
    }

    /**
     * Convierte un parámetro filtro a array si es de tipo string.
     */
    private function convierteFiltro(Request $request, string $key): void
    {
        if ($request->has($key) && !is_array($request->input($key))) {
            $request->merge([
                $key => explode(',', $request->input($key))
            ]);
        }
    }
}
