<x-app-layout :show_main_menu="true">
    @section('page_title', 'Registro de productos')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <div class="bg-white overflow-hidden shadow-sm min-h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Mi Tiendita Virtual',
                        'subtitulo' => 'Ofrece tus productos. Al registrar tu catálogo recibirás notificaciones al realizarse algún procedimiento de compra de acuerdo al perfil de tu negocio, bien o servicio que hayas registrado.'])
            <div class="px-6">
                <div class="w-fit mx-auto flex flex-col">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-4 mb-2 self-center">Agrega tus productos</label>
                    <div class="w-fit mx-auto flex flex-col my-10">
                        <label class="text-mtv-gray font-bold self-center">¿Quieres cargar solo un producto o uno por uno?</label>
                        <a href="{{ route('alta-producto-1.show') }}"
                           class="mtv-button-secondary self-center my-4 no-underline">
                           @svg('polaris-major-add-product', ['class' => 'w-5 h-5 inline-block mr-3'])
                           Agrega tu producto
                        </a>
                        <label class="text-mtv-gray font-bold self-center mt-5">¿Quieres cargar varios productos a la vez?</label>
                        <a href="{{ route('importacion-productos-1.show') }}"
                           class="mtv-button-secondary self-center mt-4 no-underline">
                           @svg('tabler-table-import', ['class' => 'w-6 h-6 inline-block mr-3'])
                           Carga masiva de productos
                        </a>
                        <span class="text-mtv-primary text-basis self-center mb-4">
                           @svg('feathericon-alert-circle', ['class' => 'w-5 h-5 inline-block mr-1'])
                           La carga masiva se permite sólo una vez.
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
