<?php

namespace App\Console\Commands;

use App\Services\OportunidadesNegocio\ConcursoDigitalService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportaConvocatorias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtv:importa-convocatorias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Llama al API de Concurso digital para importar convocatorias a la tabla de oportunidades_negocio de MTV.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $convocatorias = $this->obtieneConvocatorias();
        $concursosService = new ConcursoDigitalService();
        $concursosService->importaOportunidadesNegocio($convocatorias);

        $this->info(Carbon::now() . ' - ' . count($convocatorias) . ' convocatorias importadas.');

        return Command::SUCCESS;
    }

    private function obtieneConvocatorias(): array
    {
        $url = env('API_CONCURSO_DIGITAL_CONVOCATORIAS');
        $convocatorias = [];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        // Por la cantidad de información recibida, el response se procesa en batches
        $phpStream = \GuzzleHttp\Psr7\StreamWrapper::getResource($response->getBody());
        foreach (\JsonMachine\Items::fromStream($phpStream, ['pointer' => '/-/respuesta']) as $key => $conv) {
            $fechaPublicacion = Carbon::createFromFormat('Y-m-d H:i:s', $conv->fecha_publicacion_convocatoria);

            if ($fechaPublicacion->gte(Carbon::today())) {
                // Obtener claves CABMS y partidas asociadas a la convocatoria
                $cabms = [];
                $partidas = [];
                foreach ($conv->bienes_servicios as $bs) {
                    if (is_object($bs->servicios)) {
                        $cabms[] = $bs->servicios->cambs;
                        $partidas[] = substr($bs->servicios->cambs, 0, 4);
                    } else if (is_array($bs->servicios)) {
                        foreach ($bs->servicios as $servicio) {
                            $cabms[] = $servicio->cambs;
                            $partidas[] = substr($servicio->cambs, 0, 4);
                        }
                    }
                }

                $convocatorias[] = [
                    'fecha_publicacion' => $conv->fecha_publicacion_convocatoria,
                    'fecha_presentacion_propuestas' => $conv->presentacion_propuestas,
                    'entidad_convocante' => $conv->nombre_dependencia_convocante,
                    'nombre_procedimiento' => $conv->nombre_procedimiento,
                    'tipo_contratacion' => $conv->tipo_contratacion,
                    'metodo_contratacion' => $conv->metodo_contratacion,
                    'fuente_url' => $conv->mas_informacion_url,
                    'partidas' => implode(',', $partidas),
                    'cabms' => implode(',', $cabms),
                ];
            }
        }

        return $convocatorias;
    }
}
