<?php

namespace App\Repositories;

use App\Models\PerfilNegocio;
use App\Models\Persona;

class PerfilNegocioRepository
{
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
