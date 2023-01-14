<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden md:h-screen xs:h-fit">
            <div class="px-6 bg-white border-b border-gray-200 flex flex-row items-baseline">
                <div class="basis-1/2">
                    <x-page-header-label title="Producto">
                        <a class="mtv-link-breadcrumbs-gray" href="{{ route('homepage') }}">Inicio ></a>
                        {{-- TODO Enlace al catálogo del proveedor --}}
                        {{-- <a class="mtv-link-breadcrumbs-gray" href="{{ route('catalogo-productos') }}">Catálogo ></a> --}}
                        <a class="mtv-link-breadcrumbs-gray" href="#">{{ $producto->nombre }}</a>
                    </x-page-header-label>
                </div>
                <div class="basis-1/2 text-end">
                    <a href="{{ route('proveedor-catalogo-productos.show', [$producto->id_cat_productos]) }}"
                        class="mtv-button-secondary-white mr-3 md:text-base xs:text-xs no-underline py-2">
                        @svg('icono_catalogo', ['class' => 'w-7 h-7 inline-block mr-3'])
                        Catálogo
                    </a>
                    <a href="{{ route('busqueda-productos.index') }}"
                        class="mtv-button-secondary cursor-pointer no-underline md:text-base xs:text-sm">
                        @svg('jam-search-plus', ['class' => 'w-5 h-5 inline-block mr-3'])
                        Nueva búsqueda
                    </a>
                </div>
            </div>
            <div class="py-6 px-12">
                <x-producto-info-page
                    modo="guest"
                    :producto="$producto" />
            </div>
        </div>
    </div>
</x-app-layout>
