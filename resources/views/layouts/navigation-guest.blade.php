<div>
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4  sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('homepage') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    </div>

                    <!-- Navigation Links -->

                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6 flex flex-row">
                    @auth
                        @include('layouts/main-menu')
                    @endauth

                    @guest
                        <a class="font-bold text-base tracking-wide no-underline mr-10" href="{{ route('login') }}">Ingresa</a>
                        <a class="font-bold text-base tracking-wide no-underline bg-mtv-primary text-white  hover:text-mtv-gold rounded p-1 px-2" href="{{ route('registro-inicio') }}">Regístrate</a>
                    @endguest                    
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @if (Auth::user())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Inicia Sesión') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('registro-inicio')">
                        {{ __('Regístrate') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link >
                        {{ __('Preguntas frecuentes') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link >
                        {{ __('Directorio CDMX') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link>
                        {{ __('Ya soy proveedor') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        </div>
    </nav>

    <nav x-data="{ open: false }" class="bg-white border-b-4 border-mtv-gold-light text-mtv-gold-light top-10">
        <!-- Menú principal -->
        <div class="px-3">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                            Inicio
                        </x-nav-link>
                        <x-nav-link :href="'#'">
                            Qué es Mi Tiendita Virtual
                        </x-nav-link>
                        <x-nav-link :href="'#'">
                            Preguntas frecuentes
                        </x-nav-link>
                        <x-nav-link :href="'#'">
                            Directorio CDMX
                        </x-nav-link>
                        <x-nav-link :href="'#'">
                            Ya soy proveedor
                        </x-nav-link>
                        <div class="inline-flex items-center px-1 pt-1 text-base font-base leading-5 text-mtv-gold hover:text-mtv-primary hover:border-gray-300 focus:outline-none focus:text-mtv-primary focus:border-gray-300 transition duration-150 ease-in-out no-underline">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center transition duration-150 ease-in-out">                                            
                                        Catálogo                                            
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('buscador-mtv.index', ['tipo' => 'productos']) }}">
                                        {{ __('Catálogo de productos') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('buscador-mtv.index', ['tipo' => 'proveedores']) }}">
                                        {{ __('Directorio de proveedores') }}
                                    </x-dropdown-link>                        
                                </x-slot>
                            </x-dropdown>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
