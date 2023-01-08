<?php

namespace App\Http\Controllers;

use App\Repositories\CatCiudadanoCABMSRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\PaisesRepository;
use App\Repositories\TipoPymeRepository;
use App\Repositories\VialidadRepository;
use App\Http\Requests\PerfilNegocioRequest;
use App\Repositories\PerfilNegocioRepository;
use App\Repositories\GrupoPrioritarioRepository;

class PerfilNegocioController extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(CatCiudadanoCABMSRepository $catCCABMSRepository)
    {
        $persona = Auth::user()->persona;

        return view('perfil-negocio', [
            'persona' => $persona,
            'cat_paises' => PaisesRepository::obtienePaises(),
            'tipos_vialidad' => VialidadRepository::obtieneTiposVialidad(),
            'grupos_prioritarios' => GrupoPrioritarioRepository::obtieneGruposPrioritarios(),
            'tipos_pyme' => TipoPymeRepository::obtieneTiposPyme(),
            'sectores' => $catCCABMSRepository->obtieneSectores(),
            'categorias_scian' => [], // TODO: Implementar cuando esté listo el catálogo
        ]);
    }

    public function update(PerfilNegocioRequest $request, PerfilNegocioRepository $perfilNegocioRepository)
    {
        // TODO: Implementar TRANSACCION
        $persona = Auth::user()->persona;

        $personaDatos = $request->safe()->only([
            'id_pais',
            'id_asentamiento',
            'id_tipo_vialidad',
            'vialidad',
            'num_ext',
            'num_int'
        ]);
        $persona->update($personaDatos);

        $perfilNegocioDatos = $request->safe()->only([
            'id_grupo_prioritario',
            'id_tipo_pyme',
            'id_sector',
            'id_categoria_scian',
            'lema_negocio',
            'nombre_negocio',
            'descripcion_negocio',
            'diferenciadores',
            'sitio_web',
            'cuenta_facebook',
            'cuenta_twitter',
            'cuenta_linkedin',
            'num_whatsapp',
        ]);

        $adjuntos = $request->safe()->only([
            'logotipo',
            'carta_presentacion',
            'eliminar_carta',
            'catalogo_productos_pdf',
            'eliminar_catalogo_pdf'
        ]);
        $perfilNegocioDatos = array_merge($perfilNegocioDatos, $adjuntos);
        $perfilNegocioRepository->updatePerfilNegocio($persona->perfil_negocio, $perfilNegocioDatos);

        return redirect()->route('dashboard')
            ->with('success', 'Datos de contacto actualizados.');
    }

    public function categoriasScianIndex(Request $request, CatCiudadanoCABMSRepository $catCiudadanoCABMSRepository, ?int $idSector = null)
    {
        if (isset($idSector)) {
            $categorias = $catCiudadanoCABMSRepository->obtieneCategoriasScianPorSector($idSector);
        } else {
            $categorias = $catCiudadanoCABMSRepository->obtieneCategoriasScian();
        }

        return array_map(function($item) {
            return [
                'label' => $item->categoria_scian,
                'value' => $item->id,
                'id_sector' => $item->id_sector,
            ];
        }, $categorias);
    }

    public function categoriasScianPorPalabraClave(Request $request, string $keyword, CatCiudadanoCABMSRepository $catCiudadanoCABMSRepository)
    {
        $categorias = $catCiudadanoCABMSRepository->buscaCategoriasScianPorPalabraClave($keyword);

        return array_map(function($item) {
            return [
                'label' => $item->categoria_scian,
                'value' => $item->id,
                'id_sector' => $item->id_sector,
            ];
        }, $categorias);
    }
}
