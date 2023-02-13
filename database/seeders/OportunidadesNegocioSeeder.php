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
     * Seeder para extraer datos de concurso digital y llenar tabla de oportunidades_negocio.
     *
     * @return void
     */
    public function run(ConcursoDigitalService $concursoDService, 
                        PrebasesService $prebasesService): void
    {
        $concursoDService->importaOportunidadesNegocio();
        $prebasesService->importaOportunidadesNegocio();
    }
}