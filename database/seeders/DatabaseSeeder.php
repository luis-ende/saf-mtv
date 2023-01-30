<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsuarioURG;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
    * Seed the application's database.
    *
    * @return void
    */
    public function run()
    {
        $this->seedCatAsentamientos();
        //$this->call(TiposVialidadSeeder::class);
        //$this->seedTiposVialidad();
        //$this->seedPaises();
        //$this->seedGruposPrioritorios();
        //$this->call(GruposPrioristarioSeeder::class);
        $this->seedUnidadesCompradoras();
        $this->crearMTVRoles();
        $this->crearUsuarioURG();
    }

    private function seedCatAsentamientos()
    {
        $path = base_path('database/data/cat_asentamientos.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }

    private function seedPaises()
    {
        $path = base_path('database/data/cat_paises.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }

    private function crearMTVRoles()
    {
        Role::create(['name' => 'proveedor']);
        Role::create(['name' => 'urg']);        
        Role::create(['name' => 'admin']);        
    }

    private function crearUsuarioURG()
    {        
        $usuarioURG = UsuarioURG::create(['nombre' => 'URG Prueba']);
        $user = User::create([
            'rfc' => 'URG', // Nombre de usuario
            'activo' => true, 
            'id_urg' => $usuarioURG->id,
            'last_login' => now(), 
            'password' => bcrypt('urg_password')]);
        $user->assignRole('urg');

        $usuarioURG = UsuarioURG::create(['nombre' => 'URG Admin Prueba']);
        $user = User::create([
            'rfc' => 'URG-ADMIN', // Nombre de usuario
            'activo' => true, 
            'id_urg' => $usuarioURG->id,
            'last_login' => now(), 
            'password' => bcrypt('urg_password')]);
        $user->assignRole('urg', 'admin');
    }

    private function seedUnidadesCompradoras()
    {
        $path = base_path('database/data/cat_unidades_compradoras.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }
}
