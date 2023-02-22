<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\EstatusContratacion;

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
            'estatus' => EstatusContratacion::ESTATUS_CONTRATACION_PROGRAMADO,
            'created_at' => now(),
            'updated_at' => now(),
        ]);        

        DB::table('cat_estatus_contratacion')->insert([
            'estatus' => EstatusContratacion::ESTATUS_CONTRATACION_VIGENTE,
            'created_at' => now(),
            'updated_at' => now(),
        ]);                

        DB::table('cat_estatus_contratacion')->insert([
            'estatus' => EstatusContratacion::ESTATUS_CONTRATACION_FINALIZADO,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}