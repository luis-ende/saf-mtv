<?php

namespace App\Repositories;

use App\Models\PerfilNegocio;
use App\Models\Persona;

class PerfilNegocioRepository
{
    public function obtieneDatosProveedor(int $personaId)
    {
        // TODO Obtener nombre o razón social según tipo de persona
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
}
