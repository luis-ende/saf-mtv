<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatEtapasProcedimientoSeeder extends Seeder
{
/**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_etapas_procedimiento')->insert([
            'etapa' =>  'Compra programada',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_etapas_procedimiento')->insert([
            'etapa' =>  'Prebases',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_etapas_procedimiento')->insert([
            'etapa' =>  'Licitación en proceso',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_etapas_procedimiento')->insert([
            'etapa' =>  'Precotizaciones',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}