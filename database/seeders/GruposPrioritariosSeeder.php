<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GruposPrioritariosSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cat_grupos_prioritarios')->insert([
            'grupo' => 'MIPYMES',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_grupos_prioritarios')->insert([
            'grupo' => 'Cooperativas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_grupos_prioritarios')->insert([
            'grupo' => 'Empresas lideradas por mujeres',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_grupos_prioritarios')->insert([
            'grupo' => 'Comunidades Indígenas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}