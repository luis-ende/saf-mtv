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
        // Seeders Perfil de Negocio
        $this->call(CatAsentamientosSeeder::class);
        $this->call(TiposVialidadSeeder::class);
        $this->call(CatPaisesSeeder::class);
        $this->call(GruposPrioritariosSeeder::class);
        
        // Seeders Oportunidad de Negocio
        $this->call(CatUnidadesCompradorasSeeder::class);
        $this->call(CatTiposContratacionSeeder::class);
        $this->call(CatMetodosContratacionSeeder::class);
        $this->call(CatEtapasProcedimientoSeeder::class);
        $this->call(CatEstatusContratacionSeeder::class);

        // Roles y usuarios de prueba locales
        $this->crearMTVRoles();
        $this->crearUsuarioURG();
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
}
