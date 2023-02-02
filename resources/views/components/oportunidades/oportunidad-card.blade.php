@props(['oportunidad' => null])

<article class="md:mb-0 xs:mb-5 md:hover:shadow-lg rounded-bl-lg rounded-br-lg">
    <div class="h-16 bg-mtv-primary rounded-tl-lg rounded-tr-lg md:p-3 xs:p-2">                
        <span class="text-white md:text-base sm:text-sm uppercase md:font-bold block">
            {{ Str::of($oportunidad->unidad_compradora)->limit(102, '...') }}
        </span>
    </div>
    <div class="flex flex-col">
        @php($procedimientoCerrado = strtolower($oportunidad->estatus_contratacion) === 'cerrado')        
        <div class="h-28 bg-gray-100 border-l border-r block px-3 py-3">
            <span @class([
                'text-mtv-primary' => !$procedimientoCerrado,
                'text-mtv-gray-2' => $procedimientoCerrado, 
                'md:text-base sm:text-sm md:font-semibold'])>
                {{ Str::of($oportunidad->nombre_procedimiento)->limit(142, '...') }}
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
            <hr>
            <p class="my-0">Grandes rubros de gastos: <strong>-</strong></p>
            <p>Rubro de gasto: <strong>-</strong></p>
            <p class="my-0">Tipo de contratación: <strong>{{ $oportunidad->tipo_contratacion }}</strong></p>
            <p>Método de contratación: <strong>{{ $oportunidad->metodo_contratacion }}</strong></p>
            <hr>
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
        <div class="bg-white p-3 border border-l border-r border-b rounded-bl-lg rounded-br-lg flex flex-col justify-center items-center">
            @if(!$procedimientoCerrado)
                <x-oportunidades.oportunidad-alerta-button 
                    :oportunidad="$oportunidad"
                />
            @else
                <div class="my-0 text-white font-bold bg-mtv-gray-light border border-slate-200 rounded-lg px-3 py-2">
                    @svg('codicon-bell-dot', ['class' => 'w-5 h-5 inline-block mr-2'])
                    Activar alerta
                </div>
            @endif
        </div>                
    </div>
</article>
