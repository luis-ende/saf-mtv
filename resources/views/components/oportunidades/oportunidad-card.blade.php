@props(['oportunidad' => null])

<article class="md:mb-0 xs:mb-5 md:hover:shadow-lg rounded-bl-lg rounded-br-lg">
    <div class="h-16 bg-mtv-primary rounded-tl-lg rounded-tr-lg md:p-3 xs:p-2">
        @php($dependencia = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. printing and typesetting industry.')
        @php($texto = Str::of($dependencia)->limit(102, '...'))
        <span class="text-white md:text-base sm:text-sm uppercase md:font-bold block">
            {{ $texto }}
        </span>
    </div>
    <div class="flex flex-col">
        @php($texto = Str::of('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. printing and typesetting industry.')->limit(162, '...'))
        <div class="h-28 bg-gray-100 border-l border-r block px-3 py-3">
            <span class="text-mtv-primary md:text-base sm:text-sm md:font-semibold">
                {{ $texto }}
            </span>
        </div>
        <div class="border-l border-r bg-white p-3 block text-mtv-text-gray">
            Procedimiento:
            <p class="text-mtv-secondary font-bold text-xl">En proceso</p>
            <p>Publicación: <strong>6 febrero 2023</strong></p>
            {{-- <p>Presentación de propuestas: <strong>28 febrero 2023</strong></p> --}}
            <br>
            <hr>
            <p class="my-0">Grandes rubros de gastos: <strong>-</strong></p>
            <p>Rubro de gasto: <strong>-</strong></p>
            <p class="my-0">Tipo de contratación: <strong>Adquisición de servicios</strong></p>
            <p>Método de contratación: <strong>Licitación pública</strong></p>
            <hr>
            <p class="my-0"><strong>Más información:</strong></p>
            <div class="my-2 flex flex-col flex-nowrap justify-center items-center">
                <a href="#" class="my-0 mtv-button-gold">Compra programada</a>
            </div>
        </div>
        <div class="bg-white p-3 block border border-l border-r border-b rounded-bl-lg rounded-br-lg flex flex-col justify-center items-center">
            <button class="my-0 mtv-button-secondary" type="button">
                @svg('codicon-bell-dot', ['class' => 'w-5 h-5 inline-block mr-2'])
                Activar alerta
            </button>
        </div>        
    </div>
</article>
