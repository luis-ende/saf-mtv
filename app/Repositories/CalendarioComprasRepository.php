<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Clase repositorio para oportunidades de negocio.
 */
class CalendarioComprasRepository
{
    public function obtieneCalendarioCompras(): array
    {
        return DB::table('calendario_compras AS cc')
                    ->select('cc.id', 'cc.id_unidad_compradora', 'cc.presup_contratacion_aprobado',
                             'cc.total_procedimientos', 'cuc.nombre AS unidad_compradora')
                    ->join('cat_unidades_compradoras AS cuc', 'cuc.id', 'cc.id_unidad_compradora')
                    ->orderBy('unidad_compradora')
                    ->get()
                    ->toArray();
    }
}