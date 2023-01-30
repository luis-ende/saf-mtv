<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatEstatusContratacionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_estatus_contratacion')->insert([
            'estatus' => 'En proceso',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_estatus_contratacion')->insert([
            'estatus' => 'Cerrado',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}