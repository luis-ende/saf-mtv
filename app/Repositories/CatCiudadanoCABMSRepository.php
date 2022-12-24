<?php

namespace App\Repositories;

use App\Models\Producto;
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
        // Ejemplo de query:
        // SELECT * FROM cat_cabms cc  JOIN cat_categorias_scian ccs ON ccs.id = cc.id_categoria_scian
        // WHERE SIMILARITY(LOWER(categoria_scian), 'pape') > 0.1 and
        // SIMILARITY(LOWER(palabras_clave_afines), 'pape') > 0.1;

        $giros = DB::table('cat_categorias_scian')
                    ->select('id', 'categora_scian', 'id_sector')
                    ->where("SIMILARITY(LOWER(categoria_scian), LOWER('{$keyword}'))", '>', '0.1')
                    ->orWhere("SIMILARITY(LOWER(palabras_clave_afines), LOWER('{$keyword}'))", '>', '0.1')
                    ->get()
                    ->toArray();

        return $giros;
    }

    public function obtieneClavesCABMS(string $criterioBusqueda, string $tipoProducto = Producto::TIPO_PRODUCTO_BIEN_ID): array {
        // Ejemplo de query:
        // SELECT * FROM cat_cabms cc  JOIN cat_categorias_scian ccs ON ccs.id = cc.id_categoria_scian
        // WHERE SIMILARITY(LOWER(nombre_cabms), 'nopal') > 0.1 OR
        // SIMILARITY(LOWER(palabras_clave_afines), 'nopal') > 0.1;

        $clavesCABMS = [];

        if ($criterioBusqueda === '') {
            return $clavesCABMS;
        }

        // Se aplica menor umbral de coincidencia para servicios (0.1) ya que los nombres cabms son más largos
        $searchCriteria1 = [
            [
                DB::raw("SIMILARITY(LOWER(nombre_cabms), LOWER('{$criterioBusqueda}'))"),
                '>',
                $tipoProducto === Producto::TIPO_PRODUCTO_BIEN_ID ? '0.4' : '0.1',
            ]
        ];

        $searchCriteria2 = [
            [
                DB::raw("SIMILARITY(LOWER(palabras_clave_afines), LOWER('{$criterioBusqueda}'))"),
                '>',
                '0.5',
            ]
        ];

        $searchCriteriaTipoBien = [
            [
                'cat_cabms.partida',
                'not like',
                '3%'
            ],
        ];

        $searchCriteriaTipoServicio = [
            [
                'cat_cabms.partida',
                'like',
                '3%'
            ],
        ];

        $searchCriteriaTipo = $tipoProducto === Producto::TIPO_PRODUCTO_SERVICIO_ID
            ? $searchCriteriaTipoServicio : $searchCriteriaTipoBien;

        $query = DB::table('cat_cabms')
            ->select( 'cat_cabms.id', 'cat_cabms.cabms', 'cat_cabms.nombre_cabms', 'cat_categorias_scian.categoria_scian', 'cat_sectores.sector')
            ->join('cat_categorias_scian', 'cat_categorias_scian.id', '=', 'cat_cabms.id_categoria_scian')
            ->join('cat_sectores', 'cat_sectores.id', '=', 'cat_categorias_scian.id_sector')
            ->where($searchCriteriaTipo)
            ->where($searchCriteria1)
            ->orWhere($searchCriteria2)
            ->orderBy('cat_cabms.nombre_cabms');

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
