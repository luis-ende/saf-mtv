<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatMetodosContratacionSeeder extends Seeder
{
/**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_metodos_contratacion')->insert([
            'metodo' =>  'Adjudicación directa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_metodos_contratacion')->insert([
            'metodo' =>  'Invitación restringida',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_metodos_contratacion')->insert([
            'metodo' =>  'Licitación pública',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}