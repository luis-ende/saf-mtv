<?php

namespace App\Repositories;

use App\Models\EstatusContratacion;
use App\Models\User;
use App\Models\Persona;
use App\Models\PerfilNegocio;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;

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
     * Obtiene oportunidades de negocio que coincidan con el perfil de negocio del usuario
     * o productos registrados en su catálogo.
     */
    public function obtieneOportunidadesSugeridas(User $user) 
    {     
        $query = OportunidadNegocio::from('oportunidades_negocio');
        $query = $this->getQuerySelectOportunidades($query, $user)
                      ->addSelect(DB::raw('true AS oportunidad_sugerida'))                      
                      // Deben ser solamente oportunidades vigentes.
                      ->where('ec.estatus', "<>", EstatusContratacion::ESTATUS_CONTRATACION_FINALIZADO);

        // Omitir sugerencias de oportunidades que hayan sido descartadas por el usuario.
        $userId = $user->id;
        $query = $query->whereNotExists(function($subQ) use($userId) {
            $subQ->select('opns.sugerencia_descartada')
                 ->from('oportunidades_sugeridas AS opns')
                 ->whereRaw(DB::raw('opns.id_oportunidad_negocio = oportunidades_negocio.id'))
                 ->where('opns.id_user', $userId);
        });

        // TODO Sugerencias deben hacer "match" por partida presupuestal con el perfil de negocio y productos del catálogo
        // TODO De no existir el dato de la partida presupuestal, se buscan las coincidencias usando el nombre del procedimiento        

        // select distinct(id_categoria_scian) from cat_cabms where partida = '5412';

        $oportunidades = $query->limit(30)->get();

        return $oportunidades;        
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

    private function getQuerySelectOportunidades($query, User $user) 
    {
        $userId = $user->id;
        $opnClass = OportunidadNegocio::class;
        
        return $query->select('oportunidades_negocio.id', 'oportunidades_negocio.nombre_procedimiento', 
                            'oportunidades_negocio.fecha_publicacion', 'oportunidades_negocio.fecha_presentacion_propuestas', 
                            'oportunidades_negocio.id_etapa_procedimiento', 'oportunidades_negocio.fuente_url', 
                            'oportunidades_negocio.id_unidad_compradora', 'oportunidades_negocio.partidas',
                            DB::raw("SUBSTRING((STRING_TO_ARRAY(partidas, ','))[1], 1, 1) || '000' AS capitulo"),
                            'uc.nombre AS unidad_compradora',
                            'ec.estatus AS estatus_contratacion', 'tc.tipo as tipo_contratacion',
                            'mc.metodo AS metodo_contratacion', 'etp.etapa as etapa_procedimiento',
                            'etp.secuencia as etapa_secuencia')
                    ->addSelect(DB::raw("EXISTS((SELECT 1 FROM markable_bookmarks AS mb " . 
                                    "WHERE mb.markable_id = oportunidades_negocio.id " .
                                    "AND mb.markable_type = '{$opnClass}' " . 
                                    "AND mb.user_id = {$userId})) AS alerta_estatus"))
                    ->leftJoin('cat_unidades_compradoras AS uc', 'uc.id', 'oportunidades_negocio.id_unidad_compradora')
                    ->leftJoin('cat_estatus_contratacion AS ec', 'ec.id', 'oportunidades_negocio.id_estatus_contratacion')
                    ->leftJoin('cat_tipos_contratacion AS tc', 'tc.id', 'oportunidades_negocio.id_tipo_contratacion')
                    ->leftJoin('cat_metodos_contratacion AS mc', 'mc.id', 'oportunidades_negocio.id_metodo_contratacion')
                    ->leftJoin('cat_etapas_procedimiento AS etp', 'etp.id', 'oportunidades_negocio.id_etapa_procedimiento');
    }
}