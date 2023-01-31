@props(['oportunidad' => null])

<article class="md:mb-0 xs:mb-5 md:hover:shadow-lg rounded-bl-lg rounded-br-lg">
    <div class="h-16 bg-mtv-primary rounded-tl-lg rounded-tr-lg md:p-3 xs:p-2">                
        <span class="text-white md:text-base sm:text-sm uppercase md:font-bold block">
            {{ Str::of($oportunidad->unidad_compradora)->limit(102, '...') }}
        </span>
    </div>
    <div class="flex flex-col">
        @php($texto = Str::of('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. printing and typesetting industry.')->limit(162, '...'))
        <div class="h-28 bg-gray-100 border-l border-r block px-3 py-3">
            <span class="text-mtv-primary md:text-base sm:text-sm md:font-semibold">
                {{ Str::of($oportunidad->nombre_procedimiento)->limit(142, '...') }}
            </span>
        </div>
        <div class="border-l border-r bg-white p-3 block text-mtv-text-gray">
            Procedimiento:
            <p class="text-mtv-secondary font-bold text-xl">{{ $oportunidad->estatus_contratacion }}</p>
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
                <a href="#" class="my-0 mtv-button-gold">{{ $oportunidad->etapa_procedimiento }}</a>
            </div>
        </div>
        <div class="bg-white p-3 border border-l border-r border-b rounded-bl-lg rounded-br-lg flex flex-col justify-center items-center">
            <button class="my-0 mtv-button-secondary" type="button">
                @svg('codicon-bell-dot', ['class' => 'w-5 h-5 inline-block mr-2'])
                Activar alerta
            </button>
        </div>        
    </div>
</article>