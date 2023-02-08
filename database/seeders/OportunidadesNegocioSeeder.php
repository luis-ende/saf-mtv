<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Services\OportunidadesNegocio\ConcursoDigitalService;

class OportunidadesNegocioSeeder extends Seeder
{
    /**
     * Seeder para extraer datos de concurso digital y llenar tabla de oportunidades_negocio.
     *
     * @return void
     */
    public function run(ConcursoDigitalService $concursoDService): void
    {
        $concursoDService->importaOportunidadesNegocio();
    }
}