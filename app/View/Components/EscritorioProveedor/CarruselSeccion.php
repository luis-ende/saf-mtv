<?php

namespace App\View\Components\EscritorioProveedor;

use Illuminate\View\Component;

class CarruselSeccion extends Component
{
    public array $slides;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->slides = [
            [
                'id' => 1,
                'text' => 'Conoce <span class="block font-bold text-center">Contratos Marco</span>',
                'image' => '',
                'url' => '',
            ],
            [
                'id' => 2,
                'text' => 'Conoce <span class="block font-bold text-center">Contratos Marco</span>',
                'image' => '',
                'url' => '',
            ],
            [
                'id' => 3,
                'text' => 'Conoce <span class="block font-bold text-center">Contratos Marco</span>',
                'image' => '',
                'url' => '',
            ],
            [
                'id' => 4,
                'text' => 'Conoce <span class="block font-bold text-center">Contratos Marco</span>',
                'image' => '',
                'url' => '',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.escritorio-proveedor.carrusel-seccion');
    }
}
