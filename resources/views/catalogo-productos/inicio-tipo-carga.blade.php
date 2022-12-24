<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Mi Tiendita Virtual',
                        'subtitulo' => 'Ofrece tus productos. Al registrar tu catálogo recibirás notificaciones al realizarse algún procedimiento de compra de acuerdo al perfil de tu negocio, bien o servicio que hayas registrado.'])
            <div class="px-6">
                <div class="w-fit mx-auto flex flex-col" x-data="tipoPersonaData()">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-4 mb-2 self-center">Agrega tus productos</label>
                    <div class="w-fit mx-auto flex flex-col my-10">
                        <label class="text-mtv-gray font-bold">¿Quieres cargar solo un producto o uno por uno?</label>
                        <a href="{{ route('alta-producto-1.show') }}"
                           class="mtv-button-secondary self-center my-4 no-underline">
                            Agrega tu producto
                        </a>
                        <label class="text-mtv-gray font-bold">¿Quieres cargar varios productos a la vez?</label>
                        <a href="#"
                           class="mtv-button-secondary self-center my-4 no-underline">
                            Carga masiva de productos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
