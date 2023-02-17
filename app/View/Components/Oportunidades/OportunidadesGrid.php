<?php

namespace App\View\Components\Oportunidades;

use Illuminate\View\Component;
use App\Repositories\OportunidadNegocioRepository;

class OportunidadesGrid extends Component
{
    public int $pagination_offset;
    /**
     * @var array<mixed>
     */
    public array $filtros;
    public string $buscador_items_route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pagination_offset = OportunidadNegocioRepository::BUSQUEDA_OPORTUNIDADES_PAGINATION_OFFSET;
        $this->filtros = request()->except('_token');
        $this->buscador_items_route = route('oportunidades.items-cards');
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.oportunidades.oportunidades-grid');
    }
}