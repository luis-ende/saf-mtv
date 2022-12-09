<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header', 
                       ['titulo' => 'Registro a Mi Tiendita Virtual', 
                        'subtitulo' => 'Crea una cuenta para realizar tu catálogo de productos y recibir notificaciones personalizadas.'])
            <div class="px-6">                
                <div class="w-fit mx-auto flex flex-col">
                    <div class="basis-full mt-3 flex flex-col space-y-3">
                        <label class="text-2xl font-bold text-mtv-primary self-center">1. Selecciona tu certificado</label>
                        <div class="border rounded flex flex-col space-y-2">
                            <label class="text-mtv-text-gray font-bold self-center my-3">Archivo .cer</label>                            
                            <div class="px-5">
                                <x-certificado-upload />                                                            
                            </div>                            
                            <div class="flex flex-col mb-3">
                                @include('registro/terminos-leyenda-1')
                            </div>
                        </div>                        
                    </div>                        
                    <div class="basis-full mt-24 mb-5 flex flex-col">
                        @include('registro/registro-footer')
                    </div>                                                
                </div>
            </div>
        </div>
    </div>    
</x-registro-layout>