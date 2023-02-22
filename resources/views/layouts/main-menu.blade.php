<nav x-data="{ open: false }" class="bg-white border-b-4 border-mtv-gold-light text-mtv-gold-light">
    <!-- Menú principal -->
    <div class="px-3">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="hidden space-x-6 sm:-my-px sm:flex">
                    @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Inicio
                    </x-nav-link>
                    @else
                    <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                        Inicio
                    </x-nav-link>
                    @endauth
                    @role('proveedor')
                    <x-nav-link :href="route('catalogo-productos')" :active="request()->routeIs('catalogo-productos')">
                        Mi tiendita virtual
                    </x-nav-link>
                    @endrole
                    <x-nav-link :href="'#'">
                        ¿Qué es Mi Tiendita Virtual?
                    </x-nav-link>
                    <x-menus.mtv-catalogo-menu-item />
                    <x-nav-link href="#">
                        Calendario de compras
                    </x-nav-link>
                    <x-nav-link :href="route('oportunidades-negocio.search')"
                        :active="request()->routeIs('oportunidades-negocio.search')">
                        Oportunidades de negocio
                    </x-nav-link>
                    <x-nav-link :href="'#'">
                        Directorio CDMX
                    </x-nav-link>
                    <x-nav-link :href="'#'">
                        Preguntas frecuentes
                    </x-nav-link>
                    <x-nav-link :href="'#'">
                        Padrón de Proveedores
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>