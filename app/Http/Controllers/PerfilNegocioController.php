<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilNegocioController extends Controller
{
     /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('perfil-negocio');
    }
}
