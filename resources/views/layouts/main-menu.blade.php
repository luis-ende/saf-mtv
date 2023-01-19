<div class="hidden sm:flex sm:items-center sm:ml-6">                    
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="mr-7 flex items-center text-sm font-medium text-mtv-primary hover:text-mtv-primary hover:border-gray-300 focus:outline-none focus:text-mtv-primary focus:border-gray-300 transition duration-150 ease-in-out">
                <div>
                    @svg('fluentui-chat-help-24-o', ['class' => 'h-7 w-7 inline-block ml-1'])
                </div>
                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link href="#">
                {{ __('Tianguis Digital') }}
            </x-dropdown-link>
            <x-dropdown-link href="#">
                {{ __('Preguntas frecuentes') }}
            </x-dropdown-link>
            <x-dropdown-link href="#">
                {{ __('Directorio') }}
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>

    @role('proveedor')
    <a class="text-mtv-primary mr-7">
        @svg('codicon-bell-dot', ['class' => 'h-7 w-7 inline-block'])
    </a>
    @endrole

    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex items-center text-sm text-mtv-primary font-bold hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
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
            <x-dropdown-link :href="route('perfil-negocio')">
                {{ __('Mi perfil') }}
            </x-dropdown-link>                        
            <x-dropdown-link :href="route('usuario-configuracion.show')">
                {{ __('Configuración') }}
            </x-dropdown-link>            
            <x-dropdown-link :href="route('centro-notificaciones')">
                {{ __('Notificaciones') }}
            </x-dropdown-link>
            @endrole
            @role('urg')
            <x-dropdown-link :href="route('urg-productos-favoritos.index')">
                {{ __('Favoritos') }}
            </x-dropdown-link>
            @endrole
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Cerrar sesión') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>                    
</div>