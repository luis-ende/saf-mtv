<x-app-layout>
    <div class="bg-white overflow-hidden min-h-screen">
        <div class="py-6 md:px-12 xs:px-6 bg-white border-b border-gray-200 flex flex-col">
            <div class="self-center">                
                <h1 class="text-mtv-secondary font-bold md:text-3xl xs:text-lg uppercase">
                    {{ $unidad_compradora->nombre }}
                </h1>
            </div>
            <div class="self-center">
                <x-global.puntos-block />
            </div>
            <div id="seccion-estadisticas" 
                 class="md:w-6/12 w-full flex flex-col md:flex-row md:space-x-8 md:space-y-0  my-4 self-center">                
                <div class="md:basis-1/2 text-mtv-gray flex flex-column items-center py-2">
                    <span class="font-bold text-3xl text-mtv-secondary">
                        {{ $totales['total_procedimientos'] }}
                    </span>
                    <span class="text-base text-center">Procedimientos</span>
                </div>
                <div class="md:basis-1/2 text-mtv-gray flex flex-column items-center py-2">
                    <span class="font-bold text-3xl text-mtv-secondary">
                        {{ $totales['presup_contratacion_aprobado'] }}
                    </span>
                    <span class="text-base text-center">Presupuesto para contratación aprobado</span>
                </div>
            </div>
        </div>        
        <div x-data="comprasDetalleFiltros()">
            <div class="flex flex-col md:flex-row items-center justify-center md:space-x-14 md:space-y-0 space-y-10 my-5">
                @php($queryParams = count(request()->query()) > 0 ? '?' . http_build_query(request()->query()) : '')
                <a href="{{ route('calendario-compras.index') . $queryParams . '#seccion-datos' }}" class="mtv-button-secondary-white no-underline">
                    @svg('fas-arrow-left', ['class' => 'h-5 w-5 inline-block mr-3'])
                    Atrás
                </a>
                <div class="relative md:w-96 w-80">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        @svg('forkawesome-search', ['class' => 'w-4 h-4 text-mtv-gray-2'])
                    </div>
                    <input type="search"
                           id="calendario_detalle_search" name="calendario_detalle_search"
                           class="block w-full pt-2 pb-2 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                           autofocus
                           placeholder="Búsqueda por palabra clave"
                           x-model="terminoBusqueda">
                    <button type="submit"
                            class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1 hidden">
                        Buscar
                    </button>
                </div>
                <div class="flex flex-row space-x-14">
                    <a href="#" class="mtv-button-secondary-white border-none">
                        @svg('export_pdf', ['class' => 'w-7 h-7'])
                    </a>
                    <a href="#" class="mtv-button-secondary-white border-none">
                        @svg('export_xls', ['class' => 'w-7 h-7'])
                    </a>
                </div>
            </div>
            <div id="seccion-datos" class="mb-5 md:mx-20 xs:mx-3 hidden md:block">
                <x-calendario-compras.detalle-data-table
                        :procedimientos="$procedimientos"
                />
            </div>
        </div>
        @push('scripts')
        <script type="text/javascript">
            function comprasDetalleFiltros() {
                return {                    
                    terminoBusqueda: '',
                }
            }
        </script>
        @endpush
    </div>
</x-app-layout>      