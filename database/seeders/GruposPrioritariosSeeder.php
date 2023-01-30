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
        DB::table('cat_grupos_prioritarios')->firstOrCreate([
            'grupo' => 'MIPYMES',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_grupos_prioritarios')->firstOrCreate([
            'grupo' => 'Cooperativas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_grupos_prioritarios')->firstOrCreate([
            'grupo' => 'Empresas lideradas por mujeres',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cat_grupos_prioritarios')->firstOrCreate([
            'grupo' => 'Comunidades Indígenas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}