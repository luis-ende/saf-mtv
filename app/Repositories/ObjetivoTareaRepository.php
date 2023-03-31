<?php

namespace App\Repositories;

use App\Models\ObjetivoTarea;
use App\Models\ObjetivoTareaCondicion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ObjetivoTareaRepository
{
    public function obtieneObjetivos(array $objetivosParams): array
    {
        // TODO pasar elemento 'oportunidades_buscadas_guardadas' en array $objetivosParams
        return [
            [
                'id' => ObjetivoTareaCondicion::PerfilNegocioCreado->value,
                'objetivo' => 'Crear Perfil de negocio',
                'completo' => true
            ],
            [
                'id' => ObjetivoTareaCondicion::CatalogoCreado->value,
                'objetivo' => 'Crear Tu Tiendita Virtual',
                'completo' => $objetivosParams['num_productos_proveedor'] > 0,
            ],
            [
                'id' => ObjetivoTareaCondicion::OportunidadesBuscadasGuardadas->value,
                'objetivo' => 'Buscar oportunidades de negocio',
                'completo' => $objetivosParams['ha_usado_buscador_oportunidades'] === true,
            ],
        ];
    }

    public function obtieneObjetivosTareas(): Collection
    {
        return Cache::rememberForever('objetivos_tareas', function() {
            return ObjetivoTarea::select('id', 'sugerencia', 'url_accion', 'objetivo_condicion', 'url_accion')
                ->get();
        });
    }
}