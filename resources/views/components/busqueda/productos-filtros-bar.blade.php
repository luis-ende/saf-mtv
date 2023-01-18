@props(['filtros_opciones' => []])

<div class="py-3 flex flex-row space-x-2 md:flex-nowrap xs:flex-wrap">
    <div class="basis-10/12 flex flex-row space-x-2 md:flex-nowrap xs:flex-wrap">
        <div class="w-full flex flex-col" x-data="{ ordenIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="ordenIsOpen=true">
                Ordenar por
                <svg class="fill-current h-4 w-4 inline-block self-end" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="ordenIsOpen"
                @click.away="ordenIsOpen = false"
                class="flex flex-col border rounded p-1">
                <div class="">
                    <input type="radio" id="sort_nombre" name="sort_productos" value="nombre" checked>
                    <label for="sort_nombre">Nombre</label><br>
                    <input type="radio" id="sort_cabms" name="sort_productos" value="cabms">
                    <label for="sort_cabms">CABMS</label><br>
                    <input type="radio" id="sort_partida" name="sort_productos" value="partida">
                    <label for="sort_partida">Partida</label>
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>
        </div>

        <div class="w-full flex flex-col" x-data="{ capituloIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="capituloIsOpen=true">
                Capítulo
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="capituloIsOpen"
                @click.away="capituloIsOpen = false"
                class="flex flex-col border rounded p-1">
                <div class="h-24 overflow-y-auto">
                    <ul class="list-none list-outside p-1">
                        @foreach($filtros_opciones['capitulos'] as $capitulo)
                            <li>
                                <input type="checkbox" id="capitulo-{{ $capitulo }}" name="capitulo_filtro[]" value="{{ $capitulo }}">
                                <label for="capitulo-{{ $capitulo }}">{{ $capitulo }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>
        </div>

        <div class="w-full flex flex-col" x-data="{ partidaIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="partidaIsOpen=true">
                Partida
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="partidaIsOpen"
                @click.away="partidaIsOpen = false"
                class="flex flex-col border rounded p-1">
                <div class="h-24 overflow-y-auto">
                    <ul class="list-none list-outside p-1">
                        @foreach($filtros_opciones['partidas'] as $partida)
                            <li>
                                <input type="checkbox" id="partida-{{ $partida }}" name="partida_filtro[]" value="{{ $partida }}">
                                <label for="partida-{{ $partida }}">{{ $partida }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>
        </div>

        <div class="w-full flex flex-col" x-data="{ sectorIsOpen: false }">
            <button type="button"
                class="text-mtv-text-gray border rounded p-1"
                @click="sectorIsOpen=true">
                Sector
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="sectorIsOpen"
                @click.away="sectorIsOpen = false"
                class="flex flex-col border rounded p-1">
                <div class="">
                    <ul class="list-none list-outside p-1">
                    @foreach($filtros_opciones['sectores'] as $sector)
                        <li>
                            <input type="checkbox" id="sector-{{ $sector->id }}" name="sector_filtro[]" value="{{ $sector->id }}">
                            <label for="sector-{{ $sector->id }}">{{ $sector->sector }}</label>
                        </li>
                    @endforeach
                    </ul>
                </div>
                <button type="button"
                    @click="$event.target.form.submit()"
                    class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>
        </div>
    </div>

    <div class="md:basis-2/12 xs:basis-full">
        {{ $slot }}
    </div>
</div>
