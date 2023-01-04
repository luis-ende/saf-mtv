<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Agrega tu producto',
                        'titulo_icono' => 'polaris-major-add-product',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 1 de 4'])
            <form method="POST" action="{{ route('alta-producto.store', [1]) }}" class="px-6">
                @csrf
                <div class="w-fit mx-auto flex flex-col"
                     {{-- Buscar inicialización de esta función reutilizable 'busquedaCABMS()' en resources/js/app.js --}}
                     x-data="busquedaCABMS"
                     x-init="$watch('tipoProducto', value => cabmsChoices.clearChoices()); initBusquedaCABMS()">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-4 mb-2 self-center">
                        Identifica tu Bien o Servicio
                    </label>
                    <div class="basis-full flex flex-row w-56 self-center my-5">
                        <x-tipo-producto-radio
                            :tipo_producto="__('B')" />
                    </div>
                    <label class="text-mtv-gray text-lg mb-3">
                        Busca y selecciona la categoría y nombre de tu producto o servicio
                    </label>
                    <x-cabms-categorias-select
                        :modo="__('producto_registro')"
                    />
                    <button type="submit"
                            class="mtv-button-secondary self-center my-10 mb-20">
                            Siguiente
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
