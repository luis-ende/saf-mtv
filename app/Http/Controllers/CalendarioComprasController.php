<?php

namespace App\Http\Controllers;

use App\Repositories\CalendarioComprasRepository;
use Illuminate\Http\Request;

class CalendarioComprasController extends Controller
{
/**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, CalendarioComprasRepository $calendarioRepo)
    {
        $compras = $calendarioRepo->obtieneCalendarioCompras();
        foreach ($compras as $row) {
            $row->presup_contratacion_aprobado = (double) $row->presup_contratacion_aprobado;
        }

        return view('calendario-compras.index', compact('compras'));
    }
}