<?php declare(strict_types = 1);

namespace App\Services;

use App\Models\CatalogoProductos;
use App\Models\Contacto;
use App\Models\PerfilNegocio;
use App\Models\Persona;
use App\Models\PersonaFisica;
use App\Models\PersonaMoral;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistroPersonaService
{
    public function registraPersonaMTV(array $personaRegistroDatos): bool
    {
        DB::transaction(function() use($personaRegistroDatos) {
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
                'rfc' => $personaRegistroDatos['rfc_completo'],
                'id_asentamiento' => $personaRegistroDatos['id_asentamiento'],
                'id_tipo_vialidad' => $personaRegistroDatos['id_tipo_vialidad'],
                'vialidad' => $personaRegistroDatos['vialidad'],
                'num_int' => $personaRegistroDatos['num_int'],
                'num_ext' => $personaRegistroDatos['num_ext'],
            ]);

            $contactos = json_decode($personaRegistroDatos['contactos_lista'], true);
            if ($contactos) {
                foreach ($contactos as $contacto) {
                    Contacto::create([
                        'id_persona' => $persona->id,
                        'nombre' => $contacto['nombre'],
                        'primer_ap' => $contacto['primer_ap'],
                        'segundo_ap' => $contacto['segundo_ap'],
                        'cargo' => $contacto['cargo'],
                        'telefono_oficina' => $contacto['telefono_oficina'],
                        'extension' => $contacto['extension'],
                        'telefono_movil' => $contacto['telefono_movil'],
                        'email' => $contacto['email'],
                    ]);
                }
            }

            PerfilNegocio::create([
                'id_persona' => $persona->id,
                'id_grupo_prioritario' => $personaRegistroDatos['id_grupo_prioritario'],
                'id_tipo_pyme' => $personaRegistroDatos['id_tipo_pyme'],
                'id_sector' => $personaRegistroDatos['id_sector'],
                'id_categoria_scian' => $personaRegistroDatos['id_categoria_scian'],
                'lema_negocio' => $personaRegistroDatos['lema_negocio'],
                'descripcion_negocio' => $personaRegistroDatos['descripcion_negocio'],
                'diferenciadores' => $personaRegistroDatos['diferenciadores'],
                'sitio_web' => $personaRegistroDatos['sitio_web'],
                'cuenta_facebook' => $personaRegistroDatos['cuenta_facebook'],
                'cuenta_twitter' => $personaRegistroDatos['cuenta_twitter'],
                'cuenta_linkedin' => $personaRegistroDatos['cuenta_linkedin'],
                'num_whatsapp' => $personaRegistroDatos['num_whatsapp'],
            ]);

            $catalogoProductos = CatalogoProductos::create([
                'nombre_catalogo' => 'Catálogo principal',
                'id_persona' => $persona->id,
            ]);

            // Si se capturaron los datos del producto
            if (isset($personaRegistroDatos['nombre_producto']) && isset($personaRegistroDatos['clave_cabms'])) {
                $producto = [
                    'tipo' => $personaRegistroDatos['tipo_producto'],
                    'clave_cabms' => $personaRegistroDatos['clave_cabms'],
                    'nombre' => $personaRegistroDatos['nombre_producto'],
                    'descripcion' => $personaRegistroDatos['descripcion_producto'],
                    'precio' => $personaRegistroDatos['precio'],
                    'id_cat_productos' => $catalogoProductos->id,
                ];

                if ($personaRegistroDatos['tipo_producto'] === Producto::TIPO_PRODUCTO_BIEN_ID) {
                    $producto['marca'] = $personaRegistroDatos['marca'];
                    $producto['modelo'] = $personaRegistroDatos['modelo'];
                    $producto['color'] = $personaRegistroDatos['color'];
                    $producto['material'] = $personaRegistroDatos['material'];
                }

                Producto::create($producto);
            }

            $user = User::create([
                'rfc' => $personaRegistroDatos['rfc_completo'],
                'id_persona' => $persona->id,
                'activo' => true,
                'last_login' => now(),
                'password' => bcrypt($personaRegistroDatos['password'])
            ]);

            // Iniciar sesión con el nuevo usuario
            event(new Registered($user));

            Auth::login($user);
        });

        return true;
    }
}
