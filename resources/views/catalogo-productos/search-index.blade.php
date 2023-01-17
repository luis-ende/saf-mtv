<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen" x-data="{ terminoBusqueda: '', tipoBusqueda: '{{ $tipo_busqueda }}' }">
            <div class="py-6 px-12 bg-white border-b border-gray-200 flex flex-col">
                <div class="self-center">
                    <label class="text-mtv-gray-2 text-xl"
                           x-text="tipoBusqueda === 'productos' ? 'Catálogo de productos' : 'Catálogo de proveedores'">
                    </label>
                    <div class="text-mtv-primary font-bold text-3xl">
                        Buscador de productos y proveedores de Mi Tiendita Virtual
                    </div>
                </div>
                <div class="self-center">
                    <div class="flex flex-row space-x-4 mt-2">
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                        <span class="w-1 h-1 inline-block bg-mtv-gold-light"></span>
                    </div>
                </div>
            </div>
            <div class="py-6 px-12">
                <div x-data="{ tab: 'productos' }" x-modelable="tab" x-model="tipoBusqueda">
                    <nav class="font-bold text-lg text-mtv-gold flex flex-row mb-3">
                        <a class="no-underline border-b-4 basis-1/2 text-center"
                           :class="tab === 'productos' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                           x-on:click.prevent="tab = 'productos'"
                           href="#">
                            Más de {{ $num_productos_registrados }} productos registrados
                        </a>
                        <a class="no-underline border-b-4 basis-1/2 text-center"
                           :class="tab === 'proveedores' ? 'text-mtv-secondary border-mtv-secondary hover:text-mtv-secondary' : 'text-mtv-gold border-mtv-gold-light hover:text-mtv-gold'"
                            x-on:click.prevent="tab = 'proveedores'"
                            href="#">
                            Más de {{ $num_proveedores_registrados }} proveedores registrados
                        </a>
                    </nav>
                    <div class="flex flex-col" x-show="tab === 'productos'">
                        <div class="w-3/4 self-center">
                            <form method="POST"
                                  x-bind:action="'/buscador-mtv/' + $data.tipoBusqueda + '/' + $data.terminoBusqueda">
                                @csrf

                                <label for="productos_search" class="text-mtv-gray-2 text-base mb-2">
                                    Tu búsqueda es por productos:
                                </label>
                                <div class="flex md:flex-row md:space-x-3 md:space-y-0 xs:flex-col xs:space-y-3">
                                    <div class="md:basis-10/12 xs:basis-full relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            @svg('forkawesome-search', ['class' => 'w-5 h-5 text-mtv-gray-2'])
                                        </div>
                                        <input type="search"
                                            id="productos_search" name="productos_search"
                                            class="block w-full pt-3 pb-3 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                                            placeholder="Buscar por palabras clave..."
                                            autofocus
                                            x-model="terminoBusqueda"
                                            value="{{ $term_busqueda ?? '' }}">
                                        <input id="tipo_busqueda" name="tipo_busqueda" type="hidden" x-model="tipoBusqueda">
                                        <button type="submit"
                                                class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1"
                                                x-bind:disabled="!terminoBusqueda">
                                            Buscar
                                        </button>
                                    </div>
                                    <a href="http://rmsg.df.gob.mx/rmsg/pagina/dai/cabms/CABMSDF5.pdf" 
                                       target="_blank"
                                       class="md:basis-2/12 xs:basis-full mtv-link-gold flex flex-row items-center">
                                        <span class="text-xs">Consulta el catálogo de claves CABMS</span>
                                        @svg('tabler-report-search', ['class' => 'w-10 h-10'])
                                    </a>
                                </div>    
                                <x-busqueda.productos-filtros-bar>
                                    <button type="button" class="mtv-button-secondary-white my-0">Mis favoritos</button>
                                </x-busqueda.productos-filtros-bar>
                            </form>                            
                            @if($tipo_busqueda === 'productos')
                                @isset($num_resultados)
                                    @if($num_resultados === 0 && !empty($term_busqueda))
                                        <div class="p-0 mt-2 text-slate-700">
                                            No se encontraron productos con el término <span class="font-bold">"{{ $term_busqueda }}"</span>.
                                        </div>
                                    @endif
                                    @if($num_resultados > 0 && !empty($term_busqueda))
                                        <div class="p-0 mt-2 mb-5 text-slate-700">
                                            <span class="font-bold">{{ $num_resultados }}</span> Productos encontrados con el término <span class="font-bold">"{{ $term_busqueda }}</span>
                                        </div>
                                    @endif
                                @endisset
                            @endif
                        </div>

                        @if($tipo_busqueda === 'productos')
                            @isset($resultados)
                                <div class="w-full">
                                    <x-productos.productos-grid
                                        modo="busqueda"
                                        :productos="$resultados" />
                                </div>
                            @endisset
                        @endif
                    </div>
                    <div class="flex flex-col" x-show="tab === 'proveedores'">
                        <div class="w-3/4 self-center">
                            <form method="POST"
                                  x-bind:action="'/buscador-mtv/' + $data.tipoBusqueda + '/' + $data.terminoBusqueda">
                                @csrf

                                <label for="productos_search" class="text-mtv-gray-2 text-base mb-2">
                                    Tu búsqueda es por proveedores:
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        @svg('forkawesome-search', ['class' => 'w-5 h-5 text-mtv-gray-2'])
                                    </div>
                                    <input type="search"
                                           id="proveedores_search" name="proveedores_search"
                                           class="block w-full pt-3 pb-3 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                                           placeholder="Buscar por palabras clave..."
                                           autofocus
                                           x-model="terminoBusqueda"
                                           value="{{ $term_busqueda ?? '' }}">
                                    <input id="tipo_busqueda" name="tipo_busqueda" type="hidden" x-model="tipoBusqueda">
                                    <button type="submit"
                                            class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1"
                                            x-bind:disabled="!terminoBusqueda">
                                        Buscar
                                    </button>
                                </div>
                            </form>
                            @if($tipo_busqueda === 'proveedores')
                                @isset($num_resultados)
                                    @if($num_resultados === 0 && !empty($term_busqueda))
                                        <div class="p-0 mt-2 text-slate-700">
                                            No se encontraron proveedores con el término <span class="font-bold">"{{ $term_busqueda }}"</span>.
                                        </div>
                                    @endif
                                    @if($num_resultados > 0 && !empty($term_busqueda))
                                        <div class="p-0 mt-2 mb-5 text-slate-700">
                                            <span class="font-bold">{{ $num_resultados }}</span> Proveedores encontrados con el término <span class="font-bold">"{{ $term_busqueda }}</span>
                                        </div>
                                    @endif
                                @endisset
                            @endif
                        </div>

                        @if($tipo_busqueda === 'proveedores')
                            @isset($resultados)
                                <div class="w-full">
                                    <x-proveedores.proveedor-grid
                                        :proveedores="$resultados" />
                                </div>
                            @endisset
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
