<?php

namespace App\View\Components\Menus;

use App\Repositories\OportunidadesNotificacionesRepository;
use Illuminate\View\Component;

class MenuBarraProveedor extends Component
{
    public bool $tieneOpnSugeridas = false;
    public bool $tieneOpnGuardadas = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = auth()->user();
        $opnNotificacionesRepo = new OportunidadesNotificacionesRepository();
        $this->tieneOpnSugeridas = $opnNotificacionesRepo->obtieneNumOportunidadesSugeridas($user) > 0;
        $this->tieneOpnGuardadas = $opnNotificacionesRepo->obtieneNumBookmarks($user) > 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menus.menu-barra-proveedor');
    }
}
