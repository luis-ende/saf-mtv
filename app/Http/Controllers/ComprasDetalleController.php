<?php

namespace App\Http\Controllers;

use App\Models\CalendarioCompras;
use App\Repositories\CalendarioComprasRepository;
use Illuminate\Http\Request;

class ComprasDetalleController extends Controller
{
    public function index(Request $request,
                          CalendarioCompras $calendarioItem,
                          CalendarioComprasRepository $calendarioRepo)
    {
        $calendario_item = $calendarioRepo->obtieneCalendarioItem($calendarioItem->id);
        $procedimientos = $calendarioRepo->obtieneComprasDetalles($calendarioItem->id);

        return view('compras-detalle.index', compact('procedimientos', 'calendario_item'));
    }
}
