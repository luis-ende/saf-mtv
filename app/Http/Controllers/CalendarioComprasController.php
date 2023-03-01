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
        $totales = $calendarioRepo->obtieneCalendarioTotales($compras);
        $total_procedimientos = $totales['totalProcedimientos'];
        $total_presupuesto_aprobado = $totales['totalPresupuestoAprobado'];

        return view('calendario-compras.index',
                    compact('compras', 'total_procedimientos', 'total_presupuesto_aprobado'));
    }
}