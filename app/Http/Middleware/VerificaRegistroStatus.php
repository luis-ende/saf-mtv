<?php

namespace App\Http\Middleware;

use App\Models\RegistroMTV;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificaRegistroStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authUser = Auth::user();
        if ($authUser && $authUser->persona) {
            if ($authUser->persona->registro_fase === RegistroMTV::REGISTRO_FASE_IDENTIFICACION) {
                return redirect()->route('registro-perfil-negocio.show');
            } elseif ($authUser->persona->registro_fase === RegistroMTV::REGISTRO_FASE_TU_NEGOCIO) {
                return redirect()->route('registro-contactos.show');
            }
        }        

        return $next($request);
    }
}
