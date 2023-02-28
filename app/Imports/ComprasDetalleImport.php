<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\ComprasDetalle;
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

    public function __construct(CalendarioComprasRepository $calendarioRepo,
                                OportunidadNegocioRepository $oportunidadesRepo)
    {
        // $this->calendarioUnidadesC =
        //     $calendarioRepo->obtieneCalendarioUnidadesCompradoras();
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
        $nombreURG = $row['nombre_urg'];
        $unidadCompradora = $this->unidadesCompradoras->first(function (object $value, int $key) use($nombreURG) {
            return strtolower($nombreURG) === strtolower($value->nombre);
        });
        // $calendarioUC = $this->calendarioUnidadesC->first(function (object $value, int $key) use($nombreURG) {
        //     similar_text(strtolower($nombreURG), strtolower($value->unidad_compradora), $perc);

        //     return $perc > 75;
        // });

        // TODO Agregar tipo de contratación 'SERVICIO INTEGRAL'?
        $tipoContrBienesId = $this->tiposContratacion->where('tipo', '=', 'Adquisición de Bienes')->value('id');
        $tipoContrServiciosId = $this->tiposContratacion->where('tipo', '=', 'Prestación de Servicios')->value('id');

        if (!$unidadCompradora) {
            DB::table('cat_unidades_compradoras')->insert([
                'nombre' => $nombreURG,                
            ]);  
            $this->unidadesCompradoras = $this->oportunidadesRepo->obtieneInstitucionesCompradoras(false);
            $unidadCompradora = $this->unidadesCompradoras->firstWhere('nombre', $nombreURG);
            //var_dump($unidadCompradora);
        }        
        
        $valorContr = str_replace('$', '', $row['valor_estimado_contratacion']);
        $valorContr = str_replace(',', '', $valorContr);

        return new ComprasDetalle([
            //'id_calendario_compras' => $calendarioUC->id,
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
