<?php

namespace App\View\Components\Directorio;

use Illuminate\View\Component;

class DirectorioDataTable extends Component
{
    public array $funcionarios;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $funcionarios)
    {
        $this->funcionarios = $funcionarios;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.directorio.directorio-data-table');
    }
}