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
            'secuencia' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('cat_etapas_procedimiento')->insert([
            'etapa' =>  'Precotizaciones',
            'secuencia' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_etapas_procedimiento')->insert([
            'etapa' =>  'Prebases',
            'secuencia' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_etapas_procedimiento')->insert([
            'etapa' =>  'Licitaciones en proceso',
            'secuencia' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
    }
}