<?php

namespace App\Http\Controllers;

use App\Models\CalendarioCompras;
use App\Repositories\CalendarioComprasRepository;
use App\Repositories\OportunidadNegocioRepository;
use Illuminate\Http\Request;

class ComprasDetalleController extends Controller
{
    public function index(Request $request,
                          int $unidad_compradora,
                          CalendarioComprasRepository $calendarioRepo,
                          OportunidadNegocioRepository $opnRepo)
    {        
        $procedimientos = $calendarioRepo->obtieneComprasDetalles($unidad_compradora);        
        $totales = $calendarioRepo->obtieneProcedimientosTotales($procedimientos);
        $unidad_compradora = $opnRepo->obtieneInstitucionesCompradoras()->firstWhere('id', $unidad_compradora);

        return view('compras-detalle.index', compact('procedimientos', 'totales', 'unidad_compradora'));
    }
}
