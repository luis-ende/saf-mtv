<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            Inicio
        </x-responsive-nav-link>
        @role('proveedor')
            <x-responsive-nav-link :href="route('catalogo-productos')" :active="request()->routeIs('catalogo-productos')">
                Tienditas virtuales
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                Calendario de compras
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('oportunidades-negocio')" :active="request()->routeIs('oportunidades-negocio')">
                Buscador de Oportunidades
            </x-responsive-nav-link>
        @else
            <x-responsive-nav-link href="'#'">
                ¿Qué es Mi Tiendita Virtual?
            </x-responsive-nav-link>
            <x-responsive-nav-link href="'#'">
                Preguntas frecuentes
            </x-responsive-nav-link>
        @endrole
        <x-responsive-nav-link href="#">
            Directorio CDMX
        </x-responsive-nav-link>
        <x-responsive-nav-link href="#">
            Padrón de Proveedores
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('buscador-mtv.index')">
            Catálogo
        </x-responsive-nav-link>
        <div class="pl-5">
            <x-responsive-nav-link
                :href="route('buscador-mtv.index', ['tipo' => 'productos'])"
                :active="request()->is('buscador-mtv', 'buscador-mtv/productos', 'buscador-mtv/productos/*')">
                Catálogo de productos
            </x-responsive-nav-link>
            <x-responsive-nav-link
                :href="route('buscador-mtv.index', ['tipo' => 'proveedores'])"
                :active="request()->is('buscador-mtv/proveedores', 'buscador-mtv/proveedores/*')">
                Directorio de proveedores
            </x-responsive-nav-link>
        </div>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pb-1 border-t border-gray-200">
        <div class="space-y-1">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                                       onclick="event.preventDefault();
                                            this.closest('form').submit();">
                    Cerrar sesión
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</div>