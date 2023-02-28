<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase repositorio para oportunidades de negocio.
 */
class CalendarioComprasRepository
{
    public function obtieneCalendarioCompras(): array
    {
        $compras = DB::table('compras_procedimientos AS cp')
                    ->select(DB::raw('ROW_NUMBER() OVER (order by cuc.nombre) AS id'), 
                             'cuc.nombre as unidad_compradora',
                             'cp.id_unidad_compradora', 
                             DB::raw('SUM(cp.valor_estimado_contratacion) AS presup_contratacion_aprobado'),
                             DB::raw('(SELECT COUNT(*) FROM compras_procedimientos WHERE compras_procedimientos.id_unidad_compradora = cuc.id) AS total_procedimientos'))
                    ->leftJoin('cat_unidades_compradoras AS cuc', 'cuc.id', 'cp.id_unidad_compradora')
                    ->groupByRaw('cuc.nombre, cp.id_unidad_compradora, total_procedimientos')
                    ->orderBy('unidad_compradora')
                    ->get()
                    ->toArray();        

        foreach ($compras as $row) {
            $row->presup_contratacion_aprobado = (double) $row->presup_contratacion_aprobado;
        }

        return $compras;
    }

    // public function obtieneCalendarioItem($id)
    // {
    //     $row = DB::table('calendario_compras AS cc')
    //                 ->select('cc.id', DB::raw('CAST(cc.presup_contratacion_aprobado AS DECIMAL(12,2))'),
    //                                  'cc.id_unidad_compradora', 'cuc.nombre AS unidad_compradora')
    //                 ->join('cat_unidades_compradoras AS cuc', 'cuc.id', 'cc.id_unidad_compradora')
    //                 ->where('cc.id', $id)
    //                 ->first();

    //     if ($row) {
    //         $row->presup_contratacion_aprobado =
    //             '$' . number_format(((double) $row->presup_contratacion_aprobado), 2);

    //         return $row;
    //     }

    //     return null;
    // }

    public function obtieneComprasDetalles(int $unidadCompradoraId): array
    {
        return DB::table('compras_procedimientos AS cp')
            ->select('cp.objeto_contratacion', 'cp.contratacion_mipymes',
                     'cp.metodo_contr_proyectado',
                     DB::raw('CAST(cp.valor_estimado_contratacion AS DECIMAL(12,2))'),
                     DB::raw("TO_CHAR(cp.fecha_estimada_procedimiento, 'dd/mm/yyyy') AS fecha_estimada_procedimiento"),
                     DB::raw("TO_CHAR(cp.fecha_estimada_inicio_contr, 'dd/mm/yyyy') AS fecha_estimada_inicio_contr"),
                     DB::raw("TO_CHAR(cp.fecha_estimada_fin_contr, 'dd/mm/yyyy') AS fecha_estimada_fin_contr"),
                'ctc.tipo AS tipo_contratacion')
            ->leftJoin('cat_tipos_contratacion AS ctc', 'cp.id_tipo_contratacion', 'ctc.id')            
            ->where('cp.id_unidad_compradora', $unidadCompradoraId)
            ->get()
            ->toArray();
    }

    public function obtieneProcedimientosTotales(array $procedimientos): array 
    {
        $totalPresupAprobado = array_reduce($procedimientos, function($carry, $proc) {
            $carry += $proc->valor_estimado_contratacion;
            
            return $carry;
        });

        $totalPresupAprobado = '$' . number_format(((double) $totalPresupAprobado), 2);

        return [
            'total_procedimientos' => count($procedimientos),
            'presup_contratacion_aprobado' => $totalPresupAprobado,
        ]; 
    }

    // public function obtieneCalendarioUnidadesCompradoras(): Collection
    // {
    //     return DB::table('calendario_compras AS cc')
    //                 ->select('cc.id', 'cc.id_unidad_compradora', 'cuc.nombre as unidad_compradora')
    //                 ->join('cat_unidades_compradoras AS cuc', 'cc.id_unidad_compradora', 'cuc.id')
    //                 ->get();
    // }
}