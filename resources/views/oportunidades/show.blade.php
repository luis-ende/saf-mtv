<x-app-layout>
    <div x-data="oportunidadesPagina()" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
        <div class="bg-white overflow-hidden min-h-fit">
            <div class="text-slate-800 font-bold text-2xl p-6 bg-white border-b border-gray-200">
                @svg('lineawesome-business-time-solid', ['class' => 'h-7 w-7 inline-block mr-1'])
                Oportunidades de negocio
            </div>
            <div class="p-6 bg-[#F7F3ED] border-b border-gray-200 text-base mb-2">
                Utiliza este buscador con palabras clave y descubre nuevas oportunidades para tu negocio. Si eres un usuario registrado, activa la campana y recibe notificaciones.
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('oportunidades-negocio.search') }}">
                    @csrf
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="search"
                               id="oportunidades-search" name="oportunidades-search"
                               class="block w-full pt-3 pb-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[#691C32] focus:border-[#691C32]"
                               placeholder="Buscar oportunidades por palabras clave..."
                               autofocus
                               value="{{ $term_busqueda ?? '' }}"
                               >
                        <button type="submit" class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1">Buscar</button>
                    </div>
                </form>
                @isset($num_resultados)
                    @if($num_resultados === 0 and !empty($term_busqueda))
                        <div class="p-0 mt-2 text-slate-700">
                            No se encontraron oportunidades con el término <span class="font-bold">"{{ $term_busqueda }}"</span>.
                        </div>
                    @endif
                    @if($num_resultados > 0 && !empty($term_busqueda))
                        <div class="p-0 mt-2 text-slate-700">
                            <span class="font-bold">{{ $num_resultados }}</span> Oportunidades encontradas con el término <span class="font-bold">"{{ $term_busqueda }}</span>".
                        </div>
                    @endif
                @endisset

                <div class="flex flex-row">
                    <div class="basis-3/12 pt-5 pr-5">
                        <p class="font-bold">Filtros (búsqueda avanzada)</p>
                        <div class="alert alert-info text-sm-center">Si estas familiarizado con las compras públicas, la búsqueda avanzada te servirá para encontrar con mayor precisión los procedimientos que te interesan.</div>
                        <label for="urg">Unidad Responsable de Gasto</label>
                        <select class="form-select" id="urg" name="urg">
                            <option>Alcaldía Álvaro Obregón</option>
                            <option>Alcaldía Benito Juárez</option>
                            <option>Alcandía Cuauhtémoc</option>
                        </select>
                        <label for="metodo-contratacion">Método de contratación</label>
                        <select class="form-select" id="metodo-contratacion" name="metodo-contratacion">
                            <option>Todas</option>
                            <option>Licitaciones Públicas</option>
                            <option>Adjudicación Directa</option>
                            <option>Invitación Restringida</option>
                        </select>
                        <label for="estatus">Estatus</label>
                        <select class="form-select" id="estatus" name="estatus">
                            <option>Cerrado</option>
                            <option>Abierto</option>
                            <option>Programado</option>
                        </select>
                        <label for="estatus">Tipo de procedimiento</label>
                        <select class="form-select" id="estatus" name="estatus">
                            <option>Todos</option>
                            <option>Bienes</option>
                            <option>Servicios</option>
                        </select>
                        <label for="fecha_desde">Desde fecha</label>
                        <input class="form-control" type="date" id="fecha_desde" name="fecha_desde">
                        <label for="fecha_hasta">Hasta fecha</label>
                        <input class="form-control" type="date" id="fecha_hasta" name="fecha_hasta">
                    </div>
                    <div class="basis-9/12">
                        <div class="flex flex-row flex-wrap mt-5">
                            <div class="basis-1/5 p-1 text-center font-bold flex flex-column">
                                @svg('govicon-building', ['class' => 'h-20 w-20 p-3 mb-2 inline-block border-4 border-[#BC955C] text-slate-800 rounded-full self-center'])
                                <div class="flex flex-column">
                                    <span class="text-xl">{{ $entidades_convocantes }}</span>
                                    <p class="m-0 text-slate-700 text-base">Dependencias</p>
                                </div>
                            </div>
                            <div class="basis-1/5 p-1 text-center font-bold flex flex-column">
                                @svg('carbon-view-next', ['class' => 'basis-1/2 h-20 w-20 p-3 mb-2 inline-block mr-3 border-4 border-[#BC955C] text-slate-800 rounded-full self-center'])
                                <div class="basis-1/2 flex flex-column">
                                    <span class="text-xl">{{ $procedimientos_proximos }}</span>
                                    <p class="m-0 text-slate-700 text-base">Procedimientos próximos</p>
                                </div>
                            </div>
                            <div class="basis-1/5 p-1 text-center font-bold flex flex-column">
                                @svg('gmdi-public', ['class' => 'basis-1/2 h-20 w-20 p-3 mb-2 inline-block mr-3 border-4 border-[#BC955C] text-slate-800 rounded-full self-center'])
                                <div class="basis-1/2 flex flex-column">
                                    <span class="text-xl">{{ $licitaciones_publicas }}</span>
                                    <p class="m-0 text-slate-700 text-base">Licitaciones públicas</p>
                                </div>
                            </div>
                            <div class="basis-1/5 p-1 text-center font-bold flex flex-column">
                                @svg('ri-chat-private-line', ['class' => 'basis-1/2 h-20 w-20 p-3 mb-2 inline-block mr-3 border-4 border-[#BC955C] text-slate-800 rounded-full self-center'])
                                <div class="basis-1/2 flex flex-column">
                                    <span class="text-xl">{{ $invitaciones_restringidas }}</span>
                                    <p class="m-0 text-slate-700 text-base">Invitaciones restringidas</p>
                                </div>
                            </div>
                            <div class="basis-1/5 p-1 text-center font-bold flex flex-column">
                                @svg('eos-assignment-ind-o', ['class' => 'basis-1/2 h-20 w-20 p-3 mb-2 inline-block mr-3 border-4 border-[#BC955C] text-slate-800 rounded-full self-center'])
                                <div class="basis-1/2 flex flex-column">
                                    <span class="text-xl">{{ $adjudicaciones_directas }}</span>
                                    <p class="m-0 text-slate-700 text-base">Adjudicaciones directas</p>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex flex-row items-center my-3 space-x-4 align-self-end">
                            <div class="rounded border border-slate-600 p-2">
                                <a href="#" title="Descargar en formato Excel">
                                    @svg('fileicon-microsoft-excel', ['class' => 'h-5 w-5 inline-block ml-1'])
                                </a>
                                Descargar
                            </div>
                            <div class="rounded border border-slate-600 p-2">
                                <a href="#" title="Expandir categorías" @click="$event.preventDefault(); expandAll()">
                                    @svg('carbon-expand-categories', ['class' => 'h-5 w-5 inline-block'])
                                </a>
                            </div>
                            <div class="rounded border border-slate-600 p-2">
                                <a href="#" title="Cerrar categorías" @click="$event.preventDefault(); collapseAll()">
                                    @svg('carbon-collapse-categories', ['class' => 'h-5 w-5 inline-block'])
                                </a>
                            </div>
                        </div>

                        <x-oportunidades-listado
                            :categorias="$categorias"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function oportunidadesPagina() {
            return {
                accordionMode: 'expand',

                expandAll() {
                    const collapseElementList = document.querySelectorAll('.collapse');
                    [...collapseElementList].forEach(collapseEl => {
                        let bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: false });
                        bsCollapse.show();
                    });
                },
                collapseAll() {
                    const collapseElementList = document.querySelectorAll('.collapse');
                    [...collapseElementList].forEach(collapseEl => {
                        let bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: false });
                        bsCollapse.hide();
                    });
                },
            }
        }
    </script>
</x-app-layout>
