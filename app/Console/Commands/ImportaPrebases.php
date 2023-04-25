<?php

namespace App\Console\Commands;

use App\Services\OportunidadesNegocio\PrebasesService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportaPrebases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:importa-prebases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa proyectos del sistema de Prebases para Oportunidades de negocio de MTV.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $proyectos = $this->obtieneProyectos();
            $prebasesService = new PrebasesService();
            $prebasesService->importaOportunidadesNegocio($proyectos);

            $this->info(Carbon::now() . ' - ' . count($proyectos) . ' proyectos de Prebases han sido importados.');
        } catch(\Throwable $e) {
            $this->error(Carbon::now() . ' - ' . 'Ocurrió un error al obtener datos de proyectos de Prebases: ' . $e->getMessage());
        }

        return Command::SUCCESS;
    }

    private function obtieneProyectos(): array
    {
        $url = env('API_PREBASES');
        $response = Http::get($url);

        $proyectos = [];
        if ($response->successful()) {
            $responseData = $response->json()[0];
            if ($responseData['code'] === '200') {
                $proyectosPrebases = $responseData['respuesta'];

                foreach ($proyectosPrebases as $proyecto) {
                    if (empty($proyecto['ente_publico']) || empty($proyecto['tipo_contratacion'])) {
                        // Omitir registros con datos incompletos.
                        continue;
                    }

                    $proyectoPartidas = array_map(function ($p) {
                        return $p['partida'];
                    }, $proyecto['partidas']);

                    $proyectos[] = [
                        'nombre_proyecto' => trim(html_entity_decode(strip_tags($proyecto['descripcion']))),
                        'fecha_publicacion' => Carbon::createFromFormat('Y-m-d', substr($proyecto['fecha_publicacion'], 0, 10))->format('d/m/Y'),
                        'ente_publico' => $proyecto['ente_publico'],
                        'tipo_contratacion' => $proyecto['tipo_contratacion'],
                        'metodo_contratacion' => $proyecto['posible_metodo_contratacion'],
                        'estatus' => strtolower($proyecto['estatus']) === 'abierta' ? 'abierto' : $proyecto['estatus'],
                        'partidas' => implode('|', $proyectoPartidas),
                        'fuente_url' => $proyecto['url'],
                    ];
                }
            }
        } else {
            throw new \Exception('No fue posible realizar la consulta a Prebases.');
        }

        return $proyectos;
    }
}
