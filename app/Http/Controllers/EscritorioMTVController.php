<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsuarioMensajeTipo;
use App\Repositories\CalendarioComprasRepository;
use App\Repositories\ObjetivoTareaRepository;
use App\Repositories\OportunidadesNotificacionesRepository;
use App\Repositories\OportunidadNegocioRepository;
use App\Repositories\PersonaRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\UsuariosMensajesRepository;
use App\Services\ObjetivosTareasService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class EscritorioMTVController extends Controller
{
    private UsuariosMensajesRepository $mensajesRepo;
    private OportunidadNegocioRepository $opnRepo;

    public function __construct()
    {
        $this->mensajesRepo = new UsuariosMensajesRepository();
        $this->opnRepo = new OportunidadNegocioRepository();
    }

    public function show(Request $request)
    {
        if ($request->user()->hasRole('proveedor')) {
            Carbon::setlocale(config('app.locale'));
            $ultimo_login = Carbon::parse($request->user()->last_login)
                                        ->translatedFormat('l, d F Y');
            $objetivosTareasRepo = new ObjetivoTareaRepository();

            $estadisticas = $this->obtieneEscritorioProveedorEstadisticas($request->user());
            $objetivos = $objetivosTareasRepo->obtieneObjetivos($estadisticas);
            $mensajes = $this->obtieneMensajesProveedor($request->user()->id);

            // Obtener tarea aleatoria para el banner del escritorio.
            $objetivo_tarea = ObjetivosTareasService::obtieneObjetivoTarea($objetivos, $objetivosTareasRepo);

            return view('escritorio.show', compact(
                'objetivos', 'objetivo_tarea', 'estadisticas',
                         'ultimo_login', 'mensajes'));
        }

        return view('escritorio.show');
    }

    protected function obtieneEscritorioProveedorEstadisticas(User $user): array
    {
        $proveedor = $user->persona;
        $productoRepo = new ProductoRepository();
        $calendarioRepo = new CalendarioComprasRepository();
        $opnNotificacionesRepo = new OportunidadesNotificacionesRepository();

        return [
            'num_instituciones_compradoras' =>
                $this->opnRepo->obtieneNumInstitutcionesCompradoras(),
            'num_procedimientos_programados' =>
                number_format($calendarioRepo->obtieneNumTotalProcedimientos(), 0),
            'num_mensajes_cotizacion' =>
                $this->mensajesRepo->obtieneNumMensajesProveedor($user->id,
                                                                 UsuarioMensajeTipo::SolicitudCotizacion->value),
            'num_productos_proveedor' =>
                $productoRepo->obtieneNumProductosPorProveedor($proveedor->id),
            'num_productos_proveedor_favoritos' =>
                $productoRepo->obtieneProveedorNumProductosFavoritos($proveedor->id),
            'ha_usado_buscador_oportunidades' => !is_null($proveedor->ultima_busqueda_oportunidades),
            'num_oportunidades_sugeridas' =>
                $opnNotificacionesRepo->obtieneNumOportunidadesSugeridas($user),
            'num_oportunidades_favoritas' =>
                $opnNotificacionesRepo->obtieneNumBookmarks($user)
        ];
    }

    protected function obtieneMensajesProveedor(int $userId): Collection
    {
        return $this->mensajesRepo
                    ->obtieneMensajesProveedor($userId)
                    ->map(function($m) {
                        return [
                            ...$m,
                            'fecha' => Carbon::parse($m['updated_at'])
                                                ->translatedFormat('d F Y'),
                            'hora' => Carbon::parse($m['updated_at'])
                                                ->translatedFormat('h:i'),
                        ];
                    });
    }
}
