<?php declare(strict_types = 1);

namespace App\Services;

use App\Models\User;
use App\Models\UsuarioURG;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistroUsuarioUrgService
{
    public function registraUsuarioUrg(array $usuarioUrgData): string
    {
        $user = null;
        $usuarioUrg = null;
        DB::transaction(function() use($usuarioUrgData, &$user, &$usuarioUrg) {
            $usuarioUrg = UsuarioURG::create([
                'nombre' => $usuarioUrgData['nombre'],
                'email' => $usuarioUrgData['email'],
            ]);

            $user = User::create([
                'rfc' => $usuarioUrgData['rfc'],
                'name' => $usuarioUrgData['rfc'],
                'email' => $usuarioUrgData['email'],
                'password' => Hash::make($usuarioUrgData['password']),
                'activo' => true,
            ]);
            $user->assignRole('urg');
        });

        $user->id_urg = $usuarioUrg->id;
        $user->save();

        return $user->createToken('authToken')->plainTextToken;
    }
}