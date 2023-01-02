<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm h-screen">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 3 de 4'])
            @php($productoId = request()->producto)
            <form method="POST" enctype="multipart/form-data"
                  action="{{ route('alta-producto.store', [3, $productoId]) }}"
                  class="px-6">
                @csrf
                <div class="mx-auto flex flex-col w-1/2">
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        Guarda tus fotografías
                    </label>
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Hasta <span class="text-lg font-bold">3</span> imágenes de tu producto en formato jpg o png y de hasta 1 MB cada una.
                    </label>
                    <x-producto-fotos-upload />
                    <div class="flex justify-content-center mt-3">
                        <button type="submit" class="mtv-button-secondary">                                
                            Siguiente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
