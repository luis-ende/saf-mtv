@props([
    'modo' => 'busqueda',
    'proveedores' => []
])

@if($modo === 'busqueda')
    {{-- TIP: Buscar esta función reutilizable 'infiniteScrolling()' en resources/js/app.js --}}
    <div x-data="infiniteScrolling"
         {{-- initInfiniteScrolling(paginationOffset, numRecords, filtros, ) --}}
         x-init="initInfiniteScrolling(@js($pagination_offset), @js(count($proveedores)), @js(@$filtros), '{{ $buscador_items_route }}')">
@endif

    <div class="grid md:grid-cols-4 md:gap-7 sm:grid-cols-2 sm:gap-2" x-ref="resultsGrid">
        @foreach($proveedores as $proveedor)
            <x-proveedores.proveedor-card
                :proveedor="$proveedor"
            />
        @endforeach
    </div>

@if($modo === 'busqueda')
    <button x-show="!maxResultados" class="mtv-button-gray uppercase w-full my-5" type="button"
            @click="retrieveData();"
    >Ver más resultados</button>
</div>
@endif