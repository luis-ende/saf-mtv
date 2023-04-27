<?php

namespace App\Console\Commands;

use App\Models\ComprasProcedimiento;
use App\Models\OportunidadNegocio;
use App\Models\TipoContratacion;
use App\Models\UnidadCompradora;
use App\Repositories\OportunidadNegocioRepository;
use App\Services\Traits\BusquedaUnidadDeCompra;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ImportaComprasProgramadas extends Command
{
    use BusquedaUnidadDeCompra;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:importa-compras-programadas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa compras programadas desde el sistema de PAAAPS para el Calendario de compras y Oportunidades de negocio de MTV.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $anio = Carbon::today()->format('Y');
        $url = env('API_PAAAPS_COMPRAS_PROGRAMADAS') . '/0/' . $anio;
        $credsUser = env('API_PAAAPS_COMPRAS_PROGRAMADAS_USER');
        $credsPass = env('API_PAAAPS_COMPRAS_PROGRAMADAS_PASSW');
        $comprasProgramadas = [];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url, [
            'auth' => [
                $credsUser,
                $credsPass
            ]
        ]);
        // Por la cantidad de información recibida, el response se procesa en batches
        $phpStream = \GuzzleHttp\Psr7\StreamWrapper::getResource($response->getBody());
        foreach (\JsonMachine\Items::fromStream($phpStream, ['pointer' => '/-']) as $key => $compra) {
            if (is_object($compra)) {
                $comprasProgramadas[] = [
                    'objeto_contratacion' => $compra->ObjetoContrato,
                    'unidad_compradora' => $compra->nombreArea,
                    'metodo_contr_proyectado' => $compra->TipoProcedimiento,
                    'valor_estimado_contratacion' => $compra->valorEstimado,
                    'fecha_estimada_inicio_contr' => $compra->fechaInicioContrato,
                    'fecha_estimada_fin_contr' => $compra->fechaFinContrato,
                    'tipo_contratacion' => $compra->TipoContratación,
                    'estatus' => $compra->Estatus,
                    'anio' => $compra->anio,
                ];
            }
        }

        $this->importaCalendarioComprasProgramadas($comprasProgramadas);

        $this->info(Carbon::now() . ' - ' . count($comprasProgramadas) . ' registros de compras programadas han sido importados.');

        $this->importaOpNegComprasProgramadas($comprasProgramadas);

        $this->info(Carbon::now() . ' - ' . count($comprasProgramadas) . ' registros de compras programadas como oportunidades de negocio han sido importados.');

        Cache::forget('cat_unidades_compradoras');

        return Command::SUCCESS;
    }

    private function importaCalendarioComprasProgramadas(array $compras): void
    {
        DB::table('compras_procedimientos')->truncate();

        $opnRepo = new OportunidadNegocioRepository();
        $tiposContratacion = $opnRepo->obtieneTiposContratacion();

        $tipoContrBienesId = $tiposContratacion->where('tipo', '=', TipoContratacion::AdquisicionBienes->value)->value('id');
        $tipoContrServiciosId = $tiposContratacion->where('tipo', '=', TipoContratacion::PrestacionServicios->value)->value('id');

        foreach ($compras as $compra) {
            $unidadCompradoraId = $this->buscaUnidadCompraHomologada($compra['unidad_compradora']);

            $valorContr = str_replace('$', '', $compra['valor_estimado_contratacion']);
            $valorContr = str_replace(',', '', $valorContr);

            ComprasProcedimiento::insert([
                'id_unidad_compradora' => $unidadCompradoraId,
                'objeto_contratacion' => $compra['objeto_contratacion'],
                'metodo_contr_proyectado' => $compra['metodo_contr_proyectado'],
                'valor_estimado_contratacion' => $valorContr,
                //'fecha_estimada_procedimiento' => // Dato no proporcionado
                'fecha_estimada_inicio_contr' => Carbon::createFromFormat('Y-m-d', $compra['fecha_estimada_inicio_contr']),
                'fecha_estimada_fin_contr' => Carbon::createFromFormat('Y-m-d', $compra['fecha_estimada_fin_contr']),
                'id_tipo_contratacion' => $compra['tipo_contratacion'] === 'BIEN' ? $tipoContrBienesId : $tipoContrServiciosId,
                'anio' => $compra['anio'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function importaOpNegComprasProgramadas(array $compras): void
    {
        $opnRepo = new OportunidadNegocioRepository();
        $unidadesCompradoras = $opnRepo->obtieneInstitucionesCompradoras(false);
        $tiposContratacion = $opnRepo->obtieneTiposContratacion();
        $etapasProc = $opnRepo->obtieneEtapasProcedimiento();
        $metodosContr = $opnRepo->obtieneMetodosContratacion();
        $estatusContr = $opnRepo->obtieneEstatusContratacion();

        $tipoContrBienesId = $tiposContratacion->where('tipo', '=', 'Adquisición de Bienes')->value('id');
        $tipoContrServiciosId = $tiposContratacion->where('tipo', '=', 'Prestación de Servicios')->value('id');
        $etapaProcId = $etapasProc->where('etapa', '=', 'Compra programada')->value('id');

        foreach ($compras as $compra) {
            $nombreURG = trim($compra['unidad_compradora']);
            $unidadCompradora = $unidadesCompradoras->first(function (object $uc, int $key) use($nombreURG) {
                return mb_strtolower($uc->nombre) === mb_strtolower($nombreURG);
            });

            if (!$unidadCompradora) {
                $unidadCompradora = UnidadCompradora::create([
                    'nombre' => $nombreURG,
                ]);
                // Refrescar lista de de unidades compradoras
                $unidadesCompradoras = $opnRepo->obtieneInstitucionesCompradoras(false);
            }

            $metodoContrId = null;
            if (str_starts_with($compra['metodo_contr_proyectado'], 'LICITACIoN PuBLICA')) {
                $metodoContrId = $metodosContr->where('metodo', '=', 'Licitación pública')->value('id');
            } else if (str_starts_with($compra['metodo_contr_proyectado'], 'INVITACIoN RESTRINGIDA')) {
                $metodoContrId = $metodosContr->where('metodo', '=', 'Invitación restringida')->value('id');
            } else if (str_starts_with($compra['metodo_contr_proyectado'], 'ADJUDICACIoN DIRECTA')) {
                $metodoContrId = $metodosContr->where('metodo', '=', 'Adjudicación directa')->value('id');
            }

            if ($metodoContrId) {
                $estatusContrId = $estatusContr->where('estatus', '=', 'Programado')->value('id');
                if (strtolower($compra['estatus']) !== 'en proceso') {
                    $estatusContrId = $estatusContr->where('estatus', '=', 'Finalizado')->value('id');
                }

                OportunidadNegocio::insert([
                    'nombre_procedimiento' => $compra['objeto_contratacion'],
                    'fecha_publicacion' => now(),
                    'id_unidad_compradora' => $unidadCompradora->id,
                    'id_tipo_contratacion' => $compra['tipo_contratacion'] === 'BIEN' ? $tipoContrBienesId : $tipoContrServiciosId,
                    'id_metodo_contratacion' => $metodoContrId,
                    'id_etapa_procedimiento' => $etapaProcId,
                    'id_estatus_contratacion' => $estatusContrId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
