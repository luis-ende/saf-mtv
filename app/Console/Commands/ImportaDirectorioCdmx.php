<?php

namespace App\Console\Commands;

use App\Models\Directorio\Funcionario;
use App\Models\UnidadCompradora;
use App\Repositories\OportunidadNegocioRepository;
use App\Services\Traits\BusquedaUnidadDeCompra;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportaDirectorioCdmx extends Command
{
    use BusquedaUnidadDeCompra;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:importa-directorio-cdmx';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa datos para el Directorio CDMX de MTV.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = env('API_ACCESO_UNICO_DIRECTORIO_CDMX');
        $response = Http::get($url);

        $responseData = $response->json();
        if ($response->successful() && $responseData['status'] === 'success') {
            $funcionarios = $responseData['data'];
            if (count($funcionarios) > 0) {
                $this->importaFuncionarios($funcionarios);
            } else {
                $this->error(Carbon::now() . ' - ' . 'No se realizó la importación, se obtuvieron 0 registros de funcionarios.');
            }

            $this->info(Carbon::now() . ' - ' . count($funcionarios) . ' registros de funcionarios importados.');
        } else {
            $this->error(Carbon::now() . ' - ' . 'Ocurrió un error al obtener datos para el Directorio Cdmx');
        }

        return Command::SUCCESS;
    }

    private function importaFuncionarios(array $funcionarios): void
    {
        DB::table('funcionarios')->truncate();

        foreach ($funcionarios as $funcionario) {
            $unidadCompraId = $this->buscaUnidadCompraHomologada($funcionario['institucion']);

            $nombreCompleto = $funcionario['nombre'] . " " . $funcionario['primer_apellido'] . " " . $funcionario['segundo_apellido'];

            Funcionario::updateOrInsert(
                [
                    'nombre' => $nombreCompleto,
                    'id_unidad_compradora' => $unidadCompraId,
                ],
                [
                    'puesto' => $funcionario['puesto'],
                    'funciones' => $funcionario['funciones'],
                    'telefono_oficina' => $funcionario['telefono_institucional'] ?? '---',
                    'email' => $funcionario['correo_institucional'],
                    'fecha_actualizacion' => $funcionario['fecha_actualizacion'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        if (!empty($funcionarios)) {
            Cache::forget('cat_unidades_compradoras');
        }
    }
}
