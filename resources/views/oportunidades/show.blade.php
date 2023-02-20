<x-app-layout>      
    <div class="bg-white overflow-hidden min-h-screen"
         x-data="encabezadoEstadisticas()"
         x-init="initEncabezadoEstadisticas()">
        <div class="py-6 md:px-12 xs:px-6 bg-white border-b border-gray-200 flex flex-col">
            <div class="self-center">
                <label class="text-mtv-gray-2 md:text-xl">
                    Buscador de
                </label>
                <h1 class="text-mtv-primary font-bold md:text-3xl xs:text-lg">
                    Oportunidades para venderle a la CDMX
                </h1>
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
            <div class="my-4 text-lg text-mtv-text-gray flex flex-col items-center">
                <span class="font-bold md:text-xl xs:text-base text-mtv-secondary mb-4 block text-center">
                    Identifica qué productos y servicios compra la CDMX.
                </span>
                <span class="md:w-2/5 block text-base xs:text-sm text-center">
                    <a href="{{ route('registro-inicio') }}" class="underline font-bold mtv-link-gold">Regístrate en “Mi Tiendita Virtual”</a>
                    para guardar y seguir las oportunidades de negocio de tu interés. Sólo da clic en el icono del “Marcador” y en la sección “Notificaciones” los encontrarás.
                </span>
            </div>

            <div class="md:w-10/12 xs:w-full md:flex md:flex-row md:space-x-16 md:space-y-0 xs:grid xs:grid-cols-2 xs:grid-rows-2 xs:gap-x-5 xs:gap-y-2 my-4 self-center"
                 x-data=etapasFiltros()>
                <div class="md:basis-1/5 text-mtv-gray flex flex-column items-center py-2 md:inline-flex xs:hidden">
                    <span class="font-bold text-5xl" 
                          x-model="unidadesCConteo" 
                          x-text="unidadesCConteo"></span>
                    <span class="text-lg">Instituciones compradoras</span>
                </div>

                @foreach($estadisticas['conteo_etapas'] as $etapa)
                    <button 
                        :class="esFiltroEtapaActivo(@js($etapa['id'])) ? 'mtv-button-filtro-ep-active' : 'mtv-button-filtro-ep-inactive'"
                        @click="activaFiltro(@js($etapa['id']))">
                        <span class="font-bold text-5xl xs:text-1xl" x-model="etapasConteo[@js($etapa['id'])]" 
                                                                     x-text="etapasConteo[@js($etapa['id'])]"></span>
                        <span class="md:text-lg xs:text-sm">{{ $etapa['nombre_etapa']  }}</span>
                    </button>
                @endforeach

                @push('scripts')
                    <script type="text/javascript">
                        function etapasFiltros() {
                            return {                            
                                activaFiltro(etapaId) {
                                    const querystring = window.location.search; 
                                    const params = new URLSearchParams(querystring); 
                                    params.delete("ep");
                                    params.append("ep", etapaId); 
                                    window.location.href = `${window.location.pathname}?${params}` + '#seccion-principal';
                                },
                                esFiltroEtapaActivo(etapaId) {
                                    const querystring = window.location.search; 
                                    const params = new URLSearchParams(querystring);                                                                                                                             

                                    return params.has("ep") && params.get("ep") === etapaId.toString();
                                },
                                getEtapaConteo(etapaId) {
                                    return this.$data.etapasConteo.filter(e => e.id === etapaId)[0].conteo;
                                }
                            }
                        }
                    </script>
                @endpush
            </div>                
        </div>
        
        <div class="my-3 flex flex-col" x-data="{ terminoBusqueda: @js(request()->get('tb') ?? '') }">
            <div class="md:w-2/4 xs:w-3/4 self-center my-4">
                <form method="POST"
                      x-bind:action="'/oportunidades-de-negocio' + ($data.terminoBusqueda !== '' ? '?tb=' + $data.terminoBusqueda : '')">
                    @csrf

                    <label for="oportunidades_search" class="text-mtv-secondary text-sm mb-2">
                        Búsqueda por palabra clave:
                    </label>
                    <div class="flex md:flex-row md:space-x-5 md:space-y-0 xs:flex-col xs:space-y-3">
                        <div class="md:basis-10/12 xs:basis-full relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                @svg('forkawesome-search', ['class' => 'w-4 h-4 text-mtv-gray-2'])
                            </div>
                            <input type="search"
                                   id="oportunidades_search" name="oportunidades_search"
                                   class="block w-full pt-2 pb-2 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                                   autofocus
                                   x-model="terminoBusqueda">
                            <button type="submit"
                                    class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1 hidden">
                                Buscar
                            </button>
                        </div>

                        <div class="md:basis-2/12 xs:basis-full xs:self-center">
                            <x-busqueda.enlaces-catalogos-pdf />
                        </div>
                    </div>
                </form>
            </div>            
            <div id="seccion-principal" x-ref="seccionPrincipal" class="flex md:flex-row xs:flex-col m-4"
                {{-- TIP: Buscar inicialización de esta función reutilizable 'oportunidadesFiltrosURLParams()' en resources/js/app.js --}}
                 x-data="oportunidadesFiltrosURLParams">
                <div x-data="filtrosSideBar()"
                    @scroll.window="stickyFiltrosButton = $refs.seccionPrincipal.getBoundingClientRect().top <= 0">
                    <div class="basis-full md:basis-1/4 md:mr-7">
                        <div :class="{'flex flex-row justify-between': filtrosModalOpen, 'hidden': !filtrosModalOpen}"
                             class="fixed top-0 left-0 bg-white right-0 border-b-2 hidden h-12 px-3">
                            <span class="self-center text-mtv-primary font-bold text-lg uppercase">Filtros</span>
                            <button @click="filtrosModalOpen = ! filtrosModalOpen"
                                    aria-label="Cerrar"
                                    class="p-2 inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': ! filtrosModalOpen, 'inline-flex': filtrosModalOpen }"
                                          class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div :class="{'w-full h-full bg-white fixed border-indigo-700 top-12 left-0 right-0 z-40 overflow-y-auto px-2': filtrosModalOpen, 'hidden': !filtrosModalOpen}"
                             class="md:block">
                            <x-oportunidades.buscador-filtros-sidebar
                                    :filtros_opciones="$filtros_opciones"
                            />
                        </div>
                    </div>

                    <div x-show="!filtrosModalOpen"
                         :class="{ 'fixed bottom-0 left-0 border-t-2 z-40': stickyFiltrosButton, '': !stickyFiltrosButton }"
                         class="bg-white w-full md:hidden xs:block">
                        <button type="button"
                                class="w-64 mtv-button-secondary mx-auto text-center block"
                                @click="filtrosModalOpen = !filtrosModalOpen">
                            Filtros
                            <span class="rounded px-2 py-0 ml-3 bg-mtv-gold-light" x-text="countFiltros()"></span>
                        </button>
                    </div>
                </div>

                @push('scripts')        
                    <script type="text/javascript">
                        function filtrosSideBar() {
                            return {
                                filtrosSideBarOpen: false,
                                filtrosModalOpen: false,
                                stickyFiltrosButton: false,
                                setModalOpen() {
                                    this.filtrosModalOpen = !filtrosModalOpen;
                                    if (this.filtrosModalOpen) {
                                        this.filtrosSideBarOpen = false;
                                    }
                                }
                            }
                        }
                    </script>
                @endpush    

                <div class="basis-full md:basis-3/4 flex flex-col" x-data="{ rutaDescarga: '' }">
                    @if(count($oportunidades) >= 1)
                        <a :href="rutaDescarga"
                        @click="rutaDescarga = '{{ route('oportunidades-negocio.export') }}' + '?' + queryFiltros()"
                        class="w-64 mtv-button-gold mt-0 my-8 self-center text-center"
                        download>
                            @svg('go-download-16', ['class' => 'w-5 h-5 mr-1 inline-block'])
                            Descargar procedimientos
                        </a>
                    @endif
                    <div>
                         @if(count($oportunidades) >= 1)
                            <x-oportunidades.oportunidades-grid
                                    :oportunidades="$oportunidades" />
                         @else
                            <div class="flex flex-col space-y-4 items-center my-10">
                                <span class="text-primary text-2xl font-bold">
                                    No se encontraron resultados
                                </span>
                                <span class="text-mtv-text-gray text-xl font-bold">
                                    Intenta con otras palabras.
                                </span>
                                <span class="text-mtv-text-gray text-base">
                                    Consulta los catálogos “<a href="#" class="mtv-link-gold font-bold underline">Rubros</a>” o “<a href="#" class="mtv-link-gold font-bold underline">Bienes y Servicios</a>”
                                </span>
                                <span class="text-mtv-text-gray text-base">
                                    Visita el “<a href="#" class="mtv-link-gold font-bold  underline">Calendario de compras</a>” y consultar la programación para este año.
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <button
                    x-cloak
                    x-data="{ scrollBackTop: false }"
                    x-show="scrollBackTop"
                    x-on:scroll.window="scrollBackTop = (window.pageYOffset > window.outerHeight * 0.5) ? true : false"
                    x-on:click="window.scrollTo (0,0)"
                    aria-label="Back to top"
                    class="fixed bottom-0 right-0 p-2 mx-10 my-16 bg-white rounded opacity-95 text-mtv-primary font-bold focus:outline-none">
                        @svg('bi-arrow-bar-up', ['class' => 'w-10 h-10 block'])                        
                </button>
            </div>
        </div>
    </div>

    @push('scripts')        
        <script type="text/javascript">
            function encabezadoEstadisticas() {
                return {
                    etapasConteo: [],
                    unidadesCConteo: @js($estadisticas['conteo_dependencias']),
                    calculaEstadisticas() {
                        {{-- setTimeout establece un tiempo de espera para asegurarse de que el html de las tarjetas oportunidades --}}
                        {{-- haya sido agregado al DOM (Ver infiniteScrolling en resources/js/app.js) --}}
                        setTimeout(() => {
                            this.etapasConteo.forEach((e, key) => this.etapasConteo[key] = 0);
                            document.querySelectorAll('article[data-ep]').forEach(e => this.etapasConteo[e.dataset.ep] += 1);
                            let ucConteo = new Set();
                            document.querySelectorAll('article[data-uc]').forEach(u => ucConteo.add(u.dataset.uc));                                                        
                            this.unidadesCConteo = ucConteo.size;
                        }, 500);
                    },
                    initEncabezadoEstadisticas() {
                        Object.values(@js($estadisticas['conteo_etapas'])).forEach(e => this.etapasConteo[e.id] = e.conteo);                        
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
