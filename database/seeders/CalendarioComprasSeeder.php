<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\CalendarioCompras\PlaneacionAnualService;

class CalendarioComprasSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(PlaneacionAnualService $planeacionAService): void
    {
        // Importar planeación anual del 2022 de la descarga en formato json de
        // https://brandmestudio-test.com/contrataciones-abiertas?page=1
        $path = base_path('database/data/planeaciones_2022.csv');
        $planeacionAService->importaPlaneacionAnual($path);
    }
}