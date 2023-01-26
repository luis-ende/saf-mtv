@props(['label' => '', 'id' => 'productos_search', 'name' => 'productos_search'])

<form method="POST"
      x-bind:action="'/buscador-mtv/' + $data.tipoBusqueda + '/' + $data.terminoBusqueda">
    @csrf

    <label for="{{ $id }}" class="text-mtv-secondary text-sm mb-2">
        {{ $label }}
    </label>
    <div class="flex md:flex-row md:space-x-3 md:space-y-0 xs:flex-col xs:space-y-3">
        <div class="{{ isset($button_bar) ? 'md:basis-10/12 xs:basis-full' : 'basis-full' }} relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                @svg('forkawesome-search', ['class' => 'w-5 h-5 text-mtv-gray-2'])
            </div>
            <input type="search"
                    id="{{ $id }}" name="{{ $name }}"
                    class="block w-full pt-3 pb-3 pl-10 text-sm text-mtv-text-gray border border-gray-300 rounded-lg bg-gray-50 focus:ring-mtv-primary focus:border-mtv-primary"
                    placeholder="Buscar por palabras clave..."
                    autofocus
                    x-model="terminoBusqueda"
                    value="{{ $term_busqueda ?? '' }}">
            <input id="tipo_busqueda" name="tipo_busqueda" type="hidden" x-model="tipoBusqueda">
            <button type="submit"
                    class="mtv-button-secondary absolute right-2.5 bottom-[0.525rem] m-0 mt-1 md:block xs:hidden"
                    x-bind:disabled="!terminoBusqueda">
                Buscar
            </button>
        </div>
        
        @isset($button_bar)
            {{ $button_bar }}
        @endisset
    </div>

    {{ $busqueda_filtros }}    
</form>  