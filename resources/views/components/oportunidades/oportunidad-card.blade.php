@props(['oportunidad' => null, 'vista' => ''])

<article class="md:mb-0 xs:mb-5 md:hover:shadow-lg rounded-bl-lg rounded-br-lg"
         data-ep="{{ $oportunidad->id_etapa_procedimiento }}"
         data-uc="{{ $oportunidad->id_unidad_compradora }}">
    <div class="h-16 bg-mtv-primary rounded-tl-lg rounded-tr-lg md:p-3 xs:p-2">                
        <span class="text-white md:text-base sm:text-sm uppercase md:font-bold block">
            {{ Str::of($oportunidad->unidad_compradora)->limit(102, '...') }}
        </span>
    </div>
    <div class="flex flex-col">
        @php($procedimientoCerrado = $oportunidad->estatus_contratacion === App\Models\EstatusContratacion::ESTATUS_CONTRATACION_FINALIZADO)        
        <div class="h-28 bg-gray-100 border-l border-r block px-3 py-3">
            <span @class([
                'text-mtv-primary' => !$procedimientoCerrado,
                'text-mtv-gray-2' => $procedimientoCerrado, 
                'md:text-base sm:text-sm md:font-semibold line-clamp-3'])>
                {{ Str::of($oportunidad->nombre_procedimiento)->limit(162, '...') }}
            </span>
        </div>
        <div class="border-l border-r bg-white p-3 block text-mtv-text-gray">
            Estatus:            
            <p @class([
                'text-mtv-secondary' => !$procedimientoCerrado, 
                'text-mtv-gray-2' => $procedimientoCerrado, 
                'font-bold text-xl'])>
                {{ $oportunidad->estatus_contratacion }}
            </p>
            <p class="my-0">Publicación: <strong>{{ Carbon\Carbon::parse($oportunidad->fecha_publicacion)->translatedFormat('d F Y') }}</strong></p>
            @empty($oportunidad->fecha_presentacion_propuestas)
                <br>
            @else
                <p class="my-0">Presentación de propuestas: <strong>{{ Carbon\Carbon::parse($oportunidad->fecha_presentacion_propuestas)->translatedFormat('d F Y') }}</strong></p>                
            @endif                                    
            <div class="border-t border-b mt-3 mb-3">
                <p class="my-0 mt-3">Grandes rubros de gastos: <strong>{{ $oportunidad->capitulo }}</strong></p>
                <p>Rubro de gasto: <strong>{{ $oportunidad->partidas }}</strong></p>
                <p class="my-0">Tipo de contratación: <strong>{{ $oportunidad->tipo_contratacion }}</strong></p>
                <p>Método de contratación: <strong>{{ $oportunidad->metodo_contratacion }}</strong></p>
            </div>            
            <p class="my-0"><strong>Más información:</strong></p>
            <div class="my-2 flex flex-col flex-nowrap justify-center items-center">
                @if($oportunidad->fuente_url)
                    <a href="{{ $oportunidad->fuente_url }}" class="my-0 mtv-button-gold" target="_blank">
                        {{ $oportunidad->etapa_procedimiento }}
                    </a>
                @else                
                    <div class="font-bold text-white bg-mtv-gold rounded-lg py-2 px-3 my-0">
                        {{ $oportunidad->etapa_procedimiento }}
                    </div>
                @endif                
            </div>
        </div>        
        @php($es_opn_sugerida = $oportunidad->oportunidad_sugerida ?? false)
        <div class="bg-white p-3 border border-l border-r border-b rounded-bl-lg rounded-br-lg flex {{ $es_opn_sugerida ? 'flex-row space-x-7' : 'flex-col' }} justify-center items-center">
            <x-oportunidades.oportunidad-bookmarks-button 
                :vista="$vista"
                :oportunidad="$oportunidad"
                :procedimiento_cerrado="$procedimientoCerrado"
            />            
            @if($es_opn_sugerida)                
                <x-oportunidades.sugerido-eliminar-button
                    :oportunidad="$oportunidad"
                 />
            @endif
        </div>                
    </div>
</article>
