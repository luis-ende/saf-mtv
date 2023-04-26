<?php

namespace App\Console\Commands;

use App\Models\EstatusContratacion;
use App\Models\EtapaProcedimiento;
use App\Models\MetodoContratacion;
use App\Models\OportunidadNegocio;
use App\Models\TipoContratacion;
use App\Models\UnidadCompradora;
use App\Repositories\OportunidadNegocioRepository;
use App\Services\Traits\BusquedaUnidadDeCompra;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportaRequisiciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:importa-requisiciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa datos del sistema de Requisiciones para Oportunidades de negocio de MTV.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $precotizaciones = $this->obtienePrecotizaciones();
            $this->importaPrecotizaciones($precotizaciones);

            $this->info(Carbon::now() . ' - ' . count($precotizaciones) . ' precotizaciones de Requisiciones han sido importados.');
        } catch(\Throwable $e) {
            $this->error(Carbon::now() . ' - ' . 'Ocurrió un error al obtener datos de precotizaciones de Requisiciones: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }

    private function obtienePrecotizaciones(): array
    {
        $url = env('API_REQUISICIONES_PRECOTIZACIONES');
        $response = Http::get($url);

        $precotizaciones = [];
        if ($response->successful()) {
            $responseData = $response->json();
            if ($responseData['status'] === 'success') {
                $precotizacionesData = $responseData['data'];

                foreach ($precotizacionesData as $precotizacion) {
                    if (empty($precotizacion['objeto_req'])) {
                        continue;
                    }

                    $precotizaciones[] = [
                        'nombre_procedimiento' => $precotizacion['objeto_req'],
                        'fecha_publicacion' => $precotizacion['fecha_registro'],
                        'fecha_finalizacion_proceso' => $precotizacion['fecha_finalizacion_proceso'],
                        'tipo_contratacion' => $precotizacion['tipo_req'],
                        'partidas' => $precotizacion['clasificacion_gasto'],
                    ];
                }
            }
        }

        return $precotizaciones;
    }

    private function importaPrecotizaciones(array $precotizaciones): void
    {
        $opnRepo = new OportunidadNegocioRepository();
        $etapaPrecotizacionId = $opnRepo->obtieneEtapasProcedimiento()->where('etapa', EtapaProcedimiento::Precotizacion->value)->value('id');
        $metodoContrId = $opnRepo->obtieneMetodosContratacion()->where('metodo', MetodoContratacion::NoAplica->value)->value('id');
        $tiposContr = $opnRepo->obtieneTiposContratacion();
        $estatusContr = $opnRepo->obtieneEstatusContratacion();

        // Las precotizaciones obtenidas no tienen el dato de la unidad compradora, por lo que se usará una unidad compradora general para todas
        // las oportunidades de negocio de etapa Precotización.
        $unidadCompra = UnidadCompradora::firstWhere('nombre', 'DIRECCION GENERAL DE RECURSOS MATERIALES Y SERVICIOS GENERALES');
        if ($unidadCompra) {
            $unidadCompraId = $unidadCompra->id;
        } else {
            throw new \Exception('No es posible realizar la importación. No existe la unidad compradora para precotizaciones en el catálogo de MTV: DIRECCION GENERAL DE RECURSOS MATERIALES Y SERVICIOS GENERALES');
        }

        foreach ($precotizaciones as $precotizacion) {
            $fechaPublicacion = Carbon::createFromFormat('Y-m-d', $precotizacion['fecha_publicacion']);
            $fechaFinProceso = Carbon::createFromFormat('Y-m-d', $precotizacion['fecha_finalizacion_proceso']);

            $estatusContrId = $estatusContr->where('estatus', EstatusContratacion::ESTATUS_CONTRATACION_VIGENTE)->value('id');
            if ($fechaFinProceso->lte(Carbon::today())) {
                $estatusContrId = $estatusContr->where('estatus', EstatusContratacion::ESTATUS_CONTRATACION_FINALIZADO)->value('id');
            }

            $tipoContrId = $tiposContr->where('tipo', TipoContratacion::AdquisicionBienes->value)->value('id');
            if (strtolower($precotizacion['tipo_contratacion']) === 'servicios') {
                $tipoContrId = $tiposContr->where('tipo', TipoContratacion::PrestacionServicios->value)->value('id');
            }

            // Actualizar solamente si ya existe
            OportunidadNegocio::updateOrInsert([
                    'nombre_procedimiento' => $precotizacion['nombre_procedimiento'],
                    'fecha_publicacion' => $fechaPublicacion,
                    'id_etapa_procedimiento' => $etapaPrecotizacionId,
                ],
                [
                    'id_unidad_compradora' => $unidadCompraId,
                    'id_tipo_contratacion' => $tipoContrId,
                    'id_metodo_contratacion' => $metodoContrId,
                    'id_etapa_procedimiento' => $etapaPrecotizacionId,
                    'id_estatus_contratacion' => $estatusContrId,
                    'partidas' => $precotizacion['partidas'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
    }
}
