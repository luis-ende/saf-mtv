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
        $this->seedTiposVialidad();
        $this->seedPaises();
        $this->seedGruposPrioritorios();
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

    private function seedGruposPrioritorios()
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

    private function seedUnidadesCompradoras()
    {
        $path = base_path('database/data/cat_unidades_compradoras.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);
    }
}
