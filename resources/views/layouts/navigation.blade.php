<div x-data="{ open: false }">
    <div class="bg-white border-b-2 border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="px-3">
            <div class="flex h-14 items-center justify-center md:justify-between">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('homepage') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    </div>
                </div>

                @if($show_menu_bar)
                    <div class="hidden md:inline">
                        <x-menus.user-menu />
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($show_main_menu)
        <nav class="flex flex-row bg-white border-b-4 border-mtv-gold-light">
            <div class="basis-1/2 md:basis-full">
                <!-- Hamburger -->
                <!-- Se muestra sólo en modo responsivo -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-3 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @include('layouts/main-menu')
            </div>
            <div class="basis-1/2 flex flex-row md:hidden pr-2">
                <x-menus.user-menu />
            </div>
        </nav>

        <!-- Se muestra sólo en modo responsivo -->
        @include('layouts/main-menu-responsive')
    @endif
</div>
