<x-app-layout>        
    <div class="bg-white overflow-hidden min-h-screen">
        <div class="py-6 md:px-12 xs:px-6 bg-white border-b border-gray-200 flex flex-col">
            <div class="self-center">
                <label class="text-mtv-gray-2 text-xl">
                    Buscador de
                </label>
                <div class="text-mtv-primary font-bold text-3xl">
                    Oportunidades para venderle a la CDMX
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
            <div class="mt-4 text-lg text-mtv-text-gray text-center">
                <span class="font-bold text-xl text-mtv-secondary my-4 inline-block">
                    Identifica qué productos y servicios compra la CDMX.
                </span>
                <span class="w-3/4 inline-block">
                    Para activar las alertas de tu interés, 
                    <a href="{{ route('registro-inicio') }}" class="underline font-bold mtv-link-gold">regístrate en “Mi Tiendita Virtual”.</a>
                </span>
                <span class="w-3/4 text-lg inline-block">
                    Si ya estás registrado en Padrón de Proveedores, ahí te llegarán las notificaciones, sólo activa las alertas aquí.
                </span>
            </div>

            <div class="w-10/12 md:flex md:flex-row md:space-x-16 md:space-y-0 xs:grid xs:grid-cols-2 xs:grid-rows-2 xs:gap-x-5 xs:gap-y-2 my-4 self-center" 
                 x-data=etapasFiltros()>
                <div class="md:basis-1/5 text-mtv-gray flex flex-column items-center py-2 md:inline-flex xs:hidden">
                    <span class="font-bold text-5xl">{{ $estadisticas['conteo_dependencias'] }}</span>
                    <span class="text-lg">Instituciones compradoras</span>
                </div>

                @foreach($estadisticas['conteo_etapas'] as $etapa)
                    <button 
                        :class="esFiltroEtapaActivo(@js($etapa['id'])) ? 'mtv-button-filtro-ep-active' : 'mtv-button-filtro-ep-inactive'"
                        @click="activaFiltro(@js($etapa['id']))">
                        <span class="font-bold text-5xl">{{ $etapa['conteo'] }}</span>
                        <span class="text-lg">{{ $etapa['nombre_etapa']  }}</span>
                    </button>
                @endforeach

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
                            }
                        }
                    }
                </script>
            </div>                
        </div>
        
        <div class="my-3 flex flex-col" x-data="{ terminoBusqueda: @js(request()->get('tb') ?? '') }">
            <div class="w-2/4 self-center my-4">
                <form method="POST"
                      x-bind:action="'/oportunidades-de-negocio' + ($data.terminoBusqueda !== '' ? '?tb=' + $data.terminoBusqueda : '')">
                    @csrf

                    <label for="oportunidades_search" class="text-mtv-secondary text-sm mb-2">
                        Búsqueda por palabra clave:
                    </label>
                    <div class="flex md:flex-row md:space-x-3 md:space-y-0 xs:flex-col xs:space-y-3">
                        <div class="md:basis-10/12 xs:basis-full relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                @svg('forkawesome-search', ['class' => 'w-5 h-5 text-mtv-gray-2'])
                            </div>
                            <input type="search"
                                   id="oportunidades_search" name="oportunidades_search"
                                   class="block w-full pt-3 pb-3 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"                                   
                                   autofocus
                                   x-model="terminoBusqueda">
                            <button type="submit"
                                    class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1 hidden">
                                Buscar
                            </button>
                        </div>

                        <x-busqueda.enlaces-catalogos-pdf />

                    </div>
                </form>
            </div>            
            <div id="seccion-principal" class="flex md:flex-row xs:flex-col m-4" 
                {{-- TIP: Buscar inicialización de esta función reutilizable 'oportunidadesFiltrosURLParams()' en resources/js/app.js --}}
                 x-data="oportunidadesFiltrosURLParams">
                <div class="basis-full md:basis-1/4 md:mr-7 md:inline-flex xs:hidden">
                    <x-oportunidades.buscador-filtros-sidebar
                        :filtros_opciones="$filtros_opciones"
                     />
                </div>
                                
                <button type="button" class="md:hidden xs:block mtv-button-secondary mx-auto w-1/2 text-center">Filtros</button>

                <div class="basis-full md:basis-3/4 flex flex-col" x-data="{ rutaDescarga: '' }">
                    @if(count($oportunidades) >= 1)
                        <a :href="rutaDescarga"
                        @click="rutaDescarga = '{{ route('oportunidades-negocio.export') }}' + '?' + queryFiltros()"
                        class="mtv-button-gold my-4 self-center" 
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
            </div>
        </div>
    </div>
</x-app-layout>
