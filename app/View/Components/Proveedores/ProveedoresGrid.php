<?php

namespace App\View\Components\Proveedores;

use App\Repositories\PerfilNegocioRepository;
use Illuminate\View\Component;

class ProveedoresGrid extends Component
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
        $this->pagination_offset = PerfilNegocioRepository::BUSQUEDA_PROVEEDORES_PAGINATION_OFFSET;
        $this->filtros = request()->except('_token');
        $this->buscador_items_route = route('buscador-mtv.items-cards');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.proveedores.proveedores-grid');
    }
}
