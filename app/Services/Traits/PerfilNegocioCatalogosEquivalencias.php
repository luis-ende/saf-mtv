<?php

namespace App\Services\Traits;

use App\Repositories\TipoPymeRepository;
use Illuminate\Support\Facades\DB;

trait PerfilNegocioCatalogosEquivalencias
{
    public function findPais(string $pais): ?int
    {
        return  DB::table('cat_paises')
                    ->whereRaw('UPPER(pais) LIKE ?', [strtoupper($pais)])
                    ->value('id');
    }

    public function findAsentamiento(array $asentamiento): ?int
    {
        return DB::table('cat_asentamientos')
                    ->where($asentamiento)->value('id');
    }

    public function findTipoVialidad(string $tipoVialidad): ?int
    {
        return DB::table('cat_tipo_vialidad')
                    ->whereRaw('UPPER(tipo_vialidad) LIKE ?', [strtoupper($tipoVialidad)])
                    ->value('id');
    }

    public function findGrupoPrioritario(string $grupoPrioritario): ?int
    {
        return  DB::table('cat_grupos_prioritarios')
                    ->whereRaw('UPPER(grupo) LIKE ?', [strtoupper($grupoPrioritario)])
                    ->value('id');
    }

    public function findTipoPyme(string $tipo_pyme): ?int
    {
        $tipos = array_filter(TipoPymeRepository::TIPOS_PYME, function ($t) use ($tipo_pyme) {
            return strtoupper($t['tipo_pyme']) === strtoupper($tipo_pyme);
        });

        if (count($tipos)) {
            return $tipos[0]['id'];
        }

        return null;
    }

    public function findSector(string $sector): ?int
    {
        return DB::table('cat_categorias_scian')
                    ->whereRaw('UPPER(categoria_scian) LIKE ?', [strtoupper($sector)])
                    ->value('id');
    }

    public function findCategoriaScian(string $categoriaScian): ?int
    {
        return  DB::table('cat_categorias_scian')
                    ->whereRaw('UPPER(categoria_scian) LIKE ?', [strtoupper($categoriaScian)])
                    ->value('id');
    }
}