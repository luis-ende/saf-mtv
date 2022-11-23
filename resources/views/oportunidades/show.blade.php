<x-guest-layout>
    <div class="min-h-screen">
        <form>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Buscar</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" id="default-search" class="block w-full pt-3 pb-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[#691C32] focus:border-[#691C32]" placeholder="Buscar oportunidades por palabras clave..." required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-[#691C32] hover:bg-[#691C32] focus:ring-4 focus:outline-none focus:ring-[#691C32] font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
            </div>
        </form>

        <div class="flex flex-row">
            <div class="basis-3/12 p-5">
                <p>Filtros</p>
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
                <div class="flex flex-row flex-nowrap space-x-4 my-3">
                    <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/5 p-3 text-center font-bold">
                        <span class="text-lg">{{ $entidades_convocantes }}</span><p class="m-0"> Dependencias</p>
                    </div>
                    <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/5 p-3 text-center font-bold">
                        <span class="text-lg">{{ $procedimientos_proximos }}</span><p class="m-0"> Procedimientos próximos</p>
                    </div>
                    <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/5 p-3 text-center font-bold">
                        <span class="text-lg">{{ $licitaciones_publicas }}</span><p class="m-0"> Licitaciones públicas</p>
                    </div>
                    <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/5 p-3 text-center font-bold">
                        <span class="text-lg">{{ $invitaciones_restringidas }}</span><p class="m-0"> Invitaciones restringidas</p>
                    </div>
                    <div class="rounded border border-gray-200 bg-gray-300 shadow-md basis-1/5 p-3 text-center font-bold">
                        <span class="text-lg">{{ $adjudicaciones_directas }}</span><p class="m-0"> Adjudicaciones directas</p>
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
                        <a href="#" title="Expandir categorías">
                            @svg('carbon-expand-categories', ['class' => 'h-5 w-5 inline-block'])
                        </a>
                    </div>
                    <div class="rounded border border-slate-600 p-2">
                        <a href="#" title="Cerrar categorías">
                            @svg('carbon-collapse-categories', ['class' => 'h-5 w-5 inline-block'])
                        </a>
                    </div>
                </div>

                <div class="accordion" id="oportunidades-accordion">
                    @foreach($categorias as $categoria => $oportunidades)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-oportunidad-{{ $loop->index }}">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#body-oportunidad-{{ $loop->index }}" aria-expanded="true" aria-controls="body-oportunidad-{{ $loop->index }}">
                                @svg('govicon-building', ['class' => 'h-5 w-5 inline-block mr-3'])
                                {{ $categoria }} ({{ count($oportunidades) }} Procedimiento{{ count($oportunidades) > 1 ? 's' : '' }})
                            </button>
                        </h2>
                        <div id="body-oportunidad-{{ $loop->index }}" class="accordion-collapse collapse show" aria-labelledby="heading-oportunidad-{{ $loop->index }}" data-bs-parent="#oportunidades-accordion">
                            <div class="accordion-body flex flex-row flex-wrap">
                                @foreach($oportunidades as $oportunidad)
                                <div class="w-full rounded border border-dashed border-gray-200 p-2 mb-3">
                                    <div class="block bg-gray-300 rounded font-bold m-0 text-[#691C32] p-2 mb-2">
                                        {{ $oportunidad['nombre_procedimiento'] }}
                                    </div>
                                    <div class="w-full p-2 flex flex-row">
                                        <div class="basis-1/2">
                                            <p class="m-0"><span class="font-bold">Fecha de publicación:</span> {{ $oportunidad['fecha_publicacion'] }}</p>
                                            <p class="m-0"><span class="font-bold">Presentación de propuestas:</span> {{ $oportunidad['fecha_presentacion_propuestas'] }}</p>
                                            <p class="m-0"><span class="font-bold">Tipo de contratación:</span> {{ $oportunidad['tipo_contratacion'] }}</p>
                                            <p class="m-0"><span class="font-bold">Modo de contratación:</span> {{ $oportunidad['metodo_contratacion'] }}</p>
                                            <p class="m-0"><span class="text-sm text-slate-600">*Para poder cotizar necesitas registrarte o iniciar sesión si ya cuentas con un registro en el Padrón de Proveedores</p>
                                        </div>
                                        <div class="basis-1/2 flex flex-row items-center space-x-4">
                                            <div><p class="basis-1/5 border rounded bg-[#691C32] text-slate-200 text-sm text-center p-3">Programado próximamente</p></div>
                                            <div><p class="basis-1/5 border rounded text-sm text-center p-3">Prebases</p></div>
                                            <div><p class="basis-1/5 border rounded text-sm text-center p-3">Oportunidades de negocio</p></div>
                                            <div><p class="basis-1/5 border rounded text-sm text-center p-3">Pre-cotizar</p></div>
                                            <div class="basis-1/5 text-center">
                                                @svg('lucide-bell-plus', ['class' => 'h-7 w-7 inline-block mr-3'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
