<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Persona;
use App\Models\PerfilNegocio;
use App\Models\OportunidadNegocio;
use Illuminate\Support\Facades\DB;

/**
 * Clase para extraer convocatorias de la página de concurso digital o de alguna otra fuente de datos establecida.
 */
class OportunidadesNotificacionesRepository
{
    /**
     * Obtiene las oportunidades de negocio marcadas por el usuario.
     */
    public function obtieneOportunidadesMarcadas(User $user) 
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
                      // Deben ser solamente oportunidades vigentes
                      ->where('ec.estatus', "<>", "Cerrado");

        // TODO Seleccionar sugeridos...

        $oportunidades = $query->limit(30)->get();

        return $oportunidades;        
    }

    private function getQuerySelectOportunidades($query, User $user) 
    {
        $userId = $user->id;
        $opnClass = OportunidadNegocio::class;
        
        return $query->select('oportunidades_negocio.id', 'oportunidades_negocio.nombre_procedimiento', 
                            'oportunidades_negocio.fecha_publicacion', 'oportunidades_negocio.fecha_presentacion_propuestas', 
                            'oportunidades_negocio.id_etapa_procedimiento', 'oportunidades_negocio.fuente_url', 
                            'oportunidades_negocio.id_unidad_compradora', 'uc.nombre AS unidad_compradora',
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