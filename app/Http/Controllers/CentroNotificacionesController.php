<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CentroNotificacionesController extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('notificaciones.index');
    }
}
