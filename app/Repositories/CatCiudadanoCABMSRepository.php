<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CatCiudadanoCABMSRepository
{
    public function obtieneSectores()
    {
        $sectores = DB::table('cat_sectores')
                        ->select('id', 'sector')
                        ->orderBy('sector')
                        ->get()
                        ->toArray();

        return $sectores;
    }

    /**
     * Obtiene todas las categorías SCIAN.
     */
    public function obtieneCategoriasScian(): array
    {
        $giros = $this->getCategoriasScianQBuilder()
                      ->get()
                      ->toArray();

        return $giros;
    }

    /**
     * Obtiene categorías SCIAN correspondientes a un sector (Comercio, Industria, Servicios).
     */
    public function obtieneCategoriasScianPorSector(int $idSector): array
    {
        $giros = $this->getCategoriasScianQBuilder()
                      ->where('id_sector', $idSector)
                      ->get()
                      ->toArray();

        return $giros;
    }

    /**
     * Obtiene categorías SCIAN por palabra clave haciendo uso del algoritmo de búsqueda por aproximación, basado en 'trigram matching'.
     * El query requiere activar la extensión pg_trgm en PostgreSQL. Ver archivo README.md del proyecto para más detalles.
     */
    public function buscaCategoriasScianPorPalabraClave(string $keyword): array
    {
        $giros = DB::table('cat_categorias_scian')
                    ->select('id', 'categora_scian', 'id_sector')
                    ->where("SIMILARITY(categoria_scian, '{$keyword}')", '>', '0.1')
                    ->orWhere("SIMILARITY(palabras_clave_afines, '{$keyword}')", '>', '0.1')
                    ->get()
                    ->toArray();

        // SELECT * FROM cat_categorias_scian WHERE SIMILARITY(categoria_scian, 'pape') > 0.1 and SIMILARITY(palabras_clave_afines, 'pape') > 0.1;
        return $giros;
    }

    public function obtieneClavesCABMS(int $perfilCategoriaScianId, string $criterioBusqueda): array {
        $clavesCABMS = [];

        if ($criterioBusqueda === '') {
            return $clavesCABMS;
        }

        $searchCriteria = [
            [
                DB::raw('LOWER(nombre_cabms)'),
                'LIKE',
                DB::raw("LOWER('%{$criterioBusqueda}%')"),
            ]
        ];

        $query = DB::table('cat_cabms')
            ->select( 'cat_cabms.id', 'cat_cabms.cabms', 'cat_cabms.nombre_cabms', 'cat_cabms.partida AS partida')
            ->join('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'cat_cabms.id_categoria_scian')
            ->where($searchCriteria)
            ->where('id_categoria_scian', '=', $perfilCategoriaScianId);

        $clavesCABMS = $query->get()->toArray();

        return $clavesCABMS;
    }

    private function getCategoriasScianQBuilder()
    {
        return DB::table('cat_categorias_scian')
            ->select('id', 'categoria_scian', 'id_sector')
            ->orderBy('categoria_scian');
    }
}
