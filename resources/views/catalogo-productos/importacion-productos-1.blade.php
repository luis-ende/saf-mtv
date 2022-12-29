<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Carga masiva de productos',
                        'titulo_icono' => 'adjuntar_xls',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 1 de 2'])
            <div class="px-6">
                <div class="mx-auto flex flex-col w-1/2">
                    <a href="#"
                       class="mtv-button-secondary-white text-lg no-underline self-center my-4">
                        @svg('vaadin-file-table', ['class' => 'w-5 h-5 inline-block text-mtv-secondary'])
                        Descarga la plantilla
                    </a>
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        1. Selecciona el archivo
                    </label>
                    <label class="text-mtv-gray text-base mb-3 self-center">
                       Adjunta la plantilla en extensión .csv.
                    </label>
                    <x-input-upload
                        :name="__('productos_import_file')"
                        :id="__('productos_import_file')"
                    />
                    <button type="submit"
                            class="mtv-button-secondary self-center my-4">
                        Procesar
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
