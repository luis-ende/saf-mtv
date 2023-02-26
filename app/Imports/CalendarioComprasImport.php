<?php

namespace App\Imports;

use App\Models\CalendarioCompras;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Repositories\OportunidadNegocioRepository;
use Illuminate\Support\Collection;

class CalendarioComprasImport implements ToModel, WithHeadingRow
{
    private Collection $unidadesCompradoras;

    public function __construct(OportunidadNegocioRepository $oportunidadRepo)
    {
        $this->unidadesCompradoras = $oportunidadRepo->obtieneInstitucionesCompradoras();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $nombreURG = $row['nombre_urg'];
        $unidadCompradora = $this->unidadesCompradoras->first(function (object $value, int $key) use($nombreURG) {
            similar_text(strtolower($nombreURG), strtolower($value->nombre), $perc);

            return $perc > 75;
        });

        // TODO Agregar unidad compradora si no existe

        $presupContrAprobado = str_replace('$', '', $row['presupuesto_contratacion_aprobado']);
        $presupContrAprobado = str_replace(',', '', $presupContrAprobado);

        if ($unidadCompradora) {
            return new CalendarioCompras([
                'id_unidad_compradora' => $unidadCompradora->id,
                'presup_contratacion_aprobado' => $presupContrAprobado,
                'total_procedimientos' => $row['total_procedimientos'],
            ]);
        }
    }
}
