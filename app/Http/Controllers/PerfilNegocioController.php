<?php

namespace App\Http\Controllers;

use App\Repositories\GrupoPrioritarioRepository;
use App\Repositories\PersonaRepository;
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

    public function update(Request $request, PersonaRepository $personaRepository)
    {
        // TODO: Implementar transacción
        $persona = Auth::user()->persona;
        $persona['id_asentamiento'] = $request->input('id_asentamiento');
        $persona['id_tipo_vialidad'] = $request->input('id_tipo_vialidad');
        $persona['vialidad'] = $request->input('vialidad');
        $persona['num_ext'] = $request->input('num_ext');
        $persona['num_int'] = $request->input('num_int');
        $persona->save();

        // TODO: Implementar guardado de nueva contraseña

        $personaRepository->updateContactos($persona, $request->input('contactos_lista'));

        return redirect()->route('dashboard');
    }

    public function updateDescripcionNegocio(Request $request)
    {
        $perfilNegocio = Auth::user()->persona->perfil_negocio;
        $perfilNegocio['id_grupo_prioritario'] = $request->input('id_grupo_prioritario');
        $perfilNegocio['id_tipo_pyme'] = $request->input('id_tipo_pyme');
        $perfilNegocio['id_sector'] = $request->input('id_sector');
        $perfilNegocio['id_categoria_scian'] = $request->input('id_categoria_scian');
        $perfilNegocio['lema_negocio'] = $request->input('lema_negocio');
        $perfilNegocio['descripcion_negocio'] = $request->input('descripcion_negocio');
        $perfilNegocio['diferenciadores'] = $request->input('diferenciadores');
        $perfilNegocio['sitio_web'] = $request->input('sitio_web');
        $perfilNegocio['cuenta_facebook'] = $request->input('cuenta_facebook');
        $perfilNegocio['cuenta_twitter'] = $request->input('cuenta_twitter');
        $perfilNegocio['cuenta_linkedin'] = $request->input('cuenta_linkedin');
        $perfilNegocio['num_whatsapp'] = $request->input('num_whatsapp');
        $perfilNegocio->save();

        if ($request->file('logotipo') && $this->validate($request, ['logotipo' => 'mimes:jpg,bmp,png'])) {
            $path = $request->file('logotipo')->store('public/logotipos');
            $perfilNegocio->clearMediaCollection('logotipos');
            $perfilNegocio->addMedia(storage_path('app') . '/' . $path)->toMediaCollection('logotipos');
        }

        return redirect()->route('dashboard');
    }
}
