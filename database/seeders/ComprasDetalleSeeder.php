<?php

namespace Database\Seeders;

use App\Services\CalendarioCompras\PlaneacionAnualService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComprasDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PlaneacionAnualService $planeacionAService)
    {
        // Importar analítico de procedimientos de la planeación anual del 2022
        // Ejecutar antes tabla maestra con CalendarioComprasSeeder
        $path = base_path('database/data/compras_procedimientos.csv');
        $planeacionAService->importaAnaliticoProcedimientos($path);
    }
}
