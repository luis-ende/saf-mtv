<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OportunidadesNotificacionesRepository;

class CentroNotificacionesController extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, OportunidadesNotificacionesRepository $opnNotifRepo)
    {
        $user = Auth::user();
        $opn_sugeridas =  $opnNotifRepo->obtieneOportunidadesSugeridas($user);
        $opn_marcadas = $opnNotifRepo->obtieneOportunidadesMarcadas($user);

        return view('notificaciones.index', compact('opn_sugeridas', 'opn_marcadas'));
    }
}
