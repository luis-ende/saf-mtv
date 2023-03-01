<x-app-layout :show_main_menu="false">
    @section('page_title', 'Alta de producto 4')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-fit">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 4 de 4'])
            @php($productoId = isset($producto) ? $producto->id : null)
            <form method="POST" enctype="multipart/form-data"
                  action="{{ route('alta-producto.store', [4, $productoId]) }}"
                  class="px-6">
                @csrf
                <div class="mx-auto flex flex-col w-1/2">
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
                        2. ¿Quieres subir otro documento?
                    </label>
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Por ejemplo: certificados , manual de uso, entre otros.
                    </label>
                    <x-input-upload
                        :name="__('otro_documento_file')"
                        :id="__('otro_documento_file')"
                        :allow_delete="true"
                     />
                     <div class="flex flex-row my-4 space-x-10 justify-center">
                        <a href="{{ route('alta-producto-3.show', [$productoId]) }}" 
                            class="mtv-button-secondary-white no-underline self-center">
                            @svg('fas-arrow-left', ['class' => 'h-5 w-5 inline-block mr-3'])
                            Atrás
                        </a>
                        <button type="submit"
                                class="mtv-button-secondary self-center my-4">
                                Finalizar
                        </button>
                     </div>    
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
