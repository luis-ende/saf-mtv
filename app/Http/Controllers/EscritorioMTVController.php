<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\CalendarioComprasRepository;
use App\Repositories\ObjetivoTareaRepository;
use App\Repositories\OportunidadesNotificacionesRepository;
use App\Repositories\OportunidadNegocioRepository;
use App\Repositories\ProductoRepository;
use App\Services\ObjetivosTareasService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EscritorioMTVController extends Controller
{
    public function show(Request $request)
    {
        if ($request->user()->hasRole('proveedor')) {
            Carbon::setlocale(config('app.locale'));
            $ultimo_login = Carbon::parse($request->user()->last_login)
                                        ->translatedFormat('l, d F Y');
            $objetivosTareasRepo = new ObjetivoTareaRepository();

            $estadisticas = $this->obtieneEscritorioProveedorEstadisticas($request->user());
            $objetivos = $objetivosTareasRepo->obtieneObjetivos($estadisticas);

            // Obtener tarea aleatoria para el banner del escritorio.
            $objetivo_tarea = ObjetivosTareasService::obtieneObjetivoTarea($objetivos, $objetivosTareasRepo);

            return view('escritorio.show', compact(
                'objetivos', 'objetivo_tarea', 'estadisticas', 'ultimo_login'));
        }

        return view('escritorio.show');
    }

    protected function obtieneEscritorioProveedorEstadisticas(User $user): array
    {
        $proveedor = $user->persona;
        $productoRepo = new ProductoRepository();
        $opnRepo = new OportunidadNegocioRepository();
        $calendarioRepo = new CalendarioComprasRepository();

        return [
            'num_instituciones_compradoras' =>
                $opnRepo->obtieneNumInstitutcionesCompradoras(),
            'num_procedimientos_programados' =>
                number_format($calendarioRepo->obtieneNumTotalProcedimientos(), 0),
            'num_productos_proveedor' =>
                $productoRepo->obtieneNumProductosPorProveedor($proveedor->id),
            'oportunidades_buscadas_guardadas' => false,
            'num_oportunidades_favoritas' =>
                OportunidadesNotificacionesRepository::obtieneNumBookmarks($user)
        ];
    }
}
