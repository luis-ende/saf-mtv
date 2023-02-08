<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="px-6 bg-white border-b border-gray-200 flex flex-row items-center">
                <div class="basis-1/3">
                    <x-page-header-label title="Producto">
                        <a href="{{ route('proveedor-catalogo-productos.show', [$producto->id_cat_productos]) }}"
                           class="mtv-link-breadcrumbs-gray">Catálogo productos ></a>                        
                        <a class="mtv-link-breadcrumbs-gray" href="#">{{ $producto->nombre }}</a>
                    </x-page-header-label>
                </div>
                <div class="basis-2/3 flex md:flex-row md:space-y-0 md:space-x-3 xs:flex-col xs:space-y-5 md:text-base xs:text-xs items-end justify-end">                    
                    <a href="{{ route('buscador-mtv.index') }}"
                       class="mtv-button-secondary-white">
                        @svg('jam-search-plus', ['class' => 'w-5 h-5 inline-block mr-2'])
                        Nueva búsqueda
                    </a>
                    <a href="{{ route('proveedor-catalogo-productos.show', [$producto->id_cat_productos]) }}"
                       class="mtv-button-gold">
                        @svg('icono_catalogo', ['class' => 'w-5 h-5 inline-block mr-2'])
                        Catálogo
                    </a>                                        
                    <a href="mailto:{{ $producto->proveedor_email }}" 
                       class="mtv-button-secondary">
                        @svg('ri-mail-send-line', ['class' => 'w-5 h-5 inline-block mr-2'])
                        Solicitar información
                    </a>                    
                </div>
            </div>
            <div class="py-6 px-12">
                <x-productos.producto-info-page
                    modo="guest"
                    :producto="$producto"
                    :productos_relacionados="$productos_relacionados"
                />
            </div>
        </div>
    </div>
</x-app-layout>
