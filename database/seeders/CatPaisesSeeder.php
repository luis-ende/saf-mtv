<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatPaisesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/data/cat_paises.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }
}