<?php

namespace App\View\Components\Productos;

use App\Repositories\ProductoRepository;
use Illuminate\View\Component;

class ProductosGrid extends Component
{
    public int $pagination_offset;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->pagination_offset = ProductoRepository::BUSQUEDA_PRODUCTOS_PAGINATION_OFFSET;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.productos.productos-grid');
    }
}
