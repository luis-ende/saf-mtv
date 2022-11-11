<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PerfilNegocioController extends Controller
{
     /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $persona = Auth::user()->persona;

        return view('perfil-negocio', [
            'persona' => $persona,            
        ]);
    }
}
