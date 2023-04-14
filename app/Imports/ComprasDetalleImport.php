<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\ComprasProcedimiento;
use App\Models\UnidadCompradora;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Repositories\CalendarioComprasRepository;
use App\Repositories\OportunidadNegocioRepository;

class ComprasDetalleImport implements ToModel, WithHeadingRow
{
    // private Collection $calendarioUnidadesC;
    private Collection $tiposContratacion;
    private Collection $unidadesCompradoras;
    private OportunidadNegocioRepository $oportunidadesRepo;

    public function __construct(OportunidadNegocioRepository $oportunidadesRepo)
    {
        $this->tiposContratacion = $oportunidadesRepo->obtieneTiposContratacion();
        $this->unidadesCompradoras = $oportunidadesRepo->obtieneInstitucionesCompradoras(false);
        $this->oportunidadesRepo = $oportunidadesRepo;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $nombreURG = trim($row['nombre_urg']);
        $unidadCompradora = $this->unidadesCompradoras->first(function (object $uc, int $key) use($nombreURG) {
            return mb_strtolower($uc->nombre) === mb_strtolower($nombreURG);
        });

        $tipoContrBienesId = $this->tiposContratacion->where('tipo', '=', 'Adquisición de Bienes')->value('id');
        $tipoContrServiciosId = $this->tiposContratacion->where('tipo', '=', 'Prestación de Servicios')->value('id');

        if (!$unidadCompradora) {
            $unidadCompradora = UnidadCompradora::create([
                'nombre' => $nombreURG,
            ]);
            // Refrescar lista de de unidades compradoras
            $this->unidadesCompradoras = $this->oportunidadesRepo->obtieneInstitucionesCompradoras(false);
        }        
        
        $valorContr = str_replace('$', '', $row['valor_estimado_contratacion']);
        $valorContr = str_replace(',', '', $valorContr);

        return new ComprasProcedimiento([
            'id_unidad_compradora' => $unidadCompradora->id,
            'objeto_contratacion' => $row['objeto_contratacion_proyectado'],
            'metodo_contr_proyectado' => $row['procedimiento_contratacion_proyectado'],
            'contratacion_mipymes' => $row['contratacion_a_mipymes'] === 'SI',
            'valor_estimado_contratacion' => $valorContr,
            'fecha_estimada_procedimiento' => Carbon::createFromFormat('d-m-Y', $row['fecha_estimada_procedimiento_contratacion']),
            'fecha_estimada_inicio_contr' => Carbon::createFromFormat('d-m-Y', $row['fecha_estimada_inicio_vigencia_contrato']),
            'fecha_estimada_fin_contr' => Carbon::createFromFormat('d-m-Y', $row['fecha_estimada_fin_contrato']),
            'id_tipo_contratacion' => $row['tipo_de_contratacion'] === 'BIEN' ? $tipoContrBienesId : $tipoContrServiciosId,
        ]);
    }
}
