<div class="flex flex-row items-center ml-6 pr-1">
    @auth
        @role('proveedor')
        <x-menus.menu-barra-proveedor />
        @endrole

        <x-dropdown align="right" width="36">
            <x-slot name="trigger">
                <button class="flex items-center text-sm text-mtv-primary font-bold hover:text-mtv-gold hover:border-gray-300 focus:outline-none focus:text-mtv-gold focus:border-gray-300 transition duration-150 ease-in-out">
                <span>
                    @svg('lineawesome-user-check-solid', ['class' => 'h-7 w-7 inline-block ml-1'])
                    <span class="hidden md:inline">Hola, {{ Auth::user()->nombreUsuario()}}</span>
                </span>
                    <span class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
                </button>
            </x-slot>

            <x-slot name="content">
                @role('proveedor')
                <x-dropdown-link
                        :href="route('perfil-negocio')"
                        :active="request()->routeIs('perfil-negocio')">
                    Mi perfil
                </x-dropdown-link>
                <x-dropdown-link
                        :href="route('catalogo-productos')"
                        :active="request()->routeIs('catalogo-productos')">
                    Mi tiendita virtual
                </x-dropdown-link>
                <div class="border-b"></div>
                <x-dropdown-link
                        :href="route('centro-notificaciones.index', [1])"
                        :active="request()->is('centro-notificaciones', 'centro-notificaciones/1')">
                    Notificaciones
                </x-dropdown-link>
                <x-dropdown-link
                        :href="route('centro-notificaciones.index', [2])"
                        :active="request()->is('centro-notificaciones', 'centro-notificaciones/2')">
                    Favoritos
                </x-dropdown-link>
                <div class="border-b"></div>
                <x-dropdown-link
                        :href="route('usuario-configuracion.show')"
                        :active="request()->routeIs('usuario-configuracion.show')">
                    Configuración
                </x-dropdown-link>
                @endrole
                @role('urg')
                <x-dropdown-link
                        :href="route('urg-productos-favoritos.index')"
                        :active="request()->routeIs('urg-productos-favoritos.index')">
                    Favoritos
                </x-dropdown-link>
                @endrole
                @role('admin')
                <x-dropdown-link
                        :href="route('mtv-admin.usuarios')"
                        :active="request()->routeIs('mtv-admin.usuarios')">
                    Usuarios y permisos
                </x-dropdown-link>
                @endrole
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        Cerrar sesión
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @else
        <a class="font-bold text-base tracking-wide no-underline mr-10" href="{{ route('login') }}">Ingresa</a>
        <a class="font-bold text-base tracking-wide no-underline bg-mtv-primary text-white  hover:text-mtv-gold rounded p-1 px-3 mr-3" href="{{ route('registro-inicio') }}">Regístrate</a>
    @endauth
</div>