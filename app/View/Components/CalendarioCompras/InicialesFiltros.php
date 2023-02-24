<?php

namespace App\View\Components\CalendarioCompras;

use Illuminate\View\Component;

class InicialesFiltros extends Component
{
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

    private function generaLetrasIniciales(array $compras): array
    {
        $letrasIniciales = [];
        foreach ($compras as $compra) {
            $letraInicial = strtoupper(mb_substr($compra->unidad_compradora, 0, 1));
            $letraInicial = str_replace(
                array('Á', 'É', 'Í', 'Ó', 'Ú'),
                array('A', 'E', 'I', 'O', 'U'),
                $letraInicial
            );
            $letrasIniciales[] = $letraInicial;
        }

        return array_unique($letrasIniciales);
    }
}
