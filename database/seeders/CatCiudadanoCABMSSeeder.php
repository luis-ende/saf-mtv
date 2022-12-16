<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatCiudadanoCABMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/data/cat_ciudadano_cabms.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);

        $path = base_path('database/data/load_catalogos_cabms.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
