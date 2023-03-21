<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AuthenticateWithAccessTokenTrait;
use App\Http\Requests\PerfilNegocioRequest;
use App\Models\Persona;
use App\Services\RegistroProveedorMTVService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProveedorAuthController extends Controller
{
    use AuthenticateWithAccessTokenTrait;

    private RegistroProveedorMTVService $registroService;

    public function __construct(RegistroProveedorMTVService $registroService)
    {
        $this->registroService = $registroService;
    }

    public function registraProveedor(Request $request): JsonResponse
    {
        if ($this->authWithAccessToken($request)) {
            $response = $this->validaDatosRegistro($request);
            if ($response) {
                return $response;
            }

            try
            {
                $token = $this->procesaDatosRegistro($request);
            } catch(\Throwable $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json([
            'error' => 'Permiso denegado.',
        ]);
    }

    private function validaDatosRegistro(Request $request)
    {
        try {
            $request->validate([
                'access_token' => 'required|string',
                'payload' => 'required|array:persona,domicilio,perfil_negocio,contactos',
            ]);

            $validator = Validator::make($request->payload['persona'], [
                'tipo_persona' => [
                    'required',
                    Rule::in([
                        Persona::TIPO_PERSONA_FISICA_ID,
                        Persona::TIPO_PERSONA_MORAL_ID
                    ]),
                ],
                'rfc' => 'required|string|unique:users',
                'email' => 'required|string',
                'password' => 'required',
                'curp' => "nullable|string",
                'fecha_nacimiento' => "nullable|date",
                'genero' => "nullable|string",
                'nombre' => "nullable|string",
                'primer_ap' => "nullable|string",
                'segundo_ap' => "nullable|string",
                'razon_social' => "nullable|string",
                'fecha_constitucion' => "nullable|date"
            ]);
            if (!$validator->passes()) {
                return response()->json(['error' => $validator->errors()]);
            }

            $perfilNegocioRules = new Collection((new PerfilNegocioRequest())->rules());

            $validator = Validator::make($request->payload['domicilio'], [
                'pais' => 'required|string',
                'cp' => 'required|string',
                'asentamiento' => 'required|string',
                'alcaldia' => 'required|string',
                'ciudad' => 'required|string',
                'entidad' => 'required|string',
                'tipo_vialidad' => 'required|string',
                ...$perfilNegocioRules->only('vialidad', 'num_ext', 'num_int')->toArray(),
            ]);
            if (!$validator->passes()) {
                return response()->json(['error' => $validator->errors()]);
            }

            $validator = Validator::make($request->payload['perfil_negocio'], [
                'grupo_prioritario' => 'required|string',
                'sector' => 'required|string',
                'categoria_scian' => 'nullable|string', // @todo campo requerido, buscar default apropiado si el dato no se especifica
                ...$perfilNegocioRules->only('id_tipo_pyme', 'nombre_negocio', 'lema_negocio', 'descripcion_negocio',
                    'diferenciadores', 'sitio_web', 'cuenta_facebook',
                    'cuenta_twitter', 'cuenta_linkedin', 'num_whatsapp')->toArray(),
            ]);
            if (!$validator->passes()) {
                return response()->json(['error' => $validator->errors()]);
            }

            $validator = Validator::make($request->payload['contactos'], [
                '*.nombre' => 'required|string',
                '*.primer_ap' => 'required|string',
                '*.segundo_ap' => 'nullable|string',
                '*.cargo' => 'required|string',
                '*.telefono_oficina' => 'required|string',
                '*.extension' => 'required|string',
                '*.telefono_movil' => 'required|string',
                '*.email' => 'required|email',
            ]);
            if (!$validator->passes()) {
                return response()->json(['error' => $validator->errors()]);
            }
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()]);
        }

        return null;
    }

    private function procesaDatosRegistro(Request $request): string
    {
        $domicilioDatos = $request->payload['domicilio'];

        $idPais = DB::table('cat_paises')->whereRaw('UPPER(pais) LIKE ?', [strtoupper($domicilioDatos['pais'])])
                                               ->value('id');
        if ($idPais) {
            $domicilioDatos['id_pais'] = $idPais;
            unset($domicilioDatos['pais']);
        } else {
            throw new \Exception('Nombre de país no encontrado en MTV.');
        }

        $idAsentamiento = DB::table('cat_asentamientos')->where([
            ['cp', $domicilioDatos['cp']],
            ['asentamiento', $domicilioDatos['asentamiento']],
            ['municipio', $domicilioDatos['alcaldia']]])->value('id');
        if ($idAsentamiento) {
            $domicilioDatos['id_asentamiento'] = $idAsentamiento;
            unset($domicilioDatos['pais']);
            unset($domicilioDatos['cp']);
            unset($domicilioDatos['asentamiento']);
            unset($domicilioDatos['alcaldia']);
            unset($domicilioDatos['ciudad']);
            unset($domicilioDatos['entidad']);
        } else {
            throw new \Exception('Asentamiento no localizado en MTV.');
        }

        $idTipoVialidad = DB::table('cat_tipo_vialidad')
                            ->whereRaw('UPPER(tipo_vialidad) LIKE ?', [strtoupper($domicilioDatos['tipo_vialidad'])])
                            ->value('id');
        if ($idTipoVialidad) {
            $domicilioDatos['id_tipo_vialidad'] = $idTipoVialidad;
            unset($domicilioDatos['tipo_vialidad']);
        } else {
            throw new \Exception('Tipo de vialidad no encontrado en MTV.');
        }

        $perfilNegocioDatos = $request->payload['perfil_negocio'];
        $idGrupoPrioritario = DB::table('cat_grupos_prioritarios')
                                ->whereRaw('UPPER(grupo) LIKE ?', [strtoupper($perfilNegocioDatos['grupo_prioritario'])])
                                ->value('id');
        if ($idGrupoPrioritario) {
            $perfilNegocioDatos['id_grupo_prioritario'] = $idGrupoPrioritario;
            if ($perfilNegocioDatos['grupo_prioritario'] === 'MIPYMES' && !$perfilNegocioDatos['id_tipo_pyme']) {
                throw new \Exception('Tipo de Pyme no especificado.');
            }
            unset($perfilNegocioDatos['grupo_prioritario']);
        } else {
            throw new \Exception('Grupo prioritario no encontrado en MTV.');
        }

        $idSector = DB::table('cat_sectores')
            ->whereRaw('UPPER(sector) LIKE ?', [strtoupper($perfilNegocioDatos['sector'])])
            ->value('id');
        if ($idSector) {
            $perfilNegocioDatos['id_sector'] = $idSector;
            unset($perfilNegocioDatos['sector']);
        } else {
            throw new \Exception('Sector no encontrado en MTV.');
        }

        $idCategoriaScian = DB::table('cat_categorias_scian')
            ->whereRaw('UPPER(categoria_scian) LIKE ?', [strtoupper($perfilNegocioDatos['categoria_scian'])])
            ->value('id');
        if ($idCategoriaScian) {
            $perfilNegocioDatos['id_categoria_scian'] = $idCategoriaScian;
            unset($perfilNegocioDatos['categoria_scian']);
        } else {
            throw new \Exception('Categoria SCIAN no encontrada en MTV.');
        }

        // @todo Agregar campo para identificar procedencia del registro de proveedor en tabla de 'personas'
        $user = null;
        $payload = $request->payload;
        DB::transaction(function() use(&$user, $payload, $domicilioDatos, $perfilNegocioDatos) {
            $user = $this->registroService->registraProveedorMTV($payload['persona'], $domicilioDatos,
                                                        RegistroProveedorMTVService::TIPO_REGISTRO_EXTERNO);
            $this->registroService->registraPerfilNegocio($perfilNegocioDatos, $user->persona);
            $this->registroService->registraContactos(json_encode($payload['contactos']), $user->persona);
        });

        return $user->createToken('authToken')->plainTextToken;
    }
}