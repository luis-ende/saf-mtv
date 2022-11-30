<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('homepage') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="flex items-center text-base font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out mt-4">
                                <div>
                                    Padrón de Proveedores
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="https://tianguisdigital.finanzas.cdmx.gob.mx/login" target="_blank">
                                {{ __('Inicia sesión') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="https://tianguisdigital.finanzas.cdmx.gob.mx/requisitos" target="_blank">
                                {{ __('Regístrate') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    <x-nav-link :href="route('oportunidades-negocio')" :active="request()->routeIs('oportunidades-negocio')">
                        {{ __('Oportunidades') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 flex flex-row">
                <a class="font-bold no-underline mr-5" href="{{ route('wizard.registro-mtv.create') }}">Regístrate</a>
                <a class="font-bold no-underline mr-5" href="{{ route('login') }}">Ingresa</a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                @svg('eos-live-help-o', ['class' => 'h-7 w-7 inline-block text-[#BC955C] ml-1'])
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link href="https://www.tianguisdigital.cdmx.gob.mx/" target="_blank">
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
            <x-responsive-nav-link :href="route('login')">
                {{ __('Ingresa') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('oportunidades-negocio')">
                {{ __('Oportunidades') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="https://tianguisdigital.finanzas.cdmx.gob.mx/login">
                {{ __('Inicia sesión en Padrón de Proveedores') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="https://tianguisdigital.finanzas.cdmx.gob.mx/requisitos">
                {{ __('Regístrate en Padrón de Proveedores') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
