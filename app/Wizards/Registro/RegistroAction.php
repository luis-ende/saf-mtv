<?php

namespace App\Wizards\Registro;

use Arcanist\Action\WizardAction;
use Arcanist\Action\ActionResult;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Persona;
use App\Models\PerfilNegocio;
use App\Models\CatalogoProductos;
use App\Models\Producto;

class RegistroAction extends WizardAction
{
    public function execute($payload): ActionResult
    {
        try {
            DB::transaction(function() use($payload) {
                $persona = Persona::create([
                    'rfc' => $payload['rfc'],
                    'nombre' => $payload['nombre'],
                    'primer_ap' => $payload['primer_ap'],
                    'segundo_ap' => $payload['segundo_ap'],
                    'id_asentamiento' => 1,
                    'id_tipo_vialidad' => 1,
                    'vialidad' => $payload['vialidad'],
                    'num_int' => $payload['num_int'],
                    'num_ext' => $payload['num_ext'],
                    'lada' => $payload['lada'],
                    'telefono_fijo' => $payload['telefono_fijo'],
                    'extension' => $payload['extension'],
                    'telefono_movil' => $payload['telefono_movil'],
                    'email' => $payload['email'],
                    'email_alterno' => $payload['email_alterno'],
                    'grupo_prioritario' => $payload['grupo_prioritario'],
                ]);        
        
                $perfilNegocio = PerfilNegocio::create([
                    'id_persona' => $persona->id,
                    'lema_negocio' => $payload['lema_negocio'],
                    'descripcion_negocio' => $payload['descripcion_negocio'],            
                    'sitio_web' => $payload['sitio_web'],
                    'cuenta_facebook' => $payload['cuenta_facebook'],
                    'cuenta_twitter' => $payload['cuenta_twitter'],
                    'cuenta_linkedin' => $payload['cuenta_linkedin'],
                    'num_whatsapp' => $payload['num_whatsapp'],
                ]);
        
                $catalogoProductos = CatalogoProductos::create([
                    'nombre_catalogo' => 'Catálogo principal',
                    'id_persona' => $persona->id,
                ]);

                // Si se capturaron los datos del producto
                if (isset($payload['nombre_producto']) && isset($payload['clave_cabms'])) {
                    Producto::create([
                        'nombre' => $payload['nombre_producto'],
                        'clave_cabms' => $payload['clave_cabms'],
                        'descripcion' => $payload['descripcion_producto'],
                        'tipo' => $payload['tipo_producto'],
                        'categoria' => $payload['categoria_producto'],
                        'subcategoria' => $payload['subcategoria_producto'],
                        'marca' => $payload['marca'],
                        'id_cat_productos' => $catalogoProductos->id,
                    ]);
                }

                $user = User::create([
                    'rfc' => $payload['rfc'],
                    'id_persona' => $persona->id,
                    'activo' => true,
                    'last_login' => now(),
                    'password' => bcrypt($payload['password'])
                ]);

                // Iniciar sesión con el nuevo usuario
                event(new Registered($user));

                Auth::login($user);
            });        
        } catch (Exception $e) {
            return $this->error(
                'El proceso de registro no pudo ser completado debido a un error interno.'
            );
        }        


        return $this->success();
    }
}
