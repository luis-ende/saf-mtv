<?php

namespace Database\Seeders;

use App\Imports\PreguntasFrecuentesImport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PreguntasFrecuentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/data/preguntas_frecuentes.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }

    public function importFromExcel()
    {
        // Importación original de datos
        $path = base_path('database/data/PREGUNTAS FRECUENTES MTV.xlsx');
        $import = new PreguntasFrecuentesImport();
        $import->onlySheets('Público > Conceptos', 'Público > Compras públicas', 'Público > MTV',
            'Proveedores > Padrón de Proveed', 'Proveedores > Precotizaciones',
            'Instituciones compradoras');

        Excel::import($import, $path);
    }
}
