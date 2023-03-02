<?php

namespace Database\Seeders;

use App\Imports\PreguntasFrecuentesImport;
use Illuminate\Database\Seeder;
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
        $path = base_path('database/data/PREGUNTAS FRECUENTES MTV.xlsx');
        $import = new PreguntasFrecuentesImport();
        $import->onlySheets('Público > Conceptos', 'Público > Compras públicas', 'Público > MTV',
                            'Proveedores > Padrón de Proveed', 'Proveedores > Precotizaciones',
                            'Instituciones compradoras');

        Excel::import($import, $path);
    }
}
