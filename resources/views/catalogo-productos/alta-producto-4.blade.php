<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 4 de 4'])
            <div class="px-6">
                <div class="mx-auto flex flex-col w-1/2">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        Adjuntar documentos
                    </label>
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        1. Ficha técnica de tu producto
                    </label>
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Adjunta tu documento en formato PDF de hasta 3MB.
                    </label>
                    <x-input-upload
                        :name="__('ficha_tecnica_file')"
                        :id="__('ficha_tecnica_file')"
                     />
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        2. Ficha técnica de tu producto
                    </label>
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Por ejemplo: certificados , manual de uso, entre otros.
                    </label>
                    <x-input-upload
                        :name="__('certificado_file')"
                        :id="__('certificado_file')"
                     />
                    <button type="submit"
                            class="mtv-button-secondary self-center my-4">
                            Finalizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
