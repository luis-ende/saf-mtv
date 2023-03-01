<?php

namespace Database\Seeders;

use App\Services\CalendarioCompras\PlaneacionAnualService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComprasProcedimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PlaneacionAnualService $planeacionAService)
    {
        $path = base_path('database/data/compras_procedimientos_2022.csv');
        $planeacionAService->importaAnaliticoProcedimientos($path);
    }
}
