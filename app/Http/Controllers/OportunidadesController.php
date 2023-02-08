<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OportunidadNegocio;
use Maize\Markable\Models\Bookmark;
use App\Exports\OportunidadesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OportunidadNegocioRepository;

class OportunidadesController extends Controller
{
    public function search(Request $request, OportunidadNegocioRepository $oportunidadesRepo)
    {
        $oportunidades = $this->searchHandleRequest($request, $oportunidadesRepo);
        $estadisticas = $oportunidadesRepo->obtieneEstadisticas($oportunidades);
        $filtros_opciones = $this->obtieneFiltrosOpciones($oportunidadesRepo);
        $busqueda_termino = $request->input('tb');

        return view('oportunidades.show', compact('filtros_opciones', 'oportunidades', 'estadisticas', 'busqueda_termino'));
    }

    public function updateAlerta(Request $request, OportunidadNegocio $oportunidadNegocio) 
    {
        $user = Auth::user();
        Bookmark::toggle($oportunidadNegocio, $user);
        $alerta_estatus = Bookmark::has($oportunidadNegocio, $user);

        return compact('alerta_estatus');
    }

    /**
     * Exporta las oportunidades de negocio en la vista del buscador de oportunidades de negocio.
     * Aplica los filtros activos.
     */
    public function exportOportunidadesNegocio(Request $request, OportunidadNegocioRepository $oportunidadesRepo) 
    {
        $oportunidades = $this->searchHandleRequest($request, $oportunidadesRepo);

        return Excel::download(new OportunidadesExport($oportunidades),
                      'mtv-oportunidades-negocio.xlsx',
                    \Maatwebsite\Excel\Excel::XLSX);
    }

    private function searchHandleRequest(Request $request, OportunidadNegocioRepository $oportunidadesRepo) 
    {
        $this->convierteQueryParams($request);

        $this->validate($request, [
            'tb' => 'nullable|string',
            'capitulo_filtro' => 'array',
            'unidad_compradora_filtro' => 'array',
            'tipo_contr_filtro' => 'array',
            'metodo_contr_filtro' => 'array',
            'etapa_proc_filtro' => 'array',
            'estatus_contr_filtro' => 'array',            
            'fecha_inicio_filtro' => 'nullable|date',
            'fecha_final_filtro' => 'nullable|date',
            'fecha_trimestre1_filtro' => 'nullable|boolean',
            'fecha_trimestre2_filtro' => 'nullable|boolean',
            'fecha_trimestre3_filtro' => 'nullable|boolean',
            'fecha_trimestre4_filtro' => 'nullable|boolean',
        ]);        

        $filtros = $request->only('capitulo_filtro', 'unidad_compradora_filtro', 'tipo_contr_filtro', 
                                  'metodo_contr_filtro', 'etapa_proc_filtro', 'estatus_contr_filtro', 
                                  'fecha_inicio_filtro', 'fecha_final_filtro', 
                                  'fecha_trimestre1_filtro', 'fecha_trimestre2_filtro',
                                  'fecha_trimestre3_filtro', 'fecha_trimestre4_filtro');        

        $busqueda_termino = $request->input('tb');
        $userId = auth()->user()?->id;

        $oportunidades = $oportunidadesRepo->buscarOportunidadesNegocio($busqueda_termino, $userId, $filtros);   

        return $oportunidades;
    }

    private function obtieneFiltrosOpciones(OportunidadNegocioRepository $oportunidadesRepo): array
    {
        $filtros_opciones['capitulos'] = $oportunidadesRepo->obtieneRubros();
        $filtros_opciones['unidades_compradoras'] = $oportunidadesRepo->obtieneInstitucionesCompradoras();
        $filtros_opciones['tipos_contratacion'] = $oportunidadesRepo->obtieneTiposContratacion();
        $filtros_opciones['metodos_contratacion'] = $oportunidadesRepo->obtieneMetodosContratacion();
        $filtros_opciones['etapas_procedimiento'] = $oportunidadesRepo->obtieneEtapasProcedimiento();
        $filtros_opciones['estatus_contratacion'] = $oportunidadesRepo->obtieneEstatusContratacion();

        return $filtros_opciones;
    }

    private function convierteQueryParams(Request $request): void
    {
        if ($request->has('ca')) {
            $this->convierteFiltro($request, 'ca', 'capitulo_filtro');
        }
        if ($request->has('uc')) {
            $this->convierteFiltro($request, 'uc', 'unidad_compradora_filtro');
        }
        if ($request->has('tc')) {
            $this->convierteFiltro($request, 'tc', 'tipo_contr_filtro');
        }
        if ($request->has('mc')) {
            $this->convierteFiltro($request, 'mc', 'metodo_contr_filtro');
        }
        if ($request->has('ep')) {
            $this->convierteFiltro($request, 'ep', 'etapa_proc_filtro');
        }
        if ($request->has('ec')) {
            $this->convierteFiltro($request, 'ec', 'estatus_contr_filtro');
        }
        if ($request->has('tr')) {
            $request->merge([
                "fecha_trimestre{$request->get('tr')}_filtro" => true,
            ]);
        }
        if ($request->has('fi')) {
            $request->merge([
                'fecha_inicio_filtro' => $request->get('fecha_inicio_filtro'),
            ]);
        }
        if ($request->has('ff')) {
            $request->merge([
                'fecha_final_filtro' => $request->get('fecha_final_filtro'),
            ]);
        }
    }

    /**
     * Convierte un parámetro filtro a array si es de tipo string.
     */
    private function convierteFiltro(Request $request, string $key, string $newKey): void
    {
        if ($request->has($key) && !is_array($request->input($key))) {
            $request->merge([
                $newKey => explode(',', $request->input($key))
            ]);
        }
    }
}
