@props(['filtros_opciones' => []])

<div class="py-3">
    <div class="flex flex-row space-x-2">
        <div class="w-full text-mtv-text-gray uppercase flex flex-col relative" x-data="{ sectorIsOpen: false }" x-cloak>
            <button type="button"
                    class="border rounded p-1 uppercase flex flex-row justify-center"
                    @click="sectorIsOpen=true">
                Sector
                <svg class="fill-current h-4 w-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="sectorIsOpen"
                 @click.away="sectorIsOpen = false"
                 class="absolute z-50 mt-9 flex flex-col border rounded p-2 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-16 w-48">
                    <ul class="list-none list-outside p-0">
                        @foreach($filtros_opciones['sectores'] as $sector)
                            <li>
                                <input class="mr-1 focus:ring-mtv-secondary" type="checkbox" id="sector_prov_{{ $sector->id }}" name="sector_prov_filtro[]" value="{{ $sector->id }}">
                                <label for="sector_prov_{{ $sector->id }}">{{ $sector->sector }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="submit"
                    class="mtv-button-secondary w-20 my-1 inline-block self-end">
                    Buscar
                </button>
            </div>
        </div>

        <div class="w-full text-mtv-text-gray flex flex-col relative" x-data="{ grupoPrioritarioIsOpen: false }" x-cloak>
            <button type="button"
                class="w-56 border rounded p-1 uppercase flex flex-row justify-center"
                @click="grupoPrioritarioIsOpen=true">
                Sector prioritario
                <svg class="fill-current h-4 w-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="grupoPrioritarioIsOpen"
                @click.away="grupoPrioritarioIsOpen = false"
                 class="absolute z-50 mt-9 flex flex-col border rounded p-1 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-28 w-56 overflow-y-auto">
                    <ul class="list-none list-outside p-1 text-xs">
                        @foreach($filtros_opciones['grupos_prioritarios'] as $grupo)
                            <li class="mb-2">
                                <input type="checkbox"
                                       id="grupo_p-{{ $grupo->id }}"
                                       name="grupo_p_filtro[]"
                                       value="{{ $grupo->id }}"
                                       class="mr-1 focus:ring-mtv-secondary">
                                <label for="grupo_p-{{ $grupo->id }}">{{ $grupo->grupo }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary w-20 my-1 inline-block self-end">
                    Buscar
                </button>
            </div>
        </div>

        {{-- <div class="w-full text-mtv-text-gray flex flex-col relative" x-data="{ categoriaIsOpen: false }">
            <button type="button"
                class="border rounded p-1 uppercase flex flex-row justify-center"
                @click="categoriaIsOpen=true">
                Categoría
                <svg class="fill-current h-4 w-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="categoriaIsOpen"
                @click.away="categoriaIsOpen = false"
                class="absolute z-50 mt-9 flex flex-col border rounded p-1 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-48 md:w-96 xs:w-48 overflow-y-auto">
                    <ul class="list-none list-outside p-1 text-xs">
                        @foreach($filtros_opciones['categorias'] as $categoria)
                            <li class="mb-2">
                                <input class="mr-1 border rounded focus:ring-mtv-secondary" type="checkbox" id="categoria-{{ $categoria->id }}" name="categoria_filtro[]" value="{{ $categoria->id }}">
                                <label for="categoria-{{ $categoria->id }}">{{ $categoria->categoria_scian }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary w-20 my-1 inline-block self-end">
                    Buscar
                </button>
            </div>
        </div> --}}

        <div class="w-full text-mtv-text-gray uppercase flex flex-col relative" x-data="{ alcaldiaIsOpen: false }" x-cloak>
            <button type="button"
                class="border rounded p-1 uppercase flex flex-row justify-center"
                @click="alcaldiaIsOpen=true">
                Alcaldía
                <svg class="fill-current h-4 w-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="alcaldiaIsOpen"
                @click.away="alcaldiaIsOpen = false"
                class="absolute z-50 mt-9 flex flex-col border rounded p-1 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-48 md:w-96 xs:w-48 overflow-y-auto">
                    <ul class="list-none list-outside p-1 text-xs">
                        @foreach($filtros_opciones['alcaldias'] as $alcaldia)
                            <li class="mb-2">
                                <input class="mr-1 focus:ring-mtv-secondary" type="checkbox" id="alcaldia-{{ $alcaldia->id }}" name="alcaldia_filtro[]" value="{{ $alcaldia->id }}">
                                <label for="alcaldia-{{ $alcaldia->id }}">{{ $alcaldia->alcaldia }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary w-20 my-1 inline-block self-end">
                    Buscar
                </button>
            </div>
        </div>        

        <div class="w-full text-mtv-text-gray uppercase flex flex-col relative" x-data="{ padronEstatusIsOpen: false }" x-cloak>
            <button type="button"
                    class="w-56 border rounded p-1 uppercase flex flex-row justify-center"
                    @click="padronEstatusIsOpen=true">
                Padrón de Proveedores
                <svg class="fill-current h-4 w-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="padronEstatusIsOpen"
                 @click.away="padronEstatusIsOpen = false"
                 class="absolute z-50 mt-9 flex flex-col border rounded p-2 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-16 w-48">
                    <ul class="list-none list-outside p-0">
                        @foreach($filtros_opciones['padron_prov_estatus'] as $key => $estatus)
                            @php($estatusLabel = $key === 4 ? 'En revisión' : ($key === 7 ? 'Constancia vigente' : $estatus))
                            <li>
                                <input class="mr-1 focus:ring-mtv-secondary" type="checkbox" id="prov_estatus_{{ $key }}" name="padron_prov_estatus[]" value="{{ $key }}">
                                <label for="prov_estatus_{{ $key }}">{{ $estatusLabel }}</label>
                            </li>
                        @endforeach
                        <li>
                            <input class="mr-1 focus:ring-mtv-secondary" type="checkbox" id="sector_prov_0" name="sector_prov_filtro[]" value="{{ $sector->id }}">
                            <label for="sector_prov_0">Sin registro</label>
                        </li>
                    </ul>
                </div>
                <button type="submit"
                    class="mtv-button-secondary w-20 my-1 inline-block self-end">
                    Buscar
                </button>
            </div>
        </div>

        <div class="w-full text-mtv-text-gray flex flex-col relative" x-data="{ ordenProvIsOpen: false }" x-cloak>
            <button type="button"
                class="border rounded p-1 flex flex-row justify-center"
                @click="ordenProvIsOpen=true">
                Ordenar por
                <svg class="fill-current h-4 w-4 inline-block self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="ordenProvIsOpen"
                @click.away="ordenProvIsOpen = false"
                class="absolute z-50 mt-9 flex flex-col border rounded p-2 bg-white origin-top-left left-0 shadow-2xl">
                <div class="h-16 w-48 uppercase">
                    <div class="block">
                        <input class="mr-1 border rounded focus:ring-mtv-secondary" type="radio" id="sort_nombre" name="sort_proveedores" value="nombre_negocio" checked>
                        <label for="sort_nombre">Nombre comercial</label>
                    </div>    
                    <div class="block">
                        <input class="mr-1 border rounded focus:ring-mtv-secondary" type="radio" id="sort_sector" name="sort_proveedores" value="sector">
                        <label for="sort_sector">Sector</label>
                    </div>
                    <div class="block">
                        <input class="mr-1 border rounded focus:ring-mtv-secondary" type="radio" id="sort_giro" name="sort_proveedores" value="categoria_scian">
                        <label for="sort_giro">Giro</label>
                    </div>    
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary w-20 my-1 inline-block self-end">
                    Buscar
                </button>
            </div>
        </div>
    </div>
</div>
