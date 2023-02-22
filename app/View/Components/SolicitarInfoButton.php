<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SolicitarInfoButton extends Component
{    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {        
    }    

    public function esUsuarioURG(): bool 
    {
        if (request()->user()) {
            return request()->user()->hasRole('urg');
        }        

        return false;
    }

    public function getUsuarioURGDatos() 
    {
        return [];
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