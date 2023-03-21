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
    public const TIPO_REGISTRO_MTV = 1;
    public const TIPO_REGISTRO_EXTERNO = 2;

    /**
    /* Servicio de registro de proveedores en MTV, desde el formulario de registro MTV o extenerno,
     * por ejemplo, Padrón de Proveedores.
     * Tipo Registro: 1 = Proveedor registrado en MTV | 2 = Proveedor importado de Padrón de Roveedores
     */
    public function registraProveedorMTV(array $personaRegistroDatos, ?array $domicilioDatos = null, int $tipoRegistro = 1): User
    {
        $user = null;
        DB::transaction(function() use($personaRegistroDatos, &$user, $domicilioDatos, $tipoRegistro) {
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

            $personaDatos = [
                'id_tipo_persona' => $personaRegistroDatos['tipo_persona'],
                'personable_id' => $tipo_persona->id,
                'personable_type' => get_class($tipo_persona),
                'rfc' => $personaRegistroDatos['rfc'],
                'email' => $personaRegistroDatos['email'],
                'registro_fase' => RegistroMTV::REGISTRO_FASE_IDENTIFICACION,
                'id_tipo_registro' => $tipoRegistro,
            ];
            if (isset($domicilioDatos)) {
                $personaDatos = array_merge($personaDatos, $domicilioDatos);
            }
            $persona = Persona::create($personaDatos);

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

    public function registraPerfilNegocio(array $perfilNegocioDatos, Persona $persona): PerfilNegocio
    {
        $perfilNegocioDatos['id_persona'] = $persona->id;

        return PerfilNegocio::create($perfilNegocioDatos);
    }

    public function registraContactos(string $listaContactos, Persona $persona)
    {
        DB::transaction(function() use($persona, $listaContactos,) {
            $personaRepository = new PersonaRepository();
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
