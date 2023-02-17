@props(['oportunidades' => []])

<div x-data="infiniteScrolling"
     {{-- initInfiniteScrolling(paginationOffset, numRecords, filtros, ) --}}
     x-init="initInfiniteScrolling(@js($pagination_offset), @js(count($oportunidades)), @js(@$filtros), '{{ $buscador_items_route }}')">

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
                @click="retrieveData(); $data.calculaEstadisticas()"
        >Ver más resultados</button>
        <span x-show="isLoading" class="spinner-border text-mtv-text-gray" role="status" aria-hidden="true"></span>        
    </div>    
</div>