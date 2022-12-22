<x-app-layout :show_main_menu="false">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('catalogo-productos.registro-header',
                       ['titulo' => 'Carga masiva de productos',                        
                        'subtitulo' => '',
                        'texto_secuencia' => 'Paso 1 de 2'])
            <div class="px-6">
                <div class="mx-auto flex flex-col w-1/2">   
                    <a href="#"
                       class="mtv-button-secondary-white no-underline self-center my-4">
                       Descarga la plantilla
                    </a>
                    <label class="block basis-full text-xl font-bold text-mtv-secondary mt-2 mb-2 self-center">
                        1. Selecciona el archivo 
                    </label>     
                    <label class="text-mtv-gray text-base mb-3 self-center">
                        Adjunta la plantilla en extensión .csv.
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
