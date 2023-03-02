<?php

namespace App\Repositories;

use App\Models\PreguntaFrecuente;
use Illuminate\Support\Collection;

class PreguntasFrecuentesRepository
{
    public function obtienePreguntasFrecuentes(?int $categoria = null, ?int $subcategoria = null): Collection
    {
        $query = PreguntaFrecuente::select('categoria', 'subcategoria', 'pregunta', 'respuesta');

        if ($categoria || $subcategoria) {
            if ($categoria) {
                $query = $query->where('categoria', $categoria);
            }
            if ($subcategoria) {
                $query = $query->where('subcategoria', $subcategoria);
            }

            return $query->get();
        }

        return $query->get();
    }
}