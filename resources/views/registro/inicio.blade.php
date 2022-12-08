<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header')    
            <div class="px-6">                
                <div class="w-fit mx-auto flex flex-col">
                    <label class="block basis-full text-2xl font-bold text-mtv-text-gray mt-4 mb-2 self-center">¿Qué tipo de persona eres?</label>
                    <div class="basis-full flex flex-row w-64 self-center">                        
                        <div class="basis-1/2 flex flex-row justify-start">
                            <input type="radio"
                                   class="self-center mr-4"
                                   id="tipo_persona_fisica"
                                   name="tipo_persona"
                                   value="F">
                            <label class="font-bold text-lg text-mtv-secondary" for="tipo_persona_fisica">Física</label>
                        </div>
                        <div class="basis-1/2 flex flex-row justify-end">
                            <input type="radio"
                                   class="self-center mr-4"
                                   id="tipo_persona_moral"
                                   name="tipo_persona"
                                   value="M">
                            <label class="font-bold text-lg text-mtv-secondary" for="tipo_persona_moral">Moral</label>       
                        </div>                        
                    </div>    
                    <div class="basis-full mt-5 flex flex-col space-y-3">
                        <label class="text-2xl font-bold text-mtv-primary self-center">Crear cuenta usando:</label>
                        <button type="button" 
                                onclick="window.location.href='{{ route('registro-inicio-certificado-1') }}'" 
                                class="mtv-button-gray">
                                e.firma (.cer)
                        </button>
                        <button type="button" 
                                onclick="window.location.href='{{ route('registro-inicio-certificado-1') }}'" 
                                class="mtv-button-gray">
                                Correo electrónico
                        </button>
                        <div class="flex flex-col">
                            @include('registro/terminos-leyenda-1')
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