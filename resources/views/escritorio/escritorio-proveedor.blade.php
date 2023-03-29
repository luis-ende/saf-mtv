<div class="w-full md:w-2/3">
    <span class="block text-mtv-primary font-bold md:text-3xl text-lg text-center">
        Bienvenido a tu Escritorio virtual
    </span>
    <span class="block text-mtv-gray-2 text-sm md:text-base text-center">
        Última conexión: miércoles, 25 marzo 2023
    </span>
</div>

<div class="flex flex-col space-y-3 md:space-y-0 md:flex-row justify-items-center">
    <div class="basis-full md:basis-7/12 relative">
        <div class="md:absolute w-full h-full flex justify-center items-center flex flex-col 2xl:mt-2 lg:mt-2 md:mt-0 md:bg-transparent bg-mtv-gold-light rounded-xl py-4 md:py-0 mt-2">
            <span class="text-mtv-primary font-bold 2xl:text-5xl xl:text-4xl lg:text-3xl md:text-2xl text-xl 2xl:mb-3 xl:mb-2 lg:mb-1 md:mb-0">
                ¿Qué vamos a hacer hoy?
            </span>
            <a href="#"
               class="mtv-link-gold font-bold 2xl:text-3xl xl:text-2xl lg:text-xl md:text-base text-sm bg-transparent">
                Busquemos Oportunidades de negocio
            </a>
        </div>
        <img class="hidden md:block" src="{{ asset("images/banner_principal.svg") }}" alt="Escritorio de proveedor" />
    </div>
    <div class="basis-full md:basis-5/12">
        <div class="h-full md:px-8 md:pt-[5%]">
            <div class="h-full flex flex-row bg-mtv-secondary md:rounded-3xl rounded-xl md:py-0 py-2">
                <div class="basis-1/2">
                    {{--Imagen--}}
                </div>
                <div class="basis-1/2 flex justify-center items-center">
                    <div class="text-white 2xl:text-3xl xl:text-2xl lg:text-lg md:text-base text-base px-5 max-h-48">
                        <span class="block text-center">Conoce</span>
                        <span class="block font-bold text-center">Contratos Marco</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="md:hidden flex flex-row items-center justify-center justify-content-around">
    <button type="button" class="mtv-button-secondary">
        @svg('clarity-bullseye-line', ['class' => 'inline-block w-5 h-5 mr-2'])
        Objetivos
    </button>
    <button type="button" class="mtv-button-primary">
        @svg('uni-comment-exclamation-o', ['class' => 'inline-block w-5 h-5 mr-2'])
        Mensajes
    </button>
</div>

{{--Datos de prueba--}}
@php
    $objetivos = [
        [ 'id' => 1, 'objetivo' => 'Crear Perfil de negocio', 'completo' => true ],
        [ 'id' => 2, 'objetivo' => 'Crear Tu Tiendita Virtual', 'completo' => true ],
        [ 'id' => 3, 'objetivo' => 'Buscar oportunidades de negocio', 'completo' => false ],
    ];

    $mensajes = [
        [
            'id' => 1,
            'nombre_urg' => 'Secretaría de Administración y Finanzas',
            'asunto' => 'Solicitud de información',
            'fecha' => '23 marzo 2023',
            'hora' => '10:05',
        ],
        [
            'id' => 2,
            'nombre_urg' => 'Agencia Digital de Innovación Pública',
            'asunto' => 'Cotización',
            'fecha' => '20 marzo 2023',
            'hora' => '10:05',
        ],
    ]
@endphp

<div class="flex flex-row my-10">
    {{-- Sección Objetivos --}}
    <div class="hidden md:inline-flex basis-1/4 flex flex-col space-y-10 md:pr-2">
        <x-escritorio-proveedor.objetivos-seccion
                :objetivos="$objetivos"
        />
    </div>
    {{-- Sección Acciones --}}
    <div class="basis-full md:basis-2/4 2xl:px-16 xl:px-12 md:px-2 md:border-r-2 md:border-dashed md:border-r-mtv-gray-light md:border-l-2 md:border-l-mtv-gray-light">
        <div class="grid grid-cols-2 grid-rows-4 2xl:gap-x-16 xl:gap-x-12 md:gap-x-2 gap-x-2 gap-y-10">
            <div class="md:text-lg sm:text-sm text-xs">
                <span class="block text-mtv-secondary text-3xl font-bold text-center">93</span>
                <span class="block text-center text-mtv-text-gray">Instituciones compradoras</span>
            </div>
            <div class="md:text-lg sm:text-sm text-xs">
                <span class="block text-mtv-secondary text-3xl font-bold text-center">5,640</span>
                <span class="block text-center text-mtv-text-gray">Procedimientos programados</span>
                <a href="#" class="block mtv-link-gold text-center">Ver todos los procedimientos</a>
            </div>
            <div class="flex flex-row rounded-xl border border-mtv-gray-light md:hover:shadow-lg px-2 flex flex-row items-center">
                @svg('01_Perfil', ['class' => 'md:w-12 md:h-12 w-10 h-10 basis-1/3'])
                <div class="basis-2/3 flex flex-col justify-center items-center md:text-base text-xs">
                    <span class="font-bold text-mtv-gold text-center w-24 md:h-12 h-10">Mi Perfil de negocio</span>
                    <a class="mtv-link-gold" href="#">Editar</a>
                </div>
            </div>
            <div class="flex flex-row rounded-xl border border-mtv-gray-light px-2 flex flex-row items-center">
                @svg('02_Cotizaciones', ['class' => 'md:w-12 md:h-12 w-10 h-10 basis-1/3'])
                <div class="basis-2/3 flex flex-col justify-center items-center md:text-base text-xs">
                    <span class="font-bold text-mtv-gold text-center w-24 md:h-12 h-10">Cotizaciones solicitadas</span>
                    <span class="text-mtv-text-gray text-lg">4</span>
                </div>
            </div>
            <div class="flex flex-row rounded-xl border border-mtv-gray-light md:hover:shadow-lg px-2 flex flex-row items-center">
                @svg('03_Productos', ['class' => 'md:w-12 md:h-12 w-10 h-10 basis-1/3'])
                <div class="basis-2/3 flex flex-col justify-center items-center md:text-base text-xs">
                    <span class="font-bold text-mtv-gold text-center w-24 md:h-12 h-10">Productos</span>
                    <span class="text-mtv-text-gray text-lg">12</span>
                </div>
            </div>
            <div class="flex flex-row rounded-xl border border-mtv-gray-light px-2 flex flex-row items-center">
                @svg('04_Megusta', ['class' => 'md:w-12 md:h-12 w-10 h-10 basis-1/3'])
                <div class="basis-2/3 flex flex-col justify-center items-center md:text-base text-xs">
                    <span class="font-bold text-mtv-gold text-center md:w-36 w-28 md:h-12 h-10">Usuarios siguiendo tus productos</span>
                    <span class="text-mtv-text-gray text-lg">20</span>
                </div>
            </div>
            <div class="flex flex-row rounded-xl border border-mtv-gray-light md:hover:shadow-lg px-2 flex flex-row items-center">
                @svg('05_Sugeridas', ['class' => 'md:w-12 md:h-12 w-10 h-10 basis-1/3'])
                <div class="basis-2/3 flex flex-col justify-center items-center md:text-base text-xs">
                    <span class="font-bold text-mtv-gold text-center w-24 md:h-12 h-10">Oportunidades sugeridas</span>
                    <span class="text-mtv-text-gray text-lg">5</span>
                </div>
            </div>
            <div class="flex flex-row rounded-xl border border-mtv-gray-light md:hover:shadow-lg px-2 flex flex-row items-center">
                @svg('06_Seguidas', ['class' => 'md:w-12 md:h-12 w-10 h-10 basis-1/3'])
                <div class="basis-2/3 flex flex-col justify-center items-center md:text-base text-xs">
                    <span class="font-bold text-mtv-gold text-center w-24 md:h-12 h-10">Oportunidades favoritas</span>
                    <span class="text-mtv-text-gray text-lg">10</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Sección Centro de mensajes --}}
    <div class="hidden md:inline-flex basis-1/4 pl-16 pr-8 min-h-max">
        <x-escritorio-proveedor.mensajes-seccion
                :mensajes="$mensajes"
        />
    </div>
</div>
