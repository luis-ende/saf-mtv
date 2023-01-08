<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class UsuarioConfiguracionController extends Controller
{
    public function show(Request $request)
    {
        $persona = Auth::user()->persona;

        return view('configuracion.show', [
            'email' => $persona->email,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $persona = $user->persona;

        if ($request->has('email_confirmacion') && !empty($request->input('email_confirmacion'))) {
            $this->validate($request, [
                'email' => 'email|same:email_confirmacion|max:255',
                'email_confirmacion' => 'email|max:255',
            ]);

            $email =  $request->input('email');
            if ($email !== $persona->email) {
                $persona->update([
                    'email' => $email,
                ]);
            }
        }

        if ($request->has('password') && !empty($request->input('password'))) {
            $this->validate($request, [
                'password_actual' => 'min:8|max:15',
                'password' => 'min:8|max:15|same:password_confirmacion',
                'password_confirmacion' => 'min:8|max:15',
            ]);

            $credentials['rfc'] = $persona->rfc;
            $credentials['password'] = $request->input('password_actual');
            if (Auth::attempt($credentials)) {
                $user->update([
                    'password' => Hash::make($request->input('password')),
                ]);

                event(new PasswordReset($user));
            } else {
                return redirect()->back()->with('error', 'La contraseña actual proporcionada es incorrecta.');
            }
        }

        return redirect()->route('dashboard')->with('success', 'Configuración modificada.');
    }
}
