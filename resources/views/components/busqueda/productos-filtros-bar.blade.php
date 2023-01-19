@props(['filtros_opciones' => []])

<div class="py-3">
    <div class="flex flex-row space-x-2 md:flex-nowrap xs:flex-wrap">
        <div class="w-full text-mtv-text-gray flex flex-col relative" x-data="{ capituloIsOpen: false }">
            <button type="button"
                class="border rounded p-1 uppercase"
                @click="capituloIsOpen=true">
                Capítulo
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="capituloIsOpen"
                @click.away="capituloIsOpen = false"
                class="absolute z-50 mt-9 flex flex-col border rounded p-1 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-36 w-48 overflow-y-auto">
                    <ul class="list-none list-outside p-1">
                        @foreach($filtros_opciones['capitulos'] as $capitulo)
                            <li>
                                <input class="mr-1" type="checkbox" id="capitulo-{{ $capitulo }}" name="capitulo_filtro[]" value="{{ $capitulo }}">
                                <label for="capitulo-{{ $capitulo }}">{{ $capitulo }}</label>
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

        <div class="w-full text-mtv-text-gray flex flex-col relative" x-data="{ partidaIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1 uppercase"
                @click="partidaIsOpen=true">
                Partida
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="partidaIsOpen"
                @click.away="partidaIsOpen = false"
                 class="absolute z-50 mt-9 flex flex-col border rounded p-1 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-40 w-48 overflow-y-auto">
                    <ul class="list-none list-outside p-1">
                        @foreach($filtros_opciones['partidas'] as $partida)
                            <li>
                                <input class="mr-1" type="checkbox" id="partida-{{ $partida }}" name="partida_filtro[]" value="{{ $partida }}">
                                <label for="partida-{{ $partida }}">{{ $partida }}</label>
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

        <div class="w-full text-mtv-text-gray uppercase flex flex-col relative" x-data="{ sectorIsOpen: false }">
            <button type="button"
                class="border rounded p-1 uppercase"
                @click="sectorIsOpen=true">
                Sector
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="sectorIsOpen"
                @click.away="sectorIsOpen = false"
                 class="absolute z-50 mt-9 flex flex-col border rounded p-1 bg-white origin-top-left left-0 shadow-lg">
                <div class="h-16 w-48">
                    <ul class="list-none list-outside p-1">
                    @foreach($filtros_opciones['sectores'] as $sector)
                        <li>
                            <input class="mr-1" type="checkbox" id="sector-{{ $sector->id }}" name="sector_filtro[]" value="{{ $sector->id }}">
                            <label for="sector-{{ $sector->id }}">{{ $sector->sector }}</label>
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

        <div class="w-full text-mtv-text-gray flex flex-col relative" x-data="{ ordenIsOpen: false }">
            <button type="button"
                class="border rounded p-1"
                @click="ordenIsOpen=true">
                Ordenar por
                <svg class="fill-current h-4 w-4 inline-block self-end" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="ordenIsOpen"
                @click.away="ordenIsOpen = false"
                class="absolute z-50 mt-9 flex flex-col border rounded p-1 bg-white origin-top-left left-0 shadow-lg p-2">
                <div class="h-16 w-48">
                    <input class="mr-1" type="radio" id="sort_nombre" name="sort_productos" value="nombre" checked>
                    <label for="sort_nombre">Nombre</label><br>
                    <input class="mr-1" type="radio" id="sort_cabms" name="sort_productos" value="cabms">
                    <label for="sort_cabms">CABMS</label><br>
                    <input class="mr-1" type="radio" id="sort_partida" name="sort_productos" value="partida">
                    <label for="sort_partida">Partida</label>
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
