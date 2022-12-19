<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioConfiguracionController extends Controller
{
    public function show() 
    {
        $persona = Auth::user()->persona;

        return view('configuracion.show', [
            'email' => $persona->email,
        ]);
    }

    public function update(Request $request) 
    {
        $persona = Auth::user()->persona;
        // if ($persona->email !== )
        

        $this->validate($request, [
            'email' => 'email|same:email_confirmacion|max:255',
            'email_confirmacion' => 'email|max:255',
            'password_actual' => 'required',
            'password' => 'required|min:8|max:15|same:password_confirmacion',
            'password_confirmacion' => 'required',
        ]);

        return redirect()->route('dashboard')->with('success', 'Configuración modificada.');
    }
}