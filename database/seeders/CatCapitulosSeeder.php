<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatCapitulosSeeder extends Seeder
{
/**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_capitulos')->insert([
            'numero' => '1000',
            'nombre' => 'Servicios personales',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_capitulos')->insert([
            'numero' => '2000',
            'nombre' => 'Materiales y suministros',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_capitulos')->insert([
            'numero' => '3000',
            'nombre' => 'Servicios generales',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_capitulos')->insert([
            'numero' => '4000',
            'nombre' => 'Transferencias, asignaciones, subsidios',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_capitulos')->insert([
            'numero' => '5000',
            'nombre' => 'Bienes muebles, inmuebles e intangibles',
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
    }
}