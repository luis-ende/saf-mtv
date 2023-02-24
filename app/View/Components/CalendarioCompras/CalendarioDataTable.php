<?php

namespace App\View\Components\CalendarioCompras;

use Illuminate\View\Component;

class CalendarioDataTable extends Component
{
    public array $compras;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $compras)
    {
        $this->compras = $compras;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.calendario-compras.calendario-data-table');
    }
}