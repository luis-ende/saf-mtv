<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="px-6 bg-white border-b border-gray-200 flex flex-row items-baseline">
                <div class="basis-1/2">
                    <x-page-header-label title="Catálogo">
                        @isset($proveedor)
                            <div class="uppercase">
                                <a href="{{ route('proveedor-perfil.show', $proveedor->persona->id) }}"
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
                                Ubicación: {{ $proveedor->persona->direccion()->pais }}, {{ $proveedor->persona->direccion()->ciudad }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                Constancia: {{ $etapa_padron_prov }}
                            </div>
                        @endisset
                    </x-page-header-label>
                </div>
                <div class="md:basis-1/2 xs:basis-8/12 text-end">
                    @if(request()->routeIs('catalogo-productos'))
                        @role('proveedor')
                            <a href="{{ route('catalogo-registro-inicio') }}"
                                class="mtv-button-secondary no-underline md:text-base xs:text-sm">
                                @svg('polaris-major-add-product', ['class' => 'w-5 h-5 inline-block mr-3 md:inline xs:hidden'])
                                Agregar producto
                            </a>
                        @endrole
                    @endif
                </div>
            </div>
            @php($numProductosBien = count($productos_bien))
            @php($numProductosServicio = count($productos_servicio))
            <div class="py-6 px-12 mb-5">
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
                        <x-productos.productos-grid
                            :modo="$modo"
                            :productos="$productos_bien"
                        />
                    </div>
                    <div x-show="tab === 'servicios'">
                        <x-productos.productos-grid
                            :modo="$modo"
                            :productos="$productos_servicio"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
