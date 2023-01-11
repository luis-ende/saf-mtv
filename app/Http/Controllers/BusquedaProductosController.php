<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProductoRepository;

class BusquedaProductosController extends Controller
{
    public function index(ProductoRepository $productoRepo)
    {
        return view('catalogo-productos.search-index', [
            'num_productos_registrados' => $productoRepo->obtieneNumeroProductosRegistrados(), // TODO: Obtener de cache
            'num_proveedores_registrados' => 1,
        ]);
    }

    public function search(Request $request, ProductoRepository $productoRepo) 
    {        
        $busquedaTermino = $request->input('productos_search');        
        $productos = $productoRepo->buscaProductosPorTermino($busquedaTermino);

        return view('catalogo-productos.search-index', [
            'term_busqueda' => $request->input('productos_search'),
            'num_productos_registrados' => $productoRepo->obtieneNumeroProductosRegistrados(), // TODO: Obtener de cache
            'num_proveedores_registrados' => 1,
            'num_resultados' => count($productos),
            'productos' => $productos,
        ]);
    }
}