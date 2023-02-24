<?php

namespace App\View\Components\CalendarioCompras;

use Illuminate\View\Component;

class DetalleDataTable extends Component
{
    public array $detalles;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $detalles)
    {
        $this->detalles = $detalles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.calendario-compras.detalle-data-table');
    }
}