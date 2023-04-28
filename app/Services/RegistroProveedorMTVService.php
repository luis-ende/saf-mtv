<?php declare(strict_types = 1);

namespace App\Services;

use App\Models\Contacto;
use App\Services\Traits\PerfilNegocioCatalogosEquivalencias;
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
    use PerfilNegocioCatalogosEquivalencias;

    public const TIPO_REGISTRO_MTV = 1; // Proveedor registrado directamente en MTV
    public const TIPO_REGISTRO_MTV_PP = 2; // Proveedor con referencia a Padrón de Roveedores

    protected ConsultaPadronProveedoresService $consultaPPService;

    public function __construct()
    {
        $this->consultaPPService = new ConsultaPadronProveedoresService();
    }

    /**
    /* Servicio de registro de proveedores en MTV, desde el formulario de registro MTV o extenerno,
     * por ejemplo, Padrón de Proveedores.
     */
    public function registraProveedorMTV(
        array $personaRegistroDatos,
        ?array $domicilioDatos = null,
    ): User
    {
        $proveedorPP = $this->consultaPPService->consultaProveedorPerfilNegocio($personaRegistroDatos['rfc']);
        if ($proveedorPP) {
            // Continua registro con datos provenientes de PP
            $user = $this->creaCuentaProveedorMTV_PP($personaRegistroDatos, $proveedorPP);
        } else {
            $user = $this->creaCuentaProveedorMTV($personaRegistroDatos, $domicilioDatos, self::TIPO_REGISTRO_MTV);
        }

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

    /**
     * Verifica si existe el proveedor en Padrón de Proveedores.
     * Si existe crea o actualiza la cuenta en MTV.
     */
    public function esProveedorPP(string $rfc): bool
    {
        $proveedor = User::where('rfc', $rfc)
                            ->whereNotNull('id_persona')
                            ->first();

        $proveedorPP = $this->consultaPPService->consultaProveedorPerfilNegocio($rfc);
        if ($proveedor && $proveedorPP) {
            $this->actualizaProveedorPP($proveedor, $proveedorPP);

            return true;
        } else if ($proveedorPP) {
            // TODO Por el momento la API no devuelve la contraseña del proveedor, necesaria para el registro completo
            if (!isset($proveedorPP['password'])) {
                return false;
            }

            $personaRegistroDatos = [
                'rfc' => $proveedorPP['rfc'],
                'tipo_persona' => $proveedorPP['tipo_persona'],
                'email' => $proveedorPP['email'],
                'password' => $proveedorPP['password'],
            ];
            if ($proveedorPP['tipo_persona'] === Persona::TIPO_PERSONA_FISICA_ID) {
                if (isset($proveedorPP['curp'])) {
                    $personaRegistroDatos['curp'] = $proveedorPP['curp'];
                    $personaRegistroDatos['fecha_nacimiento'] =
                        Carbon::createFromFormat('Y-m-d', $proveedorPP['fecha_nacimiento'])->format('d/m/Y');
                    $personaRegistroDatos['genero'] = $proveedorPP['id_genero'];
                    $personaRegistroDatos['nombre'] = $proveedorPP['nombre'];
                    $personaRegistroDatos['primer_ap'] = $proveedorPP['primer_ap'];
                    $personaRegistroDatos['segundo_ap'] = $proveedorPP['segundo_ap'];
                } else {
                    // Datos no suficientes desde PP para el registro
                    return false;
                }
            } else if ($proveedorPP['tipo_persona'] === Persona::TIPO_PERSONA_MORAL_ID) {
                $personaRegistroDatos['razon_social'] = $proveedorPP['razon_social'];
                $personaRegistroDatos['fecha_constitucion'] = $proveedorPP['fecha_constitucion'];
            }

            $this->creaCuentaProveedorMTV_PP($personaRegistroDatos, $proveedorPP);

            return true;
        }

        return false;
    }

    protected function creaCuentaProveedorMTV(
        array $personaRegistroDatos,
        ?array $domicilioDatos = null,
        int $tipoRegistro = 1,
        bool $passwordEncriptado = false,
    ): User
    {
        $user = null;
        DB::transaction(function() use($personaRegistroDatos, &$user, $domicilioDatos, $tipoRegistro, $passwordEncriptado) {
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
                'password' => $passwordEncriptado ?
                    $personaRegistroDatos['password'] : bcrypt($personaRegistroDatos['password']),
            ]);

            $user->assignRole('proveedor');
        });

        return $user;
    }

    protected function creaCuentaProveedorMTV_PP(
        array $personaRegistroDatos,
        array $proveedorPP,
    ): User
    {
        $idPais = $this->findPais($proveedorPP['pais'] ?? 'Mexico');
        if (!$idPais) {
            throw new \Exception('Nombre de país no encontrado en MTV.');
        }

        $idAsentamiento = $this->findAsentamiento([
            ['cp', $proveedorPP['cp']],
            ['asentamiento', $proveedorPP['asentamiento']],
            ['municipio', $proveedorPP['municipio']]
        ]);
        if (!$idAsentamiento) {
            throw new \Exception('Asentamiento no localizado en MTV.');
        }

        $idTipoVialidad = $this->findTipoVialidad($proveedorPP['tipo_vialidad']);
        if (!$idTipoVialidad) {
            throw new \Exception('Tipo de vialidad no encontrado en MTV.');
        }

        $domicilioDatos = [
            'id_pais' => $idPais,
            'id_asentamiento' => $idAsentamiento,
            'id_tipo_vialidad' => $idTipoVialidad,
            'vialidad' => $proveedorPP['vialidad'],
            'num_ext' => $proveedorPP['num_ext'],
            'num_int' => $proveedorPP['num_int'],
        ];

        $idGrupoPrioritario = null;
        $idTipoPyme = null;
        if ($proveedorPP['es_mipyme'] === true) {
            $idGrupoPrioritario = $this->findGrupoPrioritario('MIPYMES');
            $idTipoPyme = $this->findTipoPyme($proveedorPP['tipo_mipymes']);
        }

        $idSector = null;
        if ($proveedorPP['sector']) {
            $idSector = $this->findSector($proveedorPP['sector']);
        }

        $nombreNegocio = '[No especificado]';
        if ($proveedorPP['tipo_persona'] === Persona::TIPO_PERSONA_FISICA_ID) {
            $nombreNegocio = $proveedorPP['nombre'] . ' ' . $proveedorPP['primer_ap'] . ' ' . $proveedorPP['segundo_ap'];
        } else if ($proveedorPP['tipo_persona'] === Persona::TIPO_PERSONA_MORAL_ID) {
            $nombreNegocio = $proveedorPP['razon_social'];
        }

        $diferenciadores = '';
        if ($proveedorPP['diferenciadores']) {
            $diferenciadores = str_replace(['{', '}', '"'], ['', '', ''], $proveedorPP['diferenciadores']);
        }

        $perfilNegocioDatos = [
            'id_grupo_prioritario' => $idGrupoPrioritario,
            'id_tipo_pyme' => $idTipoPyme,
            'id_sector' => $idSector,
//            'categoria_scian' => null, // Dato no disponible en PP
            'nombre_negocio' => $nombreNegocio,
            'lema_negocio' => $proveedorPP['lema_negocio'] ?? '',
            'descripcion_negocio' => $proveedorPP['descripcion_negocio'] ?? '',
            'diferenciadores' => $diferenciadores,
            'sitio_web' => $proveedorPP['sitio_web'],
            'cuenta_facebook' => $proveedorPP['cuenta_facebook'],
            'cuenta_twitter' => $proveedorPP['cuenta_twitter'],
            'cuenta_linkedin' => $proveedorPP['cuenta_linkedin'],
            'num_whatsapp' => $proveedorPP['num_whatsapp']
        ];

        $contactos = json_encode([[
            'nombre' => $proveedorPP['nombre_contacto'],
            'primer_ap' => $proveedorPP['primer_ap_contacto'] ?? '',
            'segundo_ap' => $proveedorPP['segundo_ap_contacto'] ?? '',
            'cargo' => '', // Dato no disponible en PP
            'telefono_oficina' => $proveedorPP['telefono_fijo'] ?? '',
            'extension' => $proveedorPP['extension'] ?? '',
            'telefono_movil' => $proveedorPP['telefono_movil'] ?? '',
            'email' => $proveedorPP['email_alterno'] ?? '',
        ]]);

        DB::transaction(function() use(&$user, $personaRegistroDatos, $contactos, $domicilioDatos, $perfilNegocioDatos) {
            $user = $this->creaCuentaProveedorMTV($personaRegistroDatos, $domicilioDatos,
                                        self::TIPO_REGISTRO_MTV_PP, true);
            $this->registraPerfilNegocio($perfilNegocioDatos, $user->persona);
            $this->registraContactos($contactos, $user->persona);
        });

        return $user;
    }

    protected function actualizaProveedorPP(User $proveedor, array $proveedorPP): void
    {
        DB::transaction(function() use ($proveedor, $proveedorPP) {
            $cuentaDatos = [
                'email' => $proveedorPP['email'],
            ];
            if (isset($proveedorPP['password'])) {
                $cuentaDatos['password'] = $proveedorPP['password'];
            }
            User::where('id', $proveedor->id)
                    ->update($cuentaDatos);

            $idPais = $this->findPais($proveedorPP['pais'] ?? 'Mexico');
            if (!$idPais) {
                throw new \Exception('Nombre de país no encontrado en MTV.');
            }

            $idAsentamiento = $this->findAsentamiento([
                ['cp', $proveedorPP['cp']],
                ['asentamiento', $proveedorPP['asentamiento']],
                ['municipio', $proveedorPP['municipio']]
            ]);
            if (!$idAsentamiento) {
                throw new \Exception('Asentamiento no localizado en MTV.');
            }

            $idTipoVialidad = $this->findTipoVialidad($proveedorPP['tipo_vialidad']);
            if (!$idTipoVialidad) {
                throw new \Exception('Tipo de vialidad no encontrado en MTV.');
            }

            $domicilioDatos = [
                'email' => $proveedorPP['email'],
                'id_pais' => $idPais,
                'id_asentamiento' => $idAsentamiento,
                'id_tipo_vialidad' => $idTipoVialidad,
                'vialidad' => $proveedorPP['vialidad'],
                'num_ext' => $proveedorPP['num_ext'],
                'num_int' => $proveedorPP['num_int'],
            ];

            Persona::where('id', $proveedor->id_persona)
                        ->update($domicilioDatos);

            $idGrupoPrioritario = null;
            $idTipoPyme = null;
            if ($proveedorPP['es_mipyme'] === true) {
                $idGrupoPrioritario = $this->findGrupoPrioritario('MIPYMES');
                $idTipoPyme = $this->findTipoPyme($proveedorPP['tipo_mipymes']);
            }

            $idSector = null;
            if ($proveedorPP['sector']) {
                $idSector = $this->findSector($proveedorPP['sector']);
            }

            $nombreNegocio = '[No especificado]';
            if ($proveedorPP['tipo_persona'] === Persona::TIPO_PERSONA_FISICA_ID) {
                $nombreNegocio = $proveedorPP['nombre'] . ' ' . $proveedorPP['primer_ap'] . ' ' . $proveedorPP['segundo_ap'];
            } else if ($proveedorPP['tipo_persona'] === Persona::TIPO_PERSONA_MORAL_ID) {
                $nombreNegocio = $proveedorPP['razon_social'];
            }

            $diferenciadores = '';
            if ($proveedorPP['diferenciadores']) {
                $diferenciadores = str_replace(['{', '}', '"'], ['', '', ''], $proveedorPP['diferenciadores']);
            }

            $perfilNegocioDatos = [
                'id_grupo_prioritario' => $idGrupoPrioritario,
                'id_tipo_pyme' => $idTipoPyme,
                'id_sector' => $idSector,
//            'categoria_scian' => null, // Dato no disponible en PP
                'nombre_negocio' => $nombreNegocio,
                'lema_negocio' => $proveedorPP['lema_negocio'] ?? '',
                'descripcion_negocio' => $proveedorPP['descripcion_negocio'] ?? '',
                'diferenciadores' => $diferenciadores,
                'sitio_web' => $proveedorPP['sitio_web'],
                'cuenta_facebook' => $proveedorPP['cuenta_facebook'],
                'cuenta_twitter' => $proveedorPP['cuenta_twitter'],
                'cuenta_linkedin' => $proveedorPP['cuenta_linkedin'],
                'num_whatsapp' => $proveedorPP['num_whatsapp']
            ];

            PerfilNegocio::where('id_persona', $proveedor->id_persona)
                            ->update($perfilNegocioDatos);

            $contacto = [
                'nombre' => $proveedorPP['nombre_contacto'],
                'primer_ap' => $proveedorPP['primer_ap_contacto'] ?? '',
                'segundo_ap' => $proveedorPP['segundo_ap_contacto'] ?? '',
                'cargo' => '', // Dato no disponible en PP
                'telefono_oficina' => $proveedorPP['telefono_fijo'] ?? '',
                'extension' => $proveedorPP['extension'] ?? '',
                'telefono_movil' => $proveedorPP['telefono_movil'] ?? '',
                'email' => $proveedorPP['email_alterno'] ?? '',
            ];

            Contacto::where('id_persona', $proveedor->id_persona)
                      ->where('orden_matriz_escalamiento', 1)
                      ->update($contacto);
        });
    }
}
