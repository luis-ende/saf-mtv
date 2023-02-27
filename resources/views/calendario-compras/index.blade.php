<x-app-layout>      
    <div class="bg-white overflow-hidden min-h-screen">
        <div class="py-6 md:px-12 xs:px-6 bg-white border-b border-gray-200 flex flex-col">
            <div class="self-center">
                <label class="text-mtv-gray-2 md:text-xl">
                    Planeación anual
                </label>
                <h1 class="text-mtv-primary font-bold md:text-3xl xs:text-lg">
                    Compras programadas para el próximo año
                </h1>
            </div>
            <div class="self-center">
                <x-global.puntos-block />
            </div>                
            <div class="my-4 text-lg text-mtv-text-gray flex flex-col items-center">
                <span class="font-bold md:text-xl xs:text-base text-mtv-secondary mb-4 block text-center">
                    Identifica qué productos y servicios planea comprar la CDMX
                </span>
                <span class="md:w-2/5 block text-base xs:text-sm text-center">
                    Aquí encontrarás los procedimientos programados y en la sección <a href="{{ route('oportunidades-negocio.search') }}" class="underline font-bold mtv-link-gold">Oportunidades de negocio</a>
                    puedes visualizar el detalle y agregarlos a tus favoritos para darles seguimiento.
                </span>                
            </div>
            <div id="seccion-estadisticas" 
                 class="md:w-8/12 w-full flex flex-col md:flex-row md:space-x-16 md:space-y-0  my-4 self-center">
                <div class="md:basis-1/3 text-mtv-gray flex flex-column items-center py-2">
                    <span class="font-bold text-3xl text-mtv-secondary">
                        {{ count($compras) }}
                    </span>
                    <span class="text-base text-center">Instituciones compradoras</span>
                </div>
                <div class="md:basis-1/3 text-mtv-gray flex flex-column items-center py-2">
                    <span class="font-bold text-3xl text-mtv-secondary">
                        5,640
                    </span>
                    <span class="text-base text-center">Total de procedimientos programados</span>
                </div>
                <div class="md:basis-1/3 text-mtv-gray flex flex-column items-center py-2">
                    <span class="font-bold text-3xl text-mtv-secondary">
                        $57,951,987,120.62
                    </span>
                    <span class="text-base text-center">Prespuesto para contratación aprobado</span>
                </div>
            </div>
        </div>
        <div x-data="comprasFiltros()">
            {{-- Barra de filtros por letras iniciales de unidades compradoras --}}
            <div id="seccion-filtro-letras" class="my-4">
                <x-calendario-compras.iniciales-filtros :compras="$compras" />
            </div>                       
            <div class="block relative md:w-96 w-80 mx-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    @svg('forkawesome-search', ['class' => 'w-4 h-4 text-mtv-gray-2'])
                </div>
                <input type="search"
                        id="calendario_search" name="calendario_search"
                        class="block w-full pt-2 pb-2 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                        autofocus
                        placeholder="Búsqueda por nombre o palabra clave"
                        x-model="terminoBusqueda"
                        x-ref="calendarioSearchInput">
                <button type="submit"
                        class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1 hidden">
                    Buscar
                </button>
            </div>            
            <div id="seccion-datos" class="my-5 md:mx-20 xs:mx-3">
                <x-calendario-compras.calendario-data-table :compras="$compras" />
            </div>                
        </div>
        @push('scripts')
        <script type="text/javascript">
            function comprasFiltros() {
                return {                    
                    filtroLetraInicial: '',
                    terminoBusqueda: '',
                    bloqueoFiltroInicial: false,
                }
            }
        </script>
        @endpush
    </div>
</x-app-layout>      