<x-app-layout>
    @section('page_title', 'Tienditas Virtuales')
    <div class="bg-white min-h-screen"
         x-data="{ tab: 'productos',
                   tabActive: 'text-white bg-mtv-secondary hover:text-mtv-secondary',
                   tabInactive: 'text-white bg-mtv-gold-light hover:text-white',
                   terminoBusqueda: '',
                   tipoBusqueda: '{{ $tipo_busqueda }}' }"
    >
        <div class="border-b border-gray-200 px-12"
             x-model="tipoBusqueda"
             x-modelable="tab">
            <div class="pt-6 max-w-7xl mx-auto bg-white flex flex-col">
                <div class="self-center">
                    <label class="text-mtv-gray-2 md:text-xl">
                        Tienditas virtuales
                    </label>
                    <div class="text-mtv-primary font-bold md:text-3xl xs:text-lg"
                         x-show="tipoBusqueda === 'productos'">
                         Catálogo de productos
                    </div>
                    <div class="text-mtv-primary font-bold md:text-3xl xs:text-lg"
                         x-show="tipoBusqueda === 'proveedores'">
                         Directorio de proveedores
                    </div>
                </div>
                <div class="self-center">
                    <x-global.puntos-block />
                </div>
                <div class="mt-3 text-lg text-mtv-text-gray text-center">
                    <span x-show="tipoBusqueda === 'productos'" class="font-bold text-sm md:text-xl text-mtv-secondary my-4 inline-block">
                        Encuentra productos y servicios registrados en Mi Tiendita Virtual
                    </span>
                    <span x-show="tipoBusqueda === 'proveedores'" class="font-bold text-sm md:text-xl text-mtv-secondary my-4 inline-block">
                        Encuentra proveedores registrados en Mi Tiendita Virtual
                    </span>
                    @php
                        $favoritos_ruta = (auth()->user()) && (auth()->user()->hasRole('urg')) ?
                                            route('urg-productos-favoritos.index') :
                                            route('urg-login') . '?url=/urg-productos/favoritos';
                    @endphp
                    <span x-show="tipoBusqueda === 'productos'" class="w-3/4 inline-block text-sm">
                        <a href="{{ route('urg-login') }}" class="underline font-bold mtv-link-gold">Inicia sesión</a> para agregar a Bienes/Servicios a tus"
                            <a href="{{ $favoritos_ruta }}"
                               class="underline font-bold mtv-link-gold">Favoritos</a>".
                        Aplica <strong>sólo para Instituciones compradoras.</strong>
                    </span>                    
                    <span x-show="tipoBusqueda === 'proveedores'" class="w-3/4 inline-block text-sm">
                        Utiliza los filtros para focalizar tu búsqueda.
                    </span>                    
                </div>
                <nav class="font-bold text-lg flex md:flex-row xs:flex-col md:space-x-7 md:space-y-0 xs:space-y-4 xs:space-x-0 md:px-16 mx-auto md:w-2/3 py-7">
                    @php($plural = $num_productos_registrados > 1)
                    <button class="no-underline rounded-3xl basis-1/2 text-center py-2 px-3 md:px-5"
                            :class="tab === 'productos' ? tabActive : tabInactive"
                            x-on:click.prevent="tab = 'productos'">
                           <span x-data="animatedCounter(@js($num_productos_registrados), 200)"
                                 x-init="updatecounter"
                                 x-text="Math.round(current)"></span> producto{{ $plural ? 's' : '' }} registrado{{ $plural ? 's' : '' }}
                    </button>
                    <button class="no-underline rounded-3xl basis-1/2 text-center py-2 px-3 md:px-5"
                            :class="tab === 'proveedores' ?  tabActive : tabInactive"
                            x-on:click.prevent="tab = 'proveedores'">
                            <span x-data="animatedCounter(@js($num_proveedores_registrados), 200)"
                                  x-init="updatecounter"
                                  x-text="Math.round(current)"></span> proveedor{{ $plural ? 'es' : '' }} registrado{{ $plural ? 's' : '' }}
                    </button>
                </nav>
            </div>
        </div>
        <div id="seccion-resultados" class="py-6 px-20 max-w-7xl mx-auto">
            <div class="flex flex-col" x-show="tab === 'productos'">
                <div class="w-full md:w-3/4 self-center">
                    <x-busqueda-productos.search-input
                            label="Búsqueda por nombre de productos/servicios o CABMS:"
                            id="productos_search"
                            name="productos_search">

                        <x-slot name="button_bar">
                            <x-busqueda-productos.enlaces-catalogos-pdf />
                        </x-slot>

                        <x-slot name="busqueda_filtros">
                            <x-busqueda-productos.productos-filtros-bar
                                    :filtros_opciones="$filtros_opciones" />
                        </x-slot>
                    </x-busqueda-productos.search-input>
                </div>

                @role('urg')
                <div class="self-end mt-10">
                    <a href="{{ route('urg-productos-favoritos.index') }}"
                       class="mtv-button-secondary-white no-underline py-2">
                        @svg('gmdi-favorite-r', ['class' => 'w-5 h-5 inline-block mr-3'])
                        Mis favoritos
                    </a>
                </div>
                @endrole

                @if(isset($resultados) && $tipo_busqueda === 'productos')
                    <x-busqueda-productos.resultados-view
                            :tipo_busqueda="$tipo_busqueda"
                            :resultados="$resultados" />
                @endif
            </div>

            <div class="flex flex-col" x-show="tab === 'proveedores'">
                <div class="w-full md:w-3/4 self-center">
                    <x-busqueda-productos.search-input
                            label="Búsqueda por nombre de proveedor:"
                            id="proveedores_search"
                            name="proveedores_search">

                        <x-slot name="busqueda_filtros">
                            <x-busqueda-productos.proveedores-filtros-bar
                                    :filtros_opciones="$filtros_opciones" />
                        </x-slot>
                    </x-busqueda-productos.search-input>
                </div>

                @if(isset($resultados) && $tipo_busqueda === 'proveedores')
                    <x-busqueda-productos.resultados-view
                            :tipo_busqueda="$tipo_busqueda"
                            :resultados="$resultados" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
