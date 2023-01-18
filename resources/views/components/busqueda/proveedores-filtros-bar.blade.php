@props(['filtros_opciones' => []])

<div class="py-3">
    <div class="flex flex-row space-x-2">        
        <div class="w-full flex flex-col" x-data="{ grupoPrioritarioIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1 uppercase"
                @click="grupoPrioritarioIsOpen=true">
                Sector prioritario
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="grupoPrioritarioIsOpen"
                @click.away="grupoPrioritarioIsOpen = false"
                class="flex flex-col border rounded p-1">
                <div class="h-24 w-56 overflow-y-auto">
                    <ul class="list-none list-outside p-1 text-xs">
                        @foreach($filtros_opciones['grupos_prioritarios'] as $grupo)
                            <li class="mb-2">
                                <input type="checkbox" id="grupo_p-{{ $grupo['id'] }}" name="grupo_p_filtro[]" value="{{ $grupo['id'] }}">
                                <label for="grupo-{{ $grupo['id'] }}">{{ $grupo['grupo'] }}</label>
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

        <div class="w-full flex flex-col" x-data="{ categoriaIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1 uppercase"
                @click="categoriaIsOpen=true">
                Categoría
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="categoriaIsOpen"
                @click.away="categoriaIsOpen = false"
                class="flex flex-col border rounded p-1">
                <div class="h-24 w-96 overflow-y-auto">
                    <ul class="list-none list-outside p-1 text-xs">
                        @foreach($filtros_opciones['categorias'] as $categoria)
                            <li class="mb-2">
                                <input type="checkbox" id="categoria-{{ $categoria->id }}" name="categoria_filtro[]" value="{{ $categoria->id }}">
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
        </div>

        <div class="w-full flex flex-col" x-data="{ sectorIsOpen: false }">
            <button type="button"
                    class="text-mtv-text-gray border rounded p-1 uppercase"
                    @click="sectorIsOpen=true">
                Sector
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="sectorIsOpen"
                 @click.away="sectorIsOpen = false"
                 class="flex flex-col border rounded p-2">
                <div class="">
                    <ul class="list-none list-outside p-0">
                        @foreach($filtros_opciones['sectores'] as $sector)
                            <li>
                                <input type="checkbox" id="sector_prov_{{ $sector->id }}" name="sector_prov_filtro[]" value="{{ $sector->id }}">
                                <label for="sector_prov{{ $sector->id }}">{{ $sector->sector }}</label>
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
        
        <div class="w-full flex flex-col" x-data="{ padronEstatusIsOpen: false }">
            <button type="button"
                    class="text-mtv-text-gray border rounded p-1 uppercase text-xs"
                    @click="padronEstatusIsOpen=true">
                Padrón de Proveedores
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>            
            <div x-show="padronEstatusIsOpen"
                 @click.away="padronEstatusIsOpen = false"
                 class="flex flex-col border rounded p-2">
                <div class="">
                    <ul class="list-none list-outside p-0">                        
                        @foreach($filtros_opciones['padron_prov_estatus'] as $key => $estatus)
                            @php($estatusLabel = $key === 4 ? 'En revisión' : ($key === 7 ? 'Constancia vigente' : $estatus))
                            <li>
                                <input type="checkbox" id="prov_estatus_{{ $key }}" name="padron_prov_estatus[]" value="{{ $key }}">
                                <label for="prov_estatus_{{ $key }}">{{ $estatusLabel }}</label>
                            </li>
                        @endforeach
                        <li>
                            <input type="checkbox" id="sector_prov_0" name="sector_prov_filtro[]" value="{{ $sector->id }}">
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

        <div class="w-full flex flex-col" x-data="{ ordenProvIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="ordenProvIsOpen=true">
                Ordenar por
                <svg class="fill-current h-4 w-4 inline-block self-end" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="ordenProvIsOpen"
                @click.away="ordenProvIsOpen = false"
                class="flex flex-col border rounded p-1">
                <div class="">
                    <input type="radio" id="sort_nombre" name="sort_proveedores" value="nombre_negocio" checked>
                    <label for="sort_nombre">Nombre comercial</label><br>
                    <input type="radio" id="sort_sector" name="sort_proveedores" value="sector">
                    <label for="sort_sector">Sector</label><br>
                    <input type="radio" id="sort_giro" name="sort_proveedores" value="categoria_scian">
                    <label for="sort_giro">Giro</label>
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
