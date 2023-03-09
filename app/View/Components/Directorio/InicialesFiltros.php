<?php

namespace App\View\Components\Directorio;

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
    public function __construct(array $funcionarios)
    {
        $this->letrasIniciales = $this->generaLetrasIniciales($funcionarios);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.directorio.iniciales-filtros');
    }
}
