<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioUrgRequest;
use App\Mail\NotificacionUsuarioUrgRegistrado;
use App\Repositories\OportunidadNegocioRepository;
use App\Services\RegistroUsuarioUrgService;
use Illuminate\Support\Facades\Mail;

class RegistroURGController extends Controller
{
    public function show(OportunidadNegocioRepository $opnRepo)
    {
        $unidades_compradoras = $opnRepo->obtieneInstitucionesCompradoras();

        return view('registro-urg.show', compact('unidades_compradoras'));
    }

    public function store(UsuarioUrgRequest $request,
                          RegistroUsuarioUrgService $registroUrgService)
    {
        $usuarioData = $request->only([
            'rfc', 'nombre', 'id_urg', 'email', 'password',
        ]);
        $usuarioData['activo'] = false; // Requiere aprobación del administrador
        $registroUrgService->registraUsuarioUrg($usuarioData);

        try
        {
            Mail::to($request->input('email'))->send(new NotificacionUsuarioUrgRegistrado());
        } catch(\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Error al enviar correo de notificación de registro. No fue posible enviar el mensaje.')
                             ->withInput();
        }

        return redirect()
                    ->route('urg-login')
                    ->with('success', 'Registro finalizado. Podrás iniciar sesión una vez que el administrador de MTV haya activado tu cuenta.');
    }
}
