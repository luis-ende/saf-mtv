<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden h-fit">
            <div class="py-6 px-12 bg-white border-b border-gray-200 flex flex-row items-baseline">
                <div class="uppercase text-mtv-primary font-bold p-2 md:basis-1/2 xs:basis-4/12 md:text-2xl xs:text-base">
                    Catálogo
                </div>
                <div class="md:basis-1/2 xs:basis-8/12 text-end">
                    <a href="{{ route('catalogo-registro-inicio') }}"
                        class="mtv-button-secondary md:text-base no-underline md:text-base xs:text-sm">
                        @svg('polaris-major-add-product', ['class' => 'w-5 h-5 inline-block mr-3 md:inline xs:hidden'])
                        Agregar producto
                    </a>
                </div>
            </div>
            @php($numProductosBien = count($productos_bien))
            @php($numProductosServicio = count($productos_servicio))
            <div class="py-6 px-12">
                <div x-data="{ tab: 'bienes' }">
                    <nav class="font-bold text-lg text-mtv-gold flex flex-row mb-5">
                        <a class="no-underline border-b-4 basis-1/2 text-center"
                           :class="tab === 'bienes' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                           x-on:click.prevent="tab = 'bienes'"
                           href="#">
                           {{ $numProductosBien }} Productos
                        </a>
                        <a class="no-underline border-b-4 basis-1/2 text-center"
                           :class="tab === 'servicios' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                           x-on:click.prevent="tab = 'servicios'"
                           href="#">
                           {{ $numProductosServicio }} Servicios
                        </a>
                    </nav>
                    <div x-show="tab === 'bienes'">
                        <x-productos-grid
                            :productos="$productos_bien"
                        />
                    </div>
                    <div x-show="tab === 'servicios'">
                        <x-productos-grid
                            :productos="$productos_servicio"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
