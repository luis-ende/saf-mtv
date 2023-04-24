<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\OportunidadNegocio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\EstatusContratacion;
use App\Repositories\OportunidadNegocioRepository;
use Maize\Markable\Models\Bookmark;

/**
 * Clase repositorio para el centro de notificaciones de oportunidades de negocio.
 */
class OportunidadesNotificacionesRepository
{
    /**
     * Obtiene las oportunidades de negocio marcadas con bookmark por el usuario.
     */
    public function obtieneOportunidadesGuardadas(User $user)
    {        
        $query = OportunidadNegocio::whereHasBookmark($user);
        $oportunidades = $this->getQuerySelectOportunidades($query, $user)
                              ->get();

        return $oportunidades;
    }

    /**
     * Obtiene el constructor de expresiones SQL para obtener oportunidades de negocio que
     * coincidan con el perfil de negocio del usuario  o productos registrados en su catálogo.
     */
    public function obtieneOportunidadesSugeridasQB(User $user, string $proveedorPartidas): Builder
    {     
        $query = OportunidadNegocio::from('oportunidades_negocio');
        $query = $this->getQuerySelectOportunidades($query, $user)
                      ->addSelect(DB::raw('true AS oportunidad_sugerida'))                      
                      // Deben ser solamente oportunidades vigentes.
                      ->whereNotNull('oportunidades_negocio.partidas')
                      ->where([
                          ['ec.estatus', "<>", EstatusContratacion::ESTATUS_CONTRATACION_FINALIZADO],
                          ['oportunidades_negocio.partidas', '!=', '']
                      ]);

        // Omitir sugerencias de oportunidades que hayan sido descartadas por el usuario.
        $userId = $user->id;
        $query = $query->whereNotExists(function($subQ) use($userId) {
            $subQ->select('opns.sugerencia_descartada')
                 ->from('oportunidades_sugeridas AS opns')
                 ->whereRaw(DB::raw('opns.id_oportunidad_negocio = oportunidades_negocio.id'))
                 ->where('opns.id_user', $userId);
        });

        // Filtro de oportunidades de negocio por partidas similares en perfil de negocio, productos y categorías de productos del usuario
        $query = $query->where(function($subQ) use($proveedorPartidas) {
            // Condición SQL para comparar partidas de la oportunidad de negocio con las del proveedor
            // Ver https://www.postgresql.org/docs/current/functions-array.html
            $subQ->whereRaw("STRING_TO_ARRAY(oportunidades_negocio.partidas, ',') <@ array[{$proveedorPartidas}]");
        });

        return $query;
    }

    public function obtieneOportunidadesSugeridas(User $user): Collection
    {
        $perfNegocioId = $user->persona->perfil_negocio->id;
        $catProductosId = $user->persona->catalogoProductos->id;
        $proveedorPartidas = $this->obtieneProveedorPartidas($catProductosId, $perfNegocioId);

        // La consulta sólo se ejecuta si se encontraron partidas asociadas al usuario.
        if (!empty($proveedorPartidas)) {
            $partidas = array_map(function ($p) {
                        return "'{$p->partida}'";
                    }, $proveedorPartidas);
            $partidas = implode(',', $partidas);

            $qb = $this->obtieneOportunidadesSugeridasQB($user, $partidas);
            $oportunidades = $qb->limit(30)->get();

            // TODO Una vez obtenidas las oportunidades que coinciden, se podría aplicar
            // un filtro más específico con las oportunidades que tienen datos en el campo 'cabms'
        } else {
            $oportunidades = new Collection();
        }

        return $oportunidades;
    }

    public function obtieneNumOportunidadesSugeridas(User $user): int
    {
        return $this->obtieneOportunidadesSugeridas($user)->count();
    }

    /**
     * Marca la oportunidad de negocio como descartada por el usuario en notificaciones (oportunidades sugeridas).
     */
    public function agregaSugerenciaDescartada(User $user, OportunidadNegocio $oportunidad) 
    {
        return DB::table('oportunidades_sugeridas')->updateOrInsert([
            'id_user' => $user->id,
            'id_oportunidad_negocio' => $oportunidad->id,            
        ], [
            'sugerencia_descartada' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Obtiene el número de bookmarks guardados por un usuario.
     */
    public function obtieneNumBookmarks(User $user): int
    {
        return DB::table('markable_bookmarks')->selectRaw('COUNT(*) AS usuario_num_bookmarks')
                                              ->where('user_id', $user->id)
                                              ->value('usuario_num_bookmarks');
    }

    private function getQuerySelectOportunidades($query, User $user) 
    {
        $userId = $user->id;
        $opnClass = OportunidadNegocio::class;

        $querySelectNumBookmarks = OportunidadNegocioRepository::subqueryOportunidadBookmarks('oportunidades_negocio');
        
        return $query->select('oportunidades_negocio.id', 'oportunidades_negocio.nombre_procedimiento', 
                            'oportunidades_negocio.fecha_publicacion', 'oportunidades_negocio.fecha_presentacion_propuestas', 
                            'oportunidades_negocio.id_etapa_procedimiento', 'oportunidades_negocio.fuente_url', 
                            'oportunidades_negocio.id_unidad_compradora', 'oportunidades_negocio.partidas',
                            DB::raw("SUBSTRING((STRING_TO_ARRAY(partidas, ','))[1], 1, 1) || '000' AS capitulo"),
                            'uc.nombre AS unidad_compradora',
                            'ec.estatus AS estatus_contratacion', 'tc.tipo as tipo_contratacion',
                            'mc.metodo AS metodo_contratacion', 'etp.etapa as etapa_procedimiento',
                            'etp.secuencia as etapa_secuencia', $querySelectNumBookmarks)
                    ->addSelect(DB::raw("EXISTS((SELECT 1 FROM markable_bookmarks AS mb " . 
                                    "WHERE mb.markable_id = oportunidades_negocio.id " .
                                    "AND mb.markable_type = '{$opnClass}' " . 
                                    "AND mb.user_id = {$userId})) AS alerta_estatus"))
                    ->leftJoin('cat_unidades_compradoras AS uc', 'uc.id', 'oportunidades_negocio.id_unidad_compradora')
                    ->leftJoin('cat_estatus_contratacion AS ec', 'ec.id', 'oportunidades_negocio.id_estatus_contratacion')
                    ->leftJoin('cat_tipos_contratacion AS tc', 'tc.id', 'oportunidades_negocio.id_tipo_contratacion')
                    ->leftJoin('cat_metodos_contratacion AS mc', 'mc.id', 'oportunidades_negocio.id_metodo_contratacion')
                    ->leftJoin('cat_etapas_procedimiento AS etp', 'etp.id', 'oportunidades_negocio.id_etapa_procedimiento')
                    ->orderByDesc('oportunidades_negocio.fecha_publicacion');        
    }

    /**
     * Obtiene todas las partidas asociadas al Perfil de negocio y productos del usuario.
     */
    private function obtieneProveedorPartidas(int $catProductosId, int $perfNegocioId): array
    {
        $subselProductos = DB::table('productos AS p')->selectRaw(DB::raw('DISTINCT(ccb.partida)'))
                            ->join('cat_cabms AS ccb', 'ccb.id', 'p.id_cabms')
                            ->where('p.id_cat_productos', $catProductosId);

        $subselProdCategorias = DB::table('productos_categorias AS pc')->selectRaw(DB::raw('DISTINCT(ccb.partida)'))
                            ->join('productos AS p', 'p.id', 'pc.id_producto')
                            ->join('cat_cabms AS ccb', 'ccb.id_categoria_scian', 'pc.id_categoria_scian')
                            ->where('p.id_cat_productos', $catProductosId);

        $partidas = DB::table('cat_cabms AS ccb')
                            ->selectRaw(DB::raw('DISTINCT(ccb.partida)'))
                            ->where('ccb.id_categoria_scian', '=', function($subSel) use($perfNegocioId) {
                                $subSel->from('perfil_negocio AS perfn')
                                    ->select('perfn.id_categoria_scian')
                                    ->where('perfn.id', $perfNegocioId);
                            })
                            ->union($subselProductos)
                            ->union($subselProdCategorias);

        return $partidas->get()->toArray();
    }
}