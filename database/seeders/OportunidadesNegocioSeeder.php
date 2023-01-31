<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;
use App\Repositories\OportunidadRepository;

class OportunidadesNegocioSeeder extends Seeder
{
    /**
     * Seeder para extraer datos de prueba (usar sólo para modo desarrollo local) de concurso digital 
     * y llenar tabla de oportunidades.
     *
     * @return void
     */
    public function run()
    {
        $oportunidadesRepository = new OportunidadRepository();
        $oportunidades = $oportunidadesRepository->extraerConvocatorias();

        // var_dump($oportunidades[0]);

        $tipoContratacionBien = DB::table('cat_tipos_contratacion')->where('tipo', 'Adquisición de Bienes')->value('id');
        $tipoContratacionServicio = DB::table('cat_tipos_contratacion')->where('tipo', 'Prestación de Servicios')->value('id');
        $tipoMetodoContratacionLP = DB::table('cat_metodos_contratacion')->where('metodo', 'Licitación pública')->value('id');
        $tipoMetodoContratacionIR = DB::table('cat_metodos_contratacion')->where('metodo', 'Invitación restringida')->value('id');
        $etapaLicEnProc = DB::table('cat_etapas_procedimiento')->where('etapa', 'Licitación en proceso')->value('id');
        $estatusContr = DB::table('cat_estatus_contratacion')->where('estatus', 'En proceso')->value('id');


        //'Adquisición de Bienes'

        OportunidadNegocio::truncate();
        foreach($oportunidades as $oportunidad) {
            OportunidadNegocio::insert([
                'nombre_procedimiento' => $oportunidad['nombre_procedimiento'],
                'fecha_publicacion' => Carbon::createFromFormat('Y-m-d', substr($oportunidad['fecha_publicacion'], 0, 10)),
                'fecha_presentacion_propuestas' => Carbon::createFromFormat('Y-m-d', substr($oportunidad['fecha_presentacion_propuestas'], 0, 10)),
                'id_unidad_compradora' => DB::table('cat_unidades_compradoras')->where('nombre', $oportunidad['entidad_convocante'])->value('id'),
                'id_tipo_contratacion' => $oportunidad['tipo_contratacion'] === 'Adquisición de Bienes' ? $tipoContratacionBien : $tipoContratacionServicio,
                'id_metodo_contratacion' => $oportunidad['metodo_contratacion'] === 'LP - Licitación Pública' ?  $tipoMetodoContratacionLP : $tipoMetodoContratacionIR,
                'id_etapa_procedimiento' => $etapaLicEnProc,
                'id_estatus_contratacion' => $estatusContr,
            ]);
        }
    }
}