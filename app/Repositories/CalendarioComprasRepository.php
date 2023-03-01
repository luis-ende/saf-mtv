<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

/**
 * Clase repositorio para calendario de compras y detalle (procedimientos).
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

    public function obtieneCalendarioTotales(array $items): array
    {
        $totalProcedimientos = 0;
        $totalPresupuestoAprobado = 0;
        foreach ($items as $item) {
            $totalProcedimientos += $item->total_procedimientos;
            $totalPresupuestoAprobado += $item->presup_contratacion_aprobado;
        }

        $totalProcedimientos = number_format($totalProcedimientos, 0);
        $totalPresupuestoAprobado = '$' . number_format(((double) $totalPresupuestoAprobado), 2);

        return compact('totalProcedimientos', 'totalPresupuestoAprobado');
    }

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
        $totalPresupAprobado = array_reduce($procedimientos, function($suma, $proc) {
            $suma += $proc->valor_estimado_contratacion;
            
            return $suma;
        });

        $totalPresupAprobado = '$' . number_format(((double) $totalPresupAprobado), 2);

        return [
            'total_procedimientos' => count($procedimientos),
            'presup_contratacion_aprobado' => $totalPresupAprobado,
        ]; 
    }
}