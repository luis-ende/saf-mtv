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
                    <div class="w-fit basis-full flex flex-row flex-nowrap space-x-1">
                        <div class="w-48 sm:basis-full basis-1/2">                    
                            <div class="mtv-input-wrapper">
                                <x-text-input id="password" class="block w-full"
                                            type="password"
                                            name="password"
                                            autocomplete="new-password"                                                
                                />
                                <label class="mtv-input-label" for="password">Contraseña</label>
                            </div>    
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>        
                        <div class="w-48 sm:basis-full basis-1/2">                    
                            <div class="mtv-input-wrapper">                    
                                <x-text-input id="password_confirmation" class="block w-full"
                                            type="password"
                                            name="password_confirmation"                                                
                                />
                                <label class="mtv-input-label" for="password_confirmation">Confirmar contraseña</label>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>                        
                    </div>                
                    <div class="flex flex-col w-96 justify-center">
                        @include('registro/terminos-leyenda-2')
                    </div>
                    <div class="basis-full mt-24 mb-5 flex flex-col">
                        @include('registro/registro-footer')
                    </div>    
                </div>                                
            </div>
        </div>
    </div>
</x-registro-layout>