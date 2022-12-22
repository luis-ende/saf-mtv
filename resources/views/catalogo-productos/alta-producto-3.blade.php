<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => '',                        
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 3 de 4'])
            <div class="px-6">
                <div class="mx-auto flex flex-col w-1/2">   
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        Guarda tus fotografías
                    </label>     
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Hasta 3 imágenes de tu producto en formato jpg o png y de hasta 1 MB cada una.
                    </label> 
                    <x-producto-files-upload
                        :producto_id="1"
                    />                       
                    {{-- <button type="submit" 
                            class="mtv-button-secondary self-center my-4">
                            Siguiente
                    </button> --}}
                </div>                                
            </div>
        </div>
    </div>
</x-registro-layout>
