<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->seedTiposVialidad();
    }

    private function seedTiposVialidad() 
    {
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CALLE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'AVENIDA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CALZADA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'EJE VIAL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'ANDADOR',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CALLEJON',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'BOULEVARD',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CARRETERA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'PRIVADA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CIRCUNVALACIÓN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'BRECHA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'DIAGONAL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CORREDOR',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CIRCUITO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'PASAJE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'VEREDA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'VIADUCTO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'PROLONGACIÓN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'PEATONAL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'RETORNO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CAMINO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CERRADA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'AMPLIACIÓN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'CONTINUACIÓN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'TERRACERÍA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('cat_tipo_vialidad')->insert([
            'tipo_vialidad' => 'PERIFÉRICO',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}