<x-app-layout>        
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="px-6 bg-white border-b border-gray-200 flex flex-row items-baseline">
                <div class="basis-1/2">
                    <x-page-header-label title="Catálogo">
                        @isset($proveedor)
                            <div class="uppercase mt-2">
                                <a href="{{ route('proveedor-perfil.show', $proveedor->persona->id) }}"
                                   class="mtv-link-gold md:text-lg sm:text-sm xs:text-xs">
                                    {{ $proveedor->nombre_negocio }}
                                </a>
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                {{ $proveedor->persona->nombre_o_razon_social() }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                <span class="text-mtv-text-gray-light">Sector: </span>{{ $proveedor->sector }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                <span class="text-mtv-text-gray-light">Giro: </span>{{ $proveedor->categoria_scian }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                <span class="text-mtv-text-gray-light">Ubicación: </span> {{ $proveedor->persona->direccion()->pais }}, {{ $proveedor->persona->direccion()->ciudad }}
                            </div>
                            <div class="text-mtv-text-gray sm:text-sm xs:text-xs uppercase">
                                <span class="text-mtv-text-gray-light">Constancia: </span>{{ $etapa_padron_prov }}
                            </div>
                        @endisset
                    </x-page-header-label>
                </div>
                <div class="md:basis-1/2 xs:basis-8/12 flex flex-row space-x-4 justify-end">
                    @if(request()->routeIs('catalogo-productos'))                    
                        @role('proveedor')
                            <x-catalogo-productos.social-links 
                                :links="$compartir_enlaces"
                                button-style="mtv-button-secondary-white"
                            />

                            <a href="{{ route('catalogo-registro-inicio') }}"
                                class="mtv-button-secondary no-underline md:text-base xs:text-sm my-4">
                                @svg('polaris-major-add-product', ['class' => 'w-5 h-5 inline-block mr-3 md:inline xs:hidden'])
                                Agregar producto
                            </a>
                        @endrole
                    @else
                        <x-catalogo-productos.social-links
                            :links="$compartir_enlaces"
                            button_style="mtv-button-secondary"
                         />
                    @endif
                </div>
            </div>
            @php($numProductosBien = count($productos_bien))
            @php($numProductosServicio = count($productos_servicio))
            <div class="py-6 px-12 mb-5">
                <div x-data="{ 
                    tab: 'bienes',
                    tabActive: 'text-white bg-mtv-secondary hover:text-mtv-secondary', 
                    tabInactive: 'text-white bg-mtv-gold-light hover:text-white' }">
                    <nav class="font-bold text-lg flex md:flex-row xs:flex-col md:space-x-7 md:space-y-0 xs:space-y-4 xs:space-x-0 px-7 mx-auto mb-14 w-3/4">
                        <button class="no-underline rounded-3xl basis-1/2 text-center py-2 px-5"
                           :class="tab === 'bienes' ? tabActive : tabInactive"
                           x-on:click.prevent="tab = 'bienes'">
                           {{ $numProductosBien }} Productos
                        </button>
                        <button class="no-underline rounded-3xl basis-1/2 text-center py-2 px-5"
                           :class="tab === 'servicios' ?  tabActive : tabInactive"
                           x-on:click.prevent="tab = 'servicios'">
                           {{ $numProductosServicio }} Servicios
                        </button>
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
