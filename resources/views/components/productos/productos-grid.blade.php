@props([
    'modo' => 'catalogo', // 'catalogo', 'busqueda'
    'productos' => []
])

@if($modo === 'busqueda')
{{-- TIP: Buscar esta función reutilizable 'infiniteScrolling()' en resources/js/app.js --}}
<div x-data="infiniteScrolling"
     {{-- initInfiniteScrolling(paginationOffset, numRecords, filtros, buscadorItemsRoute) --}}
    x-init="initInfiniteScrolling(@js($pagination_offset), @js(count($productos)), @js(@$filtros), '{{ $buscador_items_route }}')">
@endif

    <div class="grid md:grid-cols-4 md:gap-7 sm:grid-cols-2 sm:gap-2" x-ref="resultsGrid">
        @foreach($productos as $producto)
            <x-productos.producto-card
                :producto="$producto"
                :modo="$modo"
            />
        @endforeach
    </div>

@if($modo === 'busqueda')
    <div class="my-4 text-center">
        <button type="button"
                x-show="!maxResultados && !isLoading" 
                class="text-mtv-gray font-bold bg-white border rounded uppercase py-2 w-full" 
                @click="retrieveData();"
        >Ver más resultados</button>
        <span x-show="isLoading" class="spinner-border text-mtv-text-gray" role="status" aria-hidden="true"></span>        
    </div>    
</div>
@endif