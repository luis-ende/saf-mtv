<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsuarioURG;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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
        $this->call(CatCapitulosSeeder::class);
        $this->call(CatUnidadesCompradorasSeeder::class);
        $this->call(CatTiposContratacionSeeder::class);
        $this->call(CatMetodosContratacionSeeder::class);
        $this->call(CatEtapasProcedimientoSeeder::class);
        $this->call(CatEstatusContratacionSeeder::class);
        $this->call(PreguntasFrecuentesSeeder::class);
        $this->call(ObjetivosTareasSeeder::class);
        $this->call(MTVBannersSeeder::class);

        $this->creaMTVRoles();
        // Roles y usuarios de prueba locales.
        // Usuarios de prueba/modo desarrollo generados sin tokens de autenticación.
//        $this->creaUsuarioURG();
//        $this->creaUsuarioAdmin();
    }

    private function creaMTVRoles()
    {
        Role::create(['name' => 'proveedor']);
        Role::create(['name' => 'urg']);        
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'mtv-admin']);
    }

    private function creaUsuarioURG()
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

    // Usuario administrador predeterminado para el módulo de administración de MTV (ambiente de desarrollo local).
    private function creaUsuarioAdmin()
    {
        $user = User::create([
            'name' => 'mtv-admin',
            'email' => 'admin@test.com',
            'rfc' => 'mtv-admin',
            'activo' => true,
            'last_login' => now(),
            'password' => bcrypt('12345678C$')]);
        $user->assignRole('mtv-admin');
    }
}
