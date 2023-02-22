<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SolicitarInfoButton extends Component
{    
    public array $usuarioURG = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {        
        if ($this->esUsuarioURG()) {
            $this->usuarioURG['nombre'] = request()->user()->urg->nombre;
            $this->usuarioURG['email'] = "example@example.com";
        }
    }    

    public function esUsuarioURG(): bool 
    {
        if (request()->user()) {
            return request()->user()->hasRole('urg');
        }        

        return false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.solicitar-info-button');
    }
}