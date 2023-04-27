<?php

namespace App\Services;
use App\Models\User;
use App\Models\UsuarioURG;
use Illuminate\Support\Facades\Http;

/**
 * Clase servicio para verificar si existe un usuario URG por RFC y su estatus.
 * Si el usuario existe en acceso único, se crea una cuenta URG de MTV con los datos recibidos.
 */
class VerificacionRfcAccesoUnicoService
{
    public function esUsuarioUrg(string $rfc): bool
    {
        $response = Http::get(env('API_TIANGUIS_DIGITAL_ACCESO_UNICO_URG') . $rfc);
        if ($response->successful()) {
            $data = $response->json();
            if ($data['code'] === 200 && isset($data['data'])) {
                $userData = $data['data'];

                // Buscar usuario URG con este RFC
                $urg = User::where('rfc', $rfc)
                            ->whereNotNull('id_urg')
                            ->first();

                if ($urg && $urg->hasRole('urg')) {
                    $this->actualizaUsuarioUrg($urg, $userData);
                } else {
                    $this->creaUsuarioUrg($userData);
                }

                if ($userData['activo'] === true &&
                    $userData['estatus'] === true) {
                    return true;
                }
            }
        }

        return false;
    }

    private function creaUsuarioUrg(array $usuarioData): User
    {
        $email = $usuarioData['user'] . '@test.com'; // Dato no proporcionado por la API
        $usuarioURG = UsuarioURG::create([
            'nombre' => $usuarioData['user'],
            'email' => $email
            //'id_unidad_compradora' => // Dato no proporcionado por la API
        ]);
        $user = User::create([
            'rfc' => $usuarioData['user'],
            'name' => $usuarioData['user'],
            'email' => $email,
            'activo' => $usuarioData['activo'],
            'id_urg' => $usuarioURG->id,
            'last_login' => now(),
            'password' => $usuarioData['password']
        ]);
        $user->assignRole('urg');

        return $user;
    }

    private function actualizaUsuarioUrg(User $urg, array $usuarioData): void
    {
        $email = $usuarioData['user'] . '@test.com'; // Dato no proporcionado por la API
        $urg->urg->nombre = $usuarioData['user'];
        $urg->urg->save();

        $urg->email = $email;
        $urg->password = $usuarioData['password'];
        $urg->activo = $usuarioData['activo'];
        $urg->save();
    }
}