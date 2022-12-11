<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Repositories\PersonaRepository;
use App\Services\CertExtractorService;
use App\Services\RegistroPersonaService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Matrix\Exception;

class RegistroMTVController extends Controller
{
    public const TIPO_REGISTRO_CERT = 'C';
    public const TIPO_REGISTRO_EMAIL = 'E';

    public function showRegistroInicio(Request $request)
    {
        $request->session()->regenerate();

        return view('registro.inicio');
    }

    public function showRegistroIdentificacion(Request $request, string $tipoPersona, string $tipoRegistro)
    {
        if ($tipoRegistro === self::TIPO_REGISTRO_CERT) {
            return response()->view('registro.inicio-certificado', [
                'tipoPersona' => $tipoPersona,
            ]);
        } elseif ($tipoRegistro === self::TIPO_REGISTRO_EMAIL) {
            return response()->view('registro.inicio-confirmacion', [
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

        $tipoRegistro = self::TIPO_REGISTRO_CERT;
        $tipoPersona = $request->get('tipo_persona');
        $certPath = $request->file('certificado_file')->getRealPath();
        $personaDatos = null;
        try {
            if ($tipoPersona === Persona::TIPO_PERSONA_FISICA_ID) {
                $personaDatos = $certExtractorService->extraer_pfisica($certPath);
            } elseif ($tipoPersona === Persona::TIPO_PERSONA_MORAL_ID) {
                $personaDatos = $certExtractorService->extraer_pmoral($certPath);
            }
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error al procesar archivo .cer');
        }

        return response()->view('registro.inicio-confirmacion',
            compact('tipoPersona', 'tipoRegistro', 'personaDatos'));
    }

    public function storeRegistroCreaCuenta(Request $request, RegistroPersonaService $registroService, PersonaRepository $personaRepository)
    {
        try {
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
                        self::TIPO_REGISTRO_CERT,
                        self::TIPO_REGISTRO_EMAIL
                    ]),
                ],
                'password' => 'required|min:8|max:15|same:password_confirmacion' // TODO: Aplicar las mismas validaciones que en front-end
            ]);

            $personaDatos = $request->only('tipo_persona', 'email', 'password');
            $tipoPersona = $request->get('tipo_persona');
            $tipoRegistro = $request->get('tipo_registro');

            if ($tipoRegistro === self::TIPO_REGISTRO_CERT) {
                $this->validate($request, ['persona_datos' => 'required|json']);
                $personaDatos = array_merge($personaDatos, json_decode($request->get('persona_datos'), true));
                $personaDatos['genero'] = $personaDatos['sexo'];
                unset($personaDatos['sexo']);
                // TODO: Consultar Renapo para completar nombre, primer_ap, segundo_ap
            } else {
                $this->validate($request, ['email' => 'required|email|same:email_confirmacion']);
                $personaDatos['email'] = $request->get('email');

                if ($tipoPersona === Persona::TIPO_PERSONA_FISICA_ID) {
                    $this->validate($request, [
                        'curp' => 'required|max:18',
                        'rfc' => 'required|max:13',
                    ]);
                    $personaDatos = $request->only(['curp', 'rfc']);
                    // TODO: Consultar Renapo para completar nombre, primer_ap, segundo_ap
                } elseif ($tipoPersona === Persona::TIPO_PERSONA_MORAL_ID) {
                    $this->validate($request, [
                        'rfc' => 'required|max:13',
                        'razon_social' => 'required',
                        'fecha_constitucion' => 'required|date',
                    ]);
                    $personaDatos = $request->only(['rfc', 'razon_social', 'fecha_constitucion']);
                }
            }
        } catch (ValidationException $e) {
            $tipoPersona = $request->get('tipo_persona') ?? null;
            $tipoRegistro = $request->get('tipo_registro') ?? null;
            $personaDatos = $request->get('persona_datos') ? json_decode($request->get('persona_datos'), true) : null;

            $datos = compact('tipoPersona', 'tipoRegistro', 'personaDatos');
            $request->session()->flash('error', 'El proceso de registro no pudo ser completado: ' . $e->getMessage());
            // TODO: Personalizar mensajes de error para password y email que deben coincidir

            return view('registro.inicio-confirmacion', $datos);
        }

        try {
            $registroService->registraPersonaMTV($personaDatos, $personaRepository);

            return redirect()->route('registro-perfil-negocio');
        } catch (\Throwable $e) {
            $request->session()->flash('error', 'El proceso de registro no pudo ser completado: ' . $e->getMessage());

            return view('registro.inicio-confirmacion',
                compact('tipoPersona', 'tipoRegistro', 'personaDatos'));
        }

        /*return redirect()->route('registro-inicio');*/
    }
}
