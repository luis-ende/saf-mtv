<?php

namespace App\Imports;

use App\Models\ComprasDetalle;
use App\Repositories\CalendarioComprasRepository;
use App\Repositories\OportunidadNegocioRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ComprasDetalleImport implements ToModel, WithHeadingRow
{
    private Collection $calendarioUnidadesC;
    private Collection $tiposContratacion;

    public function __construct(CalendarioComprasRepository $calendarioRepo,
                                OportunidadNegocioRepository $opnRepo)
    {
        $this->calendarioUnidadesC =
            $calendarioRepo->obtieneCalendarioUnidadesCompradoras();
        $this->tiposContratacion = $opnRepo->obtieneTiposContratacion();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $nombreURG = $row['nombre_urg'];
        $calendarioUC = $this->calendarioUnidadesC->first(function (object $value, int $key) use($nombreURG) {
            similar_text(strtolower($nombreURG), strtolower($value->unidad_compradora), $perc);

            return $perc > 75;
        });

        // TODO Agregar tipo de contratación 'SERVICIO INTEGRAL'?
        $tipoContrBienesId = $this->tiposContratacion->where('tipo', '=', 'Adquisición de Bienes')->value('id');
        $tipoContrServiciosId = $this->tiposContratacion->where('tipo', '=', 'Prestación de Servicios')->value('id');

        if ($calendarioUC) {
            return new ComprasDetalle([
                'id_calendario_compras' => $calendarioUC->id,
                'objeto_contratacion' => $row['objeto_contratacion_proyectado'],
                'metodo_contr_proyectado' => $row['procedimiento_contratacion_proyectado'],
                'contratacion_mipymes' => $row['contratacion_a_mipymes'] === 'SI',
                'fecha_estimada_procedimiento' => Carbon::createFromFormat('d-m-Y', $row['fecha_estimada_procedimiento_contratacion']),
                'fecha_estimada_inicio_contr' => Carbon::createFromFormat('d-m-Y', $row['fecha_estimada_inicio_vigencia_contrato']),
                'fecha_estimada_fin_contr' => Carbon::createFromFormat('d-m-Y', $row['fecha_estimada_fin_contrato']),
                'id_tipo_contratacion' => $row['tipo_de_contratacion'] === 'BIEN' ? $tipoContrBienesId : $tipoContrServiciosId,
            ]);
        }
    }
}
