<?php declare(strict_types = 1);

namespace App\Services\CalendarioCompras;

use App\Imports\CalendarioComprasImport;
use App\Repositories\OportunidadNegocioRepository;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Clase para procesar la importación de la planeación anual descargada de la página de Contrataciones abiertas de la CDMX.  
 * 
 * Ver: https://brandmestudio-test.com/contrataciones-abiertas?page=1
 */
class PlaneacionAnualService 
{
    public function importaPlaneacionAnual(string $csvFilePath) 
    {
        Excel::import(new CalendarioComprasImport(new OportunidadNegocioRepository()), $csvFilePath);
    }    
}