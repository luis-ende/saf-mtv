<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CatalogoProductos;

class CatalogoProductosController extends Controller
{
     /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $productosPersona = Auth::user()->persona->catalogoProductos->productos;

        return view('catalogo-productos', [
            'productosPersona' => $productosPersona,
        ]);
    }

    public function showRegistroInicio()
    {
        return view('catalogo-productos.inicio-tipo-carga');
    }

    public function showAltaProducto1()
    {
        return view('catalogo-productos.alta-producto-1');
    }
    public function showAltaProducto2()
    {
        return view('catalogo-productos.alta-producto-2');
    }
    public function showAltaProducto3()
    {
        return view('catalogo-productos.alta-producto-3');
    }
    public function showAltaProducto4()
    {
        return view('catalogo-productos.alta-producto-4');
    }

}
