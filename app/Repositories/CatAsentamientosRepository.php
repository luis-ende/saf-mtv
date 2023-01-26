<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CatAsentamientosRepository
{    
    public static function obtieneAcaldias()
    {
        return DB::table('cat_asentamientos')->select('id_municipio as id', 'municipio as alcaldia')
                                             ->distinct()
                                             ->orderBy('municipio')
                                             ->get();
    }    

    public function buscaCPAsentamiento(string $cp): array
    {        
        $asentamientos = DB::table('cat_asentamientos')
                            ->select('id', 'asentamiento as colonia', 'municipio as alcaldia', 'entidad')
                            ->where('cp', $cp)
                            ->get()
                            ->toArray();        

        return $asentamientos;
    }

    public function buscaAsentamientoInfo(int $idAsentamiento)
    {        
        $asentamiento = DB::table('cat_asentamientos')
                            ->select('cp', 'entidad', 'ciudad', 'municipio')
                            ->where('id', $idAsentamiento)
                            ->get()
                            ->firstOrFail();

        return $asentamiento;        
    }
}
