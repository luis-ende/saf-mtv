<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OportunidadRepository;

class OportunidadesController extends Controller
{
    public function index(Request $request, OportunidadRepository $oportunidadesRepo)
    {
        $oportunidades = $oportunidadesRepo->buscarOportunidadesNegocio();
        $estadisticas = $oportunidadesRepo->obtieneEstadisticas($oportunidades);
        $filtros_opciones = $this->obtieneFiltrosOpciones($oportunidadesRepo);

        return view('oportunidades.show', compact('filtros_opciones', 'oportunidades', 'estadisticas'));
    }

    public function search(Request $request, OportunidadRepository $oportunidadesRepo)
    {
        $oportunidades = $oportunidadesRepo->buscarOportunidadesNegocio();
        $estadisticas = $oportunidadesRepo->obtieneEstadisticas($oportunidades);
        $filtros_opciones = $this->obtieneFiltrosOpciones($oportunidadesRepo);

        return view('oportunidades.show', compact('filtros_opciones', 'oportunidades', 'estadisticas'));
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
