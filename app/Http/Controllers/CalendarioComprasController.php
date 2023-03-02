<?php

namespace App\Http\Controllers;

use App\Exports\ComprasProcedimientosExport;
use App\Repositories\CalendarioComprasRepository;
use App\Repositories\OportunidadNegocioRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportComprasProcedimientosXls(Request $request,
                                                   CalendarioComprasRepository $calendarioRepo,
                                                   OportunidadNegocioRepository $opnRepo,
                                                   int $unidad_compradora)
    {
        $procedimientos = $calendarioRepo->obtieneComprasDetalles($unidad_compradora);
        $unidadCompradora = $opnRepo->obtieneInstitucionesCompradoras()->firstWhere('id', $unidad_compradora)->nombre;
        $archivoDescarga = $this->generaArchivoDescargaNombre($unidadCompradora) . '.xlsx';

        return Excel::download(new ComprasProcedimientosExport($procedimientos, $unidadCompradora),
                                $archivoDescarga,
                                \Maatwebsite\Excel\Excel::XLSX);
    }

    public function exportComprasProcedimientosPdf(Request $request,
                                                   CalendarioComprasRepository $calendarioRepo,
                                                   OportunidadNegocioRepository $opnRepo,
                                                   int $unidad_compradora)
    {
        $procedimientos = $calendarioRepo->obtieneComprasDetalles($unidad_compradora);
        $unidadCompradora = $opnRepo->obtieneInstitucionesCompradoras()->firstWhere('id', $unidad_compradora)->nombre;
        $archivoDescarga = $this->generaArchivoDescargaNombre($unidadCompradora) . '.pdf';
        $pdf = Pdf::loadView('exports.compras-procedimientos', [
            'procedimientos' => $procedimientos,
            'unidad_compradora' => $unidadCompradora
        ])->setPaper('a4', 'landscape');

        return $pdf->download($archivoDescarga);
    }

    private function generaArchivoDescargaNombre(string $unidadCompradora): string
    {
        $nombreArchivo = mb_strtolower($unidadCompradora);
        $descartados = [' de ', ' para ', ' del ', ' el ', ' los ', ' la ', ' las ', ' y '];
        $nombreArchivo = str_replace($descartados, ' ', $nombreArchivo);
        $acentos = ['á', 'é', 'í', 'ó', 'ú'];
        $acentosR = ['a', 'e', 'i', 'o', 'u'];
        $nombreArchivo = str_replace($acentos, $acentosR, $nombreArchivo);
        $abreviaturas = [' ciudad méxico', ' ciudad méxico '];
        $nombreArchivo = str_replace($abreviaturas, ' cdmx ', $nombreArchivo);
        $nombreArchivo = str_replace(' ', '_', $nombreArchivo);
        // Remover caracteres especiales
        $nombreArchivo = preg_replace('/[^A-Za-z0-9\_]/', '', $nombreArchivo);

        return 'mtv_programados_' . $nombreArchivo;
    }
}