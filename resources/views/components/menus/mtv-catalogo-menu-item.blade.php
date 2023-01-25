<div class="inline-flex items-center px-1 pt-1 text-base font-base leading-5 text-mtv-gold hover:text-mtv-primary hover:border-gray-300 focus:outline-none focus:text-mtv-primary focus:border-gray-300 transition duration-150 ease-in-out no-underline">
    <x-dropdown align="left" width="56">
        <x-slot name="trigger">
            <button class="flex items-center transition duration-150 ease-in-out">
                Catálogo
                <span class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
            </button>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link
                    :href="route('buscador-mtv.index', ['tipo' => 'productos'])"
                    :active="request()->is('buscador-mtv', 'buscador-mtv/productos', 'buscador-mtv/productos/*')">
                Catálogo de productos
            </x-dropdown-link>
            <x-dropdown-link
                    :href="route('buscador-mtv.index', ['tipo' => 'proveedores'])"
                    :active="request()->is('buscador-mtv/proveedores', 'buscador-mtv/proveedores/*')">
                Directorio de proveedores
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>
</div>