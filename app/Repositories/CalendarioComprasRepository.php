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
        $compras = DB::table('calendario_compras AS cc')
                    ->select('cc.id', 'cc.id_unidad_compradora',
                        DB::raw('CAST(cc.presup_contratacion_aprobado AS DECIMAL(12,2))'),
                             'cc.total_procedimientos', 'cuc.nombre AS unidad_compradora')
                    ->join('cat_unidades_compradoras AS cuc', 'cuc.id', 'cc.id_unidad_compradora')
                    ->orderBy('unidad_compradora')
                    ->get()
                    ->toArray();

        foreach ($compras as $row) {
            $row->presup_contratacion_aprobado = (double) $row->presup_contratacion_aprobado;
        }

        return $compras;
    }

    public function obtieneCalendarioItem($id)
    {
        $row = DB::table('calendario_compras AS cc')
                    ->select('cc.id', DB::raw('CAST(cc.presup_contratacion_aprobado AS DECIMAL(12,2))'),
                                     'cc.id_unidad_compradora', 'cuc.nombre AS unidad_compradora')
                    ->join('cat_unidades_compradoras AS cuc', 'cuc.id', 'cc.id_unidad_compradora')
                    ->where('cc.id', $id)
                    ->first();

        if ($row) {
            $row->presup_contratacion_aprobado =
                '$' . number_format(((double) $row->presup_contratacion_aprobado), 2);

            return $row;
        }

        return null;
    }

    public function obtieneComprasDetalles(int $calendarioItemId): array
    {
        return DB::table('compras_detalle AS cd')
            ->select('cd.objeto_contratacion', 'cd.contratacion_mipymes',
                'cd.metodo_contr_proyectado',
                DB::raw("TO_CHAR(cd.fecha_estimada_procedimiento, 'dd/mm/yyyy') AS fecha_estimada_procedimiento"),
                DB::raw("TO_CHAR(cd.fecha_estimada_inicio_contr, 'dd/mm/yyyy') AS fecha_estimada_inicio_contr"),
                DB::raw("TO_CHAR(cd.fecha_estimada_fin_contr, 'dd/mm/yyyy') AS fecha_estimada_fin_contr"),
                'ctc.tipo AS tipo_contratacion')
            ->leftJoin('cat_tipos_contratacion AS ctc', 'cd.id_tipo_contratacion', 'ctc.id')
            ->where('id_calendario_compras', $calendarioItemId)
            ->get()
            ->toArray();
    }

    public function obtieneCalendarioUnidadesCompradoras(): Collection
    {
        return DB::table('calendario_compras AS cc')
                    ->select('cc.id', 'cc.id_unidad_compradora', 'cuc.nombre as unidad_compradora')
                    ->join('cat_unidades_compradoras AS cuc', 'cc.id_unidad_compradora', 'cuc.id')
                    ->get();
    }
}