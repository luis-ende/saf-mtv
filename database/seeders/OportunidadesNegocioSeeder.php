<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Services\OportunidadesNegocio\ConcursoDigitalService;
use App\Services\OportunidadesNegocio\PrebasesService;

class OportunidadesNegocioSeeder extends Seeder
{
    /**
     * Seeder para extraer datos de concurso digital y prebases, y llenar tabla de oportunidades_negocio.
     * Usado solamente para ambiente de desarrollo, los datos se extraen vía web scrapping (podría no funcionar si la estructura del sitio ha cambiado).
     * En producción el consumo de datos se hace mediante API (Ver README.md)
     *
     * @return void
     */
    public function run(ConcursoDigitalService $concursoDService, 
                        PrebasesService $prebasesService): void
    {
        $concursoDService->importaOportunidadesNegocio($concursoDService->extraerConvocatorias());
        $prebasesService->importaOportunidadesNegocio();
    }
}