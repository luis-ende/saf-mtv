<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprasDetalleController extends Controller
{
    public function index(Request $request, int $unidad) 
    {
        $detalles = [];

        return view('compras-detalle.index', compact('detalles'));
    }
}
