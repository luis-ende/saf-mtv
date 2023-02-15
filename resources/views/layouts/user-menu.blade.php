<div class="hidden sm:flex sm:items-center sm:ml-6">                        
    @role('proveedor')    
    <a href="{{ route('centro-notificaciones.index', [1]) }}" class="text-mtv-primary mr-9" title="Notificaciones">
        @svg('codicon-bell-dot', ['class' => 'h-6 w-6 inline-block'])
    </a>
    <a href="{{ route('centro-notificaciones.index', [2]) }}" class="text-mtv-primary mr-7" title="Favoritos">
        @svg('bi-bookmark-heart', ['class' => 'h-6 w-6 inline-block'])
    </a>
    @endrole

    <x-dropdown align="right" width="36">
        <x-slot name="trigger">
            <button class="flex items-center text-sm text-mtv-primary font-bold hover:text-mtv-gold hover:border-gray-300 focus:outline-none focus:text-mtv-gold focus:border-gray-300 transition duration-150 ease-in-out">
                <div>
                    @svg('lineawesome-user-check-solid', ['class' => 'h-7 w-7 inline-block ml-1'])
                    Hola, {{ Auth::user()->nombreUsuario()}}
                </div>
                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
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
                <x-dropdown-link :href="route('centro-notificaciones.index', [1])">
                    Notificaciones
                </x-dropdown-link>
                <x-dropdown-link :href="route('centro-notificaciones.index', [2])">
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
</div>