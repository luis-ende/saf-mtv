<nav x-data="{ open: false }" class="hidden md:inline text-mtv-gold-light">
    <!-- Menú principal -->
    <div class="px-3">
        <div class="flex justify-between min-h-fit">
            <div class="flex py-2">
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
                    <x-nav-link :href="route('flujograma.show')"
                        :active="request()->routeIs('flujograma.show')">
                        ¿Qué es Mi Tiendita Virtual?
                    </x-nav-link>
                    <x-nav-link :href="route('calendario-compras.index')"
                        :active="request()->routeIs('calendario-compras.index')">
                        Calendario de compras
                    </x-nav-link>
                    <x-nav-link :href="route('oportunidades-negocio.search')"
                        :active="request()->routeIs('oportunidades-negocio.search')">
                        Oportunidades de negocio
                    </x-nav-link>
                    <x-nav-link :href="route('preguntas-frecuentes.show')"
                                :active="request()->routeIs('preguntas-frecuentes.show')">
                        Preguntas frecuentes
                    </x-nav-link>
                    <x-nav-link :href="route('directorio.index')"
                                :active="request()->routeIs('directorio.index')">
                        Directorio CDMX
                    </x-nav-link>
                    <x-nav-link href="https://tianguisdigital.finanzas.cdmx.gob.mx/" target="_blank">
                        Padrón de Proveedores
                    </x-nav-link>
                    <x-menus.mtv-catalogo-menu-item />
                </div>
            </div>
        </div>
    </div>
</nav>