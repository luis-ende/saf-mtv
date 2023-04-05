<?php

namespace App\View\Components\EscritorioProveedor;

use App\Models\Banners\MTVBannerTipo;
use App\Repositories\MTVBannersRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
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
               'nombre' => $banner->nombre,
               'ruta_imagen' => Storage::url($banner->ruta_imagen),
               'enlace' => $banner->enlace,
           ];
        });
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
