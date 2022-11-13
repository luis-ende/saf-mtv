<?php

namespace App\Http\Controllers;

use App\Repositories\GrupoPrioritarioRepository;
use App\Repositories\SectorRepository;
use App\Repositories\TipoPymeRepository;
use Illuminate\Http\Request;

use App\Repositories\VialidadRepository;

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
            'tipos_vialidad' => VialidadRepository::obtieneTiposVialidad(),
            'grupos_prioritarios' => GrupoPrioritarioRepository::obtieneGruposPrioritarios(),
            'tipos_pyme' => TipoPymeRepository::obtieneTiposPyme(),
            'sectores' => SectorRepository::obtieneSectores(),
            'categorias_scian' => [], // TODO: Implementar cuando esté listo el catálogo
        ]);
    }

    public function update()
    {
        return redirect()->route('dashboard');
    }

    public function updateDescripcionNegocio()
    {
        return redirect()->route('dashboard');
    }
}
