<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioUrgRequest;
use App\Repositories\OportunidadNegocioRepository;
use App\Services\RegistroUsuarioUrgService;

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

        return redirect()->route('urg-login')->with('success', 'Registro finalizado. Podrás iniciar sesión una vez que el administrador de MTV haya activado tu cuenta.');
    }
}
