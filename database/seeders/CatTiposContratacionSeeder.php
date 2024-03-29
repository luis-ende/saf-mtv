<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatTiposContratacionSeeder extends Seeder
{
/**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_tipos_contratacion')->insert([            
            'tipo' => 'Adquisición de Bienes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_tipos_contratacion')->insert([            
            'tipo' => 'Prestación de Servicios',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}