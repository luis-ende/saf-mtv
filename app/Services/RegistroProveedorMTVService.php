<?php declare(strict_types = 1);

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Persona;
use App\Models\RegistroMTV;
use App\Models\PersonaMoral;
use App\Models\PerfilNegocio;
use App\Models\PersonaFisica;
use App\Models\CatalogoProductos;
use Illuminate\Support\Facades\DB;
use App\Repositories\PersonaRepository;

/*
 * Clase servicio para crear una cuenta de proveedor con sus datos asociados en MTV.
 * Las cuentas de URG y administrador se crean por otro medio.
 */
class RegistroProveedorMTVService
{
    public function registraProveedorMTV(array $personaRegistroDatos): User
    {
        $user = null;
        DB::transaction(function() use($personaRegistroDatos, &$user) {
            $tipo_persona = null;
            if ($personaRegistroDatos['tipo_persona'] === Persona::TIPO_PERSONA_FISICA_ID) {
                $tipo_persona = PersonaFisica::create([
                    'curp' => $personaRegistroDatos['curp'],
                    'fecha_nacimiento' => Carbon::createFromFormat('d/m/Y', $personaRegistroDatos['fecha_nacimiento']),
                    'genero' => $personaRegistroDatos['genero'],
                    'nombre' => $personaRegistroDatos['nombre'],
                    'primer_ap' => $personaRegistroDatos['primer_ap'],
                    'segundo_ap' => $personaRegistroDatos['segundo_ap'],
                ]);
            } elseif ($personaRegistroDatos['tipo_persona'] === Persona::TIPO_PERSONA_MORAL_ID) {
                $tipo_persona = PersonaMoral::create([
                    'razon_social' => $personaRegistroDatos['razon_social'],
                    'fecha_constitucion' => $personaRegistroDatos['fecha_constitucion'],
                ]);
            }

            $persona = Persona::create([
                'id_tipo_persona' => $personaRegistroDatos['tipo_persona'],
                'personable_id' => $tipo_persona->id,
                'personable_type' => get_class($tipo_persona),
                'rfc' => $personaRegistroDatos['rfc'],
                'email' => $personaRegistroDatos['email'],
                'registro_fase' => RegistroMTV::REGISTRO_FASE_IDENTIFICACION,
            ]);

            $user = User::create([
                'rfc' => $personaRegistroDatos['rfc'],
                'name' => $personaRegistroDatos['rfc'],
                'email' => $personaRegistroDatos['email'],
                'id_persona' => $persona->id,
                'activo' => true,
                'last_login' => now(),
                'password' => bcrypt($personaRegistroDatos['password'])
            ]);

            $user->assignRole('proveedor');
        });

        return $user;
    }

    public function registraPerfilNegocio(array $perfilNegocioDatos, Persona $persona) {
        $perfilNegocioDatos['id_persona'] = $persona->id;

        return PerfilNegocio::create($perfilNegocioDatos);
    }

    public function registraContactos(string $listaContactos, Persona $persona)
    {
        $personaRepository = new PersonaRepository();
        DB::transaction(function() use($persona, $listaContactos, $personaRepository) {
            $personaRepository->updateContactos($persona, $listaContactos);
            $persona->update([
                'registro_fase' => RegistroMTV::REGISTRO_FASE_CONTACTOS,
            ]);

            $catalogoProductos = CatalogoProductos::create([
                'nombre_catalogo' => 'Catálogo principal',
                'id_persona' => $persona->id,
            ]);
        });
    }
}
