<?php declare(strict_types = 1);

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BusquedaCPService
{
    public function buscaCPAsentamiento(string $cp): array
    {
        $asentamientos = [];
        
        if (env('APP_ENV') === 'local') {
            // TODO: Falta establecer fuente de datos del catálogo para producción
            $asentamientos = DB::table('cat_asentamientos')
                                ->select('id', 'asentamiento as colonia', 'municipio as alcaldia', 'entidad')
                                ->where('cp', $cp)
                                ->get()
                                ->toArray();
        }
        
        return $asentamientos;
    }
}
