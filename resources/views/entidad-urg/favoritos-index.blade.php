<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="px-6 bg-white border-b border-gray-200 flex flex-row items-baseline">
                <div class="basis-1/2">
                    <x-page-header-label title="Favoritos" />
                </div>
                <div class="md:basis-1/2 xs:basis-8/12 text-end">
                    <a href="{{ route('urg-productos-favoritos.export') }}"
                        class="mtv-button-secondary no-underline md:text-base xs:text-sm">
                        @svg('go-download-16', ['class' => 'w-5 h-5 inline-block mr-1 md:inline xs:hidden'])
                        Descargar favoritos
                    </a>                
                </div>
            </div>            
            <div class="py-6 px-12">
                <x-productos.productos-grid
                    modo="visitante"
                    :productos="$productos"
                />
            </div>
        </div>
    </div>
</x-app-layout>
