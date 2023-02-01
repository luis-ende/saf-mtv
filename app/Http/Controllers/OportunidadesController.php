<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OportunidadNegocio;
use Maize\Markable\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OportunidadRepository;

class OportunidadesController extends Controller
{
    public function index(Request $request, OportunidadRepository $oportunidadesRepo)
    {
        $userId = auth()->user()?->id;
        $oportunidades = $oportunidadesRepo->buscarOportunidadesNegocio(null, $userId);
        $estadisticas = $oportunidadesRepo->obtieneEstadisticas($oportunidades);
        $filtros_opciones = $this->obtieneFiltrosOpciones($oportunidadesRepo);

        return view('oportunidades.show', compact('filtros_opciones', 'oportunidades', 'estadisticas'));
    }

    public function search(Request $request, OportunidadRepository $oportunidadesRepo)
    {
        $this->validate($request, [
            'oportunidades_search' => 'nullable|string',
            'capitulo_filtro' => 'array',
            'unidad_compradora_filtro' => 'array',
            'tipo_contr_filtro' => 'array',
            'metodo_contr_filtro' => 'array',
            'etapa_proc_filtro' => 'array',
            'estatus_contr_filtro' => 'array',            
            'fecha_inicio_filtro' => 'nullable|date',
            'fecha_final_filtro' => 'nullable|date',
            'fecha_trimestre1_filtro' => 'boolean',
            'fecha_trimestre2_filtro' => 'boolean',
            'fecha_trimestre3_filtro' => 'boolean',
            'fecha_trimestre4_filtro' => 'boolean',
        ]);        

        $filtros = $request->only('capitulo_filtro', 'unidad_compradora_filtro', 'tipo_contr_filtro', 
                                  'metodo_contr_filtro', 'etapa_proc_filtro', 'estatus_contr_filtro', 
                                  'fecha_inicio_filtro', 'fecha_final_filtro', 
                                  'fecha_trimestre1_filtro', 'fecha_trimestre2_filtro',
                                  'fecha_trimestre3_filtro', 'fecha_trimestre4_filtro');        

        $busqueda_termino = $request->input('oportunidades_search');
        $userId = auth()->user()?->id;

        $oportunidades = $oportunidadesRepo->buscarOportunidadesNegocio($busqueda_termino, $userId, $filtros);        
        $estadisticas = $oportunidadesRepo->obtieneEstadisticas($oportunidades);
        $filtros_opciones = $this->obtieneFiltrosOpciones($oportunidadesRepo);        

        return view('oportunidades.show', compact('filtros_opciones', 'oportunidades', 'estadisticas', 'busqueda_termino'));
    }

    public function updateAlerta(Request $request, OportunidadNegocio $oportunidadNegocio) 
    {
        $user = Auth::user();
        Bookmark::toggle($oportunidadNegocio, $user);
        $alerta_estatus = Bookmark::has($oportunidadNegocio, $user);

        return compact('alerta_estatus');
    }

    private function obtieneFiltrosOpciones(OportunidadRepository $oportunidadesRepo): array
    {
        $filtros_opciones['capitulos'] = $oportunidadesRepo->obtieneRubros();
        $filtros_opciones['unidades_compradoras'] = $oportunidadesRepo->obtieneInstitucionesCompradoras();
        $filtros_opciones['tipos_contratacion'] = $oportunidadesRepo->obtieneTiposContratacion();
        $filtros_opciones['metodos_contratacion'] = $oportunidadesRepo->obtieneMetodosContratacion();
        $filtros_opciones['etapas_procedimiento'] = $oportunidadesRepo->obtieneEtapasProcedimiento();
        $filtros_opciones['estatus_contratacion'] = $oportunidadesRepo->obtieneEstatusContratacion();

        return $filtros_opciones;
    }
}
