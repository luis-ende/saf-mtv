<?php

namespace Database\Seeders;

use App\Imports\DirectorioCdmxImport;
use App\Repositories\OportunidadNegocioRepository;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DirectorioCdmxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/data/directorio_cdmx.xlsx');
        $import = new DirectorioCdmxImport(new OportunidadNegocioRepository());

        Excel::import($import, $path);
    }
}
