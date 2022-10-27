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

        return view('catalogo-productos', ['productosPersona' => $productosPersona]);
    }
}
