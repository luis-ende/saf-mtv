<?php

namespace App\Repositories;

use App\Models\RegistroMTV;
use App\Models\PerfilNegocio;
use Illuminate\Support\Facades\DB;

class PerfilNegocioRepository
{
    public const BUSQUEDA_PROVEEDORES_PAGINATION_OFFSET = 30;

    public function obtieneNumeroProveedoresRegistrados()
    {
        return DB::table('personas')->count();
    }

    public function obtieneDatosProveedor(int $personaId): PerfilNegocio
    {
        return PerfilNegocio::select('perfil_negocio.id', 'perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio',
                                     'cat_sectores.sector', 'cat_categorias_scian.categoria_scian')
                                ->leftJoin('cat_sectores', 'cat_sectores.id', '=', 'perfil_negocio.id_sector')
                                ->leftJoin('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'perfil_negocio.id_categoria_scian')
                                ->where('id_persona', $personaId)
                                ->with('persona')
                                ->firstOrFail();
    }

    public function updatePerfilNegocio(PerfilNegocio $perfilNegocio, array $perfilNegocioDatos): void
    {
        $perfilNegocio->update($perfilNegocioDatos);

        if (isset($perfilNegocioDatos['logotipo'])) {
            $perfilNegocio->clearMediaCollection('logotipos');
            $perfilNegocio->addMedia($perfilNegocioDatos['logotipo'])->toMediaCollection('logotipos');
        }

        if (isset($perfilNegocioDatos['eliminar_carta']) &&
            $perfilNegocioDatos['eliminar_carta'] == true) {
            $perfilNegocio->clearMediaCollection('documentos');
        }
        if (isset($perfilNegocioDatos['carta_presentacion'])) {
            $perfilNegocio->clearMediaCollection('documentos');
            $perfilNegocio->addMedia($perfilNegocioDatos['carta_presentacion'])->toMediaCollection('documentos');
        }

        if (isset($perfilNegocioDatos['eliminar_catalogo_pdf']) &&
            $perfilNegocioDatos['eliminar_catalogo_pdf'] == true) {
            $perfilNegocio->clearMediaCollection('catalogos_pdf');
        }
        if (isset($perfilNegocioDatos['catalogo_productos_pdf'])) {
            $perfilNegocio->clearMediaCollection('catalogos_pdf');
            $perfilNegocio->addMedia($perfilNegocioDatos['catalogo_productos_pdf'])->toMediaCollection('catalogos_pdf');
        }
    }

    /**
     * Realiza búsqueda de proveedores por término y filtros aplicados (Buscador MTV).
     */
    public function buscaProveedoresPorTermino(?string $terminoBusqueda, array $filtros = [], int $offset = 0)
    {
        // Se filtran siempre registros incompletos de proveedores
        $condiciones = [
            ['registro_fase', '>=', RegistroMTV::FASE_REGISTRO_COMPLETO],
        ];

        $terminoBusqueda = strtolower($terminoBusqueda);
        $query = PerfilNegocio::select('perfil_negocio.id', 'perfil_negocio.id_persona', 'perfil_negocio.nombre_negocio',
                                       'cat_sectores.sector', 'cat_categorias_scian.categoria_scian', 'cat_productos.id AS id_cat_productos',
                                       'cat_asentamientos.id_municipio', 'cat_asentamientos.municipio')
            ->leftJoin('personas', 'personas.id', '=', 'perfil_negocio.id_persona')
            ->leftJoin('cat_asentamientos', 'cat_asentamientos.id', '=', 'personas.id_asentamiento')
            ->leftJoin('cat_sectores', 'cat_sectores.id', '=', 'perfil_negocio.id_sector')
            ->leftJoin('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'perfil_negocio.id_categoria_scian')
            ->leftJoin('cat_productos', 'cat_productos.id_persona', '=', 'perfil_negocio.id_persona')
            ->where($condiciones);

        if (isset($filtros['grupo_p_filtro'])) {
            $gruposP = $filtros['grupo_p_filtro'];
            $query = $query->where(function($query) use($gruposP) {
                $query->whereIn('perfil_negocio.id_grupo_prioritario', $gruposP);
            });
        }

        // if (isset($filtros['categoria_filtro'])) {        
        //     $categorias = $filtros['categoria_filtro'];
        //     $query = $query->where(function($query) use($categorias) {
        //         $query->whereIn('perfil_negocio.id_categoria_scian', $categorias);
        //     });
        // }

        if (isset($filtros['alcaldia_filtro'])) {
            $alcaldias = $filtros['alcaldia_filtro'];
            $query = $query->where(function($query) use($alcaldias) {
                $query->whereIn('cat_asentamientos.id_municipio', $alcaldias);
            });
        }

        if (isset($filtros['sector_prov_filtro'])) {
            $sectores = $filtros['sector_prov_filtro'];
            $query = $query->where(function($query) use($sectores) {
                $query->whereIn('perfil_negocio.id_sector', $sectores);
            });
        }

        if ($terminoBusqueda) {            
            $query = $query->where(function($orQuery) use($terminoBusqueda) {
                $orQuery->orWhere(DB::raw('LOWER(perfil_negocio.nombre_negocio)'), 'like', '%' . $terminoBusqueda . '%')
                      ->orWhere(DB::raw('LOWER(perfil_negocio.descripcion_negocio)'), 'like', '%' . $terminoBusqueda . '%');
            });
        }

        if (isset($filtros['sort_proveedores'])) {
            $query = $query->orderBy($filtros['sort_proveedores']);
        }

        $query = $query->offset($offset)
                       ->limit(self::BUSQUEDA_PROVEEDORES_PAGINATION_OFFSET);

        $proveedores = $query->get();

        $proveedores->each(function (&$proveedor) {
            $proveedor['logo_info'] = $proveedor->getFirstMedia('logotipos');
        });

        return $proveedores;
    }
}
