<?php

namespace App\View\Components\CalendarioCompras;

use App\View\Components\Traits\GeneradorInicialesTrait;
use Illuminate\View\Component;

class InicialesFiltros extends Component
{
    use GeneradorInicialesTrait;

    public array $letrasIniciales;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $compras)
    {
        $this->letrasIniciales = $this->generaLetrasIniciales($compras);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.calendario-compras.iniciales-filtros');
    }
}
