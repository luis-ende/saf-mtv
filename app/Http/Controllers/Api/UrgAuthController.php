<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AuthenticateWithAccessTokenTrait;
use App\Models\User;
use App\Services\RegistroUsuarioUrgService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UrgAuthController extends Controller
{
    use AuthenticateWithAccessTokenTrait;

    public function registraUsuarioUrg(
        Request $request,
        RegistroUsuarioUrgService $registroService
    ): JsonResponse
    {
        try {
            $request->validate([
                'access_token' => 'required|string',
                'payload' => 'required|array:nombre,rfc,password,email',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        if ($this->authWithAccessToken($request)) {
            try
            {
                $token = $registroService->registraUsuarioUrg($request->input('payload'));
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

    public function loginUsuarioUrg(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('rfc', 'password'))) {
            return response()->json([
                'message' => 'Credenciales para inicio de sesión no válidas.'
            ], 401);
        }

        $user = User::where('rfc', $request['rfc'])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}