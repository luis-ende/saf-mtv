<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Agrega tu producto',
                        'titulo_icono' => 'polaris-major-add-product',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 1 de 4'])
            <form class="px-6">
                <div class="w-fit mx-auto flex flex-col">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-4 mb-2 self-center">
                        Identifica tu Bien o Servicio
                    </label>
                    <div class="basis-full flex flex-row w-56 self-center my-5" x-data="{ tipoProducto: 'B' }">
                        <x-tipo-producto-radio 
                            :tipo_producto="__('B')" />
                    </div>
                    <label class="text-mtv-gray text-lg mb-3">
                        Busca y selecciona la categoría y nombre de tu producto o servicio
                    </label>
                    <div class="mtv-input-wrapper w-3/4 mx-auto">
                        <select class="mtv-text-input"
                                id="id_categoria_scian" name="id_categoria_scian">
                        </select>
                        <label class="mtv-input-label" for="id_categoria_scian">Categoría</label>
                    </div>
                    <div class="mtv-input-wrapper w-3/4 mx-auto">
                        <select class="mtv-text-input"
                                id="id_cabms" name="id_cabms">
                        </select>
                        <label class="mtv-input-label" for="id_cabms">Nombre</label>
                    </div>
                    <button type="submit" 
                            class="mtv-button-secondary self-center my-4">
                            Siguiente
                    </button>
                </div>                                
            </form>
        </div>
    </div>
</x-registro-layout>
