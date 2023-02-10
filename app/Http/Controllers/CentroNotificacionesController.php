<?php

namespace App\Http\Controllers;

use App\Models\OportunidadNegocio;
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
        $opn_guardadas = $opnNotifRepo->obtieneOportunidadesGuardadas($user);

        return view('notificaciones.index', compact('opn_sugeridas', 'opn_guardadas'));
    }

    public function destroy(Request $request, OportunidadNegocio $oportunidad, OportunidadesNotificacionesRepository $opnNotifRepo)  
    {
        $user = Auth::user();
        $result = $opnNotifRepo->agregaSugerenciaDescartada($user, $oportunidad);

        return [$result];
    }
}
