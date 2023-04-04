<?php

namespace App\View\Components\EscritorioProveedor;

use App\Models\Banners\MTVBannerTipo;
use App\Repositories\MTVBannersRepository;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CarruselSeccion extends Component
{
    public Collection $slides;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(MTVBannersRepository $bannersRepo)
    {
        $banners = $bannersRepo->obtieneBanners(MTVBannerTipo::EscritorioProveedor->value);
        $this->slides = $banners->map(function($banner) {
           return [
               'id' => $banner->id,
               'ruta_imagen' => $banner->ruta_imagen,
               'enlace' => $banner->enlace,
           ];
        });

        /*$this->slides = [
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
        ];*/
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
