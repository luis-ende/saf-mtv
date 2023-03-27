<?php declare(strict_types = 1);

namespace App\Services\CalendarioCompras;

use App\Imports\CalendarioComprasImport;
use App\Imports\ComprasDetalleImport;
use App\Repositories\CalendarioComprasRepository;
use App\Repositories\OportunidadNegocioRepository;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Clase para procedimientos de compras desde un archivo csv.
 */
class PlaneacionAnualService 
{
    public function importaAnaliticoProcedimientos(string $csvFilePath)
    {
        Excel::import(new ComprasDetalleImport(new OportunidadNegocioRepository()),
                     $csvFilePath);
    }
}