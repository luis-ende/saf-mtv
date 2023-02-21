@props(['oportunidades' => []])

<div x-data="infiniteScrolling"
     {{-- TIP: Buscar esta función reutilizable 'infiniteScrolling()' en resources/js/app.js --}}
     {{-- initInfiniteScrolling(paginationOffset, numRecords, filtros, buscadorItemsRoute) --}}
     x-init="document.addEventListener('infiniteScrollingUpdate', event => { $data.calculaEstadisticas() }); 
             initInfiniteScrolling(@js($pagination_offset), @js(count($oportunidades)), @js(@$filtros), '{{ $buscador_items_route }}')">

    <div class="grid md:grid-cols-3 md:gap-7 sm:grid-cols-2 sm:gap-2" x-ref="resultsGrid">
        @foreach($oportunidades as $oportunidad)
            <x-oportunidades.oportunidad-card
                :vista="request()->path()"
                :oportunidad="$oportunidad" />
        @endforeach
    </div>

    <div class="my-4 text-center">
        <button type="button"
                x-show="!maxResultados && !isLoading" 
                class="text-mtv-gray font-bold bg-white border rounded uppercase py-2 w-full" 
                @click="retrieveData()"
        >Ver más resultados</button>
        <span x-show="isLoading" class="spinner-border text-mtv-text-gray" role="status" aria-hidden="true"></span>        
    </div>    
</div>