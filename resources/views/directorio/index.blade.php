<x-app-layout>
    @section('page_title', 'Directorio CDMX')
    <div class="bg-white overflow-hidden min-h-screen">
        <div class="py-6 md:px-12 xs:px-6 bg-white border-b border-gray-200 flex flex-col">
            <div class="self-center">
                <label class="text-mtv-gray-2 md:text-xl">
                    Directorio CDMX
                </label>
                <h1 class="text-mtv-primary font-bold md:text-3xl xs:text-lg">
                    Contacta a las Instituciones compradoras
                </h1>
            </div>
            <div class="self-center">
                <x-global.puntos-block />
            </div>
            <div class="my-4 text-lg text-mtv-text-gray flex flex-col items-center">
                <span class="font-bold md:text-xl xs:text-base text-mtv-secondary mb-4 block text-center">
                    Nombre y datos de contacto de funcionarios
                </span>
                <span class="md:w-2/5 block text-base xs:text-sm text-center">
                    Para ver el detalle, en la columna “Acciones”, da clic en el icono “Credencial” y para iniciar una llamada, da clic en el icono “Teléfono” (sólo aplica para la versión móvil).
                </span>
            </div>
        </div>
        <div x-data="directorioFiltros()">
            {{-- Barra de filtros por letras iniciales de unidades compradoras --}}
            <div id="seccion-filtro-letras" class="my-4">
                <x-directorio.iniciales-filtros :funcionarios="$funcionarios" />
            </div>
            <div class="block relative md:w-96 w-80 mx-auto">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    @svg('forkawesome-search', ['class' => 'w-4 h-4 text-mtv-gray-2'])
                </div>
                <input type="search"
                       id="directorio_search" name="directorio_search"
                       class="block w-full pt-2 pb-2 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                       autofocus
                       placeholder="Búsqueda por nombre o palabra clave"
                       x-model="terminoBusqueda"
                       x-ref="directorioSearchInput">
                <button type="submit"
                        class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1 hidden">
                    Buscar
                </button>
            </div>
            <div id="seccion-datos" class="my-5 md:mx-20 xs:mx-3">
                <x-directorio.directorio-data-table :funcionarios="$funcionarios" />
            </div>
        </div>
        @push('scripts')
            <script type="text/javascript">
                function directorioFiltros() {
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