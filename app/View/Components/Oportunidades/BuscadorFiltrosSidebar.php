<?php

namespace App\View\Components\Oportunidades;

use Illuminate\View\Component;

class BuscadorFiltrosSidebar extends Component
{
    /**
     * @var array<mixed>
     */
    public array $filtrosActivos = [
        'ca' => [], // Capitulos
        'uc' => [], // Unidades compradoras
        'mc' => [], // Métodos de contratación
        'tc' => [], // Tipos de contratación
        'ep' => [], // Etapas de procedimiento
        'ec' => [], // Estatus de contratación
    ];

    public ?string $filtroFechaInicio = null;
    public ?string $filtroFechaFinal = null;
    public ?int $filtroTrimestre = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $qParams = request()->query();
        foreach ($this->filtrosActivos as $key => $filtro) {
            if (isset($qParams[$key])) {
                $this->filtrosActivos[$key] = explode(',', $qParams[$key]);
            }
        }

        if (isset($qParams['tr'])) {
            $this->filtroTrimestre = $qParams['tr'];
        } else {
            $this->filtroFechaInicio = $qParams['fi'] ?? null;
            $this->filtroFechaFinal = $qParams['ff'] ?? null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.oportunidades.buscador-filtros-sidebar');
    }
}