<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden h-fit">
            <div class="px-6 bg-white border-b border-gray-200 flex flex-row items-baseline">
                <div class="basis-1/2">
                    <x-page-header-label title="Catálogo">
                        @isset($proveedor)
                            <div class="uppercase">
                                <a href=""
                                   class="mtv-link-gold md:text-lg sm:text-sm xs:text-xs">
                                    {{ $proveedor->nombre_negocio }}
                                </a>
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                {{ $proveedor->persona->nombre_o_razon_social() }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                Sector: {{ $proveedor->sector }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                Giro: {{ $proveedor->categoria_scian }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                México, {{ $proveedor->persona->direccion()->ciudad }}
                            </div>
                        @endisset
                    </x-page-header-label>
                </div>
                <div class="md:basis-1/2 xs:basis-8/12 text-end">
                    @role('proveedor')
                        <a href="{{ route('catalogo-registro-inicio') }}"
                            class="mtv-button-secondary no-underline md:text-base xs:text-sm">
                            @svg('polaris-major-add-product', ['class' => 'w-5 h-5 inline-block mr-3 md:inline xs:hidden'])
                            Agregar producto
                        </a>
                    @endrole
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
                    @php($modo = isset($proveedor) ? 'visitante' : 'proveedor')
                    <div x-show="tab === 'bienes'">
                        <x-productos-grid
                            :modo="$modo"
                            :productos="$productos_bien"
                        />
                    </div>
                    <div x-show="tab === 'servicios'">
                        <x-productos-grid
                            modo="$modo"
                            :productos="$productos_servicio"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
