@props(['filtros_opciones' => []])

<div class="py-3 flex flex-row space-x-2">
    <div class="basis-10/12 flex flex-row space-x-2">
        <div class="w-full flex flex-col" x-data="{ categoriaIsOpen: false }">
            <button type="button"
                    class="text-mtv-text-gray border rounded p-1"
                    @click="categoriaIsOpen=true">
                Giro
                <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div x-show="categoriaIsOpen"
                 @click.away="categoriaIsOpen = false"
                 class="flex flex-col border rounded p-2">
                <div class="h-24 w-96 overflow-y-auto">
                    <ul class="list-none list-outside p-0 text-xs">
                        @foreach($filtros_opciones['categorias'] as $categoria)
                            <li>
                                <input type="checkbox" id="categoria-{{ $categoria->id }}" name="categoria-{{ $categoria->id }}" value="{{ $categoria->id }}">
                                <label for="categoria-{{ $categoria->id }}">{{ $categoria->categoria_scian }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="submit"
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
                 class="flex flex-col border rounded p-2">
                <div class="">
                    <ul class="list-none list-outside p-0">
                        @foreach($filtros_opciones['sectores'] as $sector)
                            <li>
                                <input type="checkbox" id="sector-{{ $sector->id }}" name="sector-{{ $sector->id }}" value="{{ $sector->id }}">
                                <label for="sector-{{ $sector->id }}">{{ $sector->sector }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <button type="submit"
                        class="mtv-button-secondary-white my-1 inline-block">
                    Buscar
                </button>
            </div>
        </div>
    </div>

    <div class="basis-2/12">
        {{ $slot }}
    </div>
</div>
