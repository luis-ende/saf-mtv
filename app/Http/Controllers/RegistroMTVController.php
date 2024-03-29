<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\RegistroMTV;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PaisesRepository;
use App\Services\CertExtractorService;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Repositories\PersonaRepository;
use App\Repositories\TipoPymeRepository;
use App\Repositories\VialidadRepository;
use App\Services\RegistroProveedorMTVService;
use App\Http\Requests\PerfilNegocioRequest;
use Illuminate\Validation\ValidationException;
use App\Repositories\GrupoPrioritarioRepository;
use App\Repositories\CatCiudadanoCABMSRepository;
use App\Repositories\PerfilNegocioRepository;

class RegistroMTVController extends Controller
{
    public function showRegistroInicio(Request $request)
    {
        $request->session()->regenerate();

        return view('registro-proveedor.inicio');
    }

    public function showRegistroIdentificacion(Request $request, string $tipoPersona, string $tipoRegistro)
    {
        if ($tipoRegistro === RegistroMTV::TIPO_REGISTRO_CERT) {
            return response()->view('registro-proveedor.inicio-certificado', [
                'tipoPersona' => $tipoPersona,
            ]);
        } elseif ($tipoRegistro === RegistroMTV::TIPO_REGISTRO_EMAIL) {
            return response()->view('registro-proveedor.inicio-confirmacion', [
                'tipoRegistro' => $tipoRegistro,
                'tipoPersona' => $tipoPersona,
            ]);
        }

        return redirect()->route('registro-inicio');
    }

    public function storeRegistroCert(Request $request, CertExtractorService $certExtractorService)
    {
        try {
            $this->validate($request, [
                'tipo_persona' => 'required',
                'certificado_file' => 'required'
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        }

        $tipoRegistro = RegistroMTV::TIPO_REGISTRO_CERT;
        $tipoPersona = $request->input('tipo_persona');
        $certPath = $request->file('certificado_file')->getRealPath();
        $personaDatos = null;
        try {
            if ($tipoPersona === Persona::TIPO_PERSONA_FISICA_ID) {
                $personaDatos = $certExtractorService->extraer_pfisica($certPath);
                if ($personaDatos === false) {
                    throw new InvalidArgumentException('Archivo .cer inválido. No corresponde a persona física.');
                }
            } elseif ($tipoPersona === Persona::TIPO_PERSONA_MORAL_ID) {
                $personaDatos = $certExtractorService->extraer_pmoral($certPath);
                if ($personaDatos === false) {
                    throw new InvalidArgumentException('Archivo .cer inválido. No corresponde a persona moral.');
                }
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        }

        return response()->view('registro-proveedor.inicio-confirmacion',
            compact('tipoPersona', 'tipoRegistro', 'personaDatos'));
    }

    public function storeRegistroCreaCuenta(
        Request $request,
        RegistroProveedorMTVService $registroService)
    {
        // Validaciones de entradas
        try {
            $errorMessages = [
                'rfc.unique' => 'El RFC: ' . $request->input('rfc') . ' ya está registrado en Mi Tiendita Virtual',
            ];

            $this->validate($request, [
                'tipo_persona' => [
                    'required',
                    Rule::in([
                        Persona::TIPO_PERSONA_FISICA_ID,
                        Persona::TIPO_PERSONA_MORAL_ID
                    ]),
                ],
                'tipo_registro' => [
                    'required',
                    Rule::in([
                        RegistroMTV::TIPO_REGISTRO_CERT,
                        RegistroMTV::TIPO_REGISTRO_EMAIL
                    ]),
                ],
                'password' => 'required|min:8|max:15|same:password_confirmacion'
            ]);

            $personaDatos = $request->only('tipo_persona', 'email', 'password');
            $tipoPersona = $request->input('tipo_persona');
            $tipoRegistro = $request->input('tipo_registro');

            if ($request->has('persona_datos')) {
                $this->validate($request, [
                    'persona_datos' => 'required|json',
                ]);
                $personaDatos = array_merge($personaDatos, json_decode($request->input('persona_datos'), true));
                if (($tipoPersona === Persona::TIPO_PERSONA_FISICA_ID) &&
                    !array_key_exists('genero', $personaDatos)) {
                    $personaDatos['genero'] = $personaDatos['sexo'];
                    unset($personaDatos['sexo']);
                }
            }

            if ($tipoRegistro === RegistroMTV::TIPO_REGISTRO_EMAIL) {
                $this->validate($request, [
                    'email' => 'required|email|same:email_confirmacion|max:255',
                ]);
                $personaDatos['email'] = $request->input('email');
                
                if ($tipoPersona === Persona::TIPO_PERSONA_FISICA_ID) {
                    $this->validate($request, [
                        'persona_datos' => 'required|json',
                        'curp' => 'required|max:18',
                        'rfc' => 'required|max:13|unique:users,rfc',
                    ], $errorMessages);
                    $personaDatos = array_merge($personaDatos, $request->only(['curp', 'rfc']));
                } elseif ($tipoPersona === Persona::TIPO_PERSONA_MORAL_ID) {
                    $this->validate($request, [
                        'rfc' => 'required|max:12|unique:users,rfc',
                        'razon_social' => 'required',
                        'fecha_constitucion' => 'required|date',
                    ], $errorMessages);
                    $personaDatos = array_merge($personaDatos, $request->only(['rfc', 'razon_social', 'fecha_constitucion']));
                }
            }
        } catch (ValidationException $e) {
            $tipoPersona = $request->input('tipo_persona') ?? null;
            $tipoRegistro = $request->input('tipo_registro') ?? null;
            $personaDatos = $request->input('persona_datos') ? json_decode($request->get('persona_datos'), true) : null;

            $datos = compact('tipoPersona', 'tipoRegistro', 'personaDatos');
            $request->session()->flash('error', 'El proceso de registro no pudo ser completado: ' . $e->getMessage());

            return view('registro-proveedor.inicio-confirmacion', $datos);
        }

        // Alta de cuenta
        try {
            $user = $registroService->registraProveedorMTV($personaDatos);

            // Iniciar sesión con el nuevo usuario
            event(new Registered($user));
            Auth::login($user);

            $request->user()->sendEmailVerificationNotification();

            return redirect()->route('registro-perfil-negocio.show');
        } catch (\Throwable $e) {
            $request->session()->flash('error', 'El proceso de registro no pudo ser completado debido al siguiente error: ' . $e->getMessage());

            return view('registro-proveedor.inicio-confirmacion',
                compact('tipoPersona', 'tipoRegistro', 'personaDatos'));
        }
    }

    public function showRegistroPerfilNegocio(Request $request, CatCiudadanoCABMSRepository $catCCABMSRepo)
    {
        $persona = Auth::user()->persona;

        if (!$persona->registroCompleto()) {
            return view('registro-proveedor.registro-perfil-negocio', [
                'persona' => $persona,
                'cat_paises' => PaisesRepository::obtienePaises(),
                'tipos_vialidad' => VialidadRepository::obtieneTiposVialidad(),
                'grupos_prioritarios' => GrupoPrioritarioRepository::obtieneGruposPrioritarios(),
                'tipos_pyme' => TipoPymeRepository::obtieneTiposPyme(),
                'sectores' => $catCCABMSRepo->obtieneSectores(),                
            ]);
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function storeRegistroPerfilNegocio(PerfilNegocioRequest $request, PerfilNegocioRepository $perfilNegocioRepository)
    {
        $persona = Auth::user()->persona;

        if (!$persona->registroCompleto()) {
            try {
                $personaDatos = $request->safe()->only([
                    'id_pais',
                    'id_asentamiento',
                    'id_tipo_vialidad',
                    'vialidad',
                    'num_ext',
                    'num_int'
                ]);
                if ($persona->registro_fase === RegistroMTV::REGISTRO_FASE_IDENTIFICACION) {
                    $personaDatos['registro_fase'] = RegistroMTV::REGISTRO_FASE_TU_NEGOCIO;
                }
                $persona->update($personaDatos);

                $perfilNegocioDatos = $request->safe()->only([
                    'id_grupo_prioritario',
                    'id_tipo_pyme',
                    'id_sector',
                    'id_categoria_scian',
                    'lema_negocio',
                    'nombre_negocio',
                    'descripcion_negocio',
                    'diferenciadores',
                    'sitio_web',
                    'cuenta_facebook',
                    'cuenta_twitter',
                    'cuenta_linkedin',
                    'num_whatsapp',
                ]);

                $perfilNegocio = $persona->perfil_negocio;
                if (!$perfilNegocio) {
                    $registroPersonaService = new RegistroProveedorMTVService();
                    $perfilNegocio = $registroPersonaService->registraPerfilNegocio($perfilNegocioDatos, $persona);
                }

                $adjuntos = $request->safe()->only(['logotipo', 'carta_presentacion', 'eliminar_carta']);
                $perfilNegocioDatos = array_merge($perfilNegocioDatos, $adjuntos);
                $perfilNegocioRepository->updatePerfilNegocio($perfilNegocio, $perfilNegocioDatos);

                return redirect()->route('registro-contactos.show');
            } catch (ValidationException $e) {
                $request->session()->flash('error', 'Error al guardar datos: ' . $e->getMessage());

                return redirect()->route('registro-perfil-negocio.show')
                    ->withErrors($e->validator)
                    ->withInput();
            }
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function showRegistroContactos(Request $request)
    {
        $persona = Auth::user()->persona;

        if (!$persona->registroCompleto()) {
            if ($persona->registro_fase === RegistroMTV::REGISTRO_FASE_TU_NEGOCIO) {
                return view('registro-proveedor.registro-contactos', [
                    'persona' => $persona,
                ]);
            } elseif ($persona->registro_fase === RegistroMTV::REGISTRO_FASE_IDENTIFICACION) {
                return redirect()->route('registro-perfil-negocio.show');
            }
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function storeRegistroContactos(Request $request)
    {
        $persona = Auth::user()->persona;

        try {
            $this->validate($request, [
                'contactos_lista' => 'required|json',
            ]);
        } catch (ValidationException $e) {
            return redirect()->route('registro-contactos.show')
                ->withErrors($e->validator)
                ->withInput();
        }

        try {
            $registroPersonaService = new RegistroProveedorMTVService();
            $registroPersonaService->registraContactos($request->input('contactos_lista'), $persona);
        } catch (\Throwable $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        
        return redirect(RouteServiceProvider::HOME)->with('registro-completo', '¡Registro exitoso!');
    }
}
