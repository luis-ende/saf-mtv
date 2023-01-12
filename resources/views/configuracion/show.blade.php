<x-app-layout>    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden">            
            <div class="border-b border-gray-200">
                <x-page-header-label title="Configuración" />
            </div>
                
            <form action="{{ route('usuario-configuracion.update') }}" method="POST" class="px-10 py-3 flex flex-column space-y-4">
                @csrf                

                <label class="text-lg text-mtv-gray font-bold">Cambiar credenciales de ingreso</label>                
                <div class="border rounded px-4 pb-3 grid grid-cols-2 gap-3 md:w-2/3 xs:w-full">
                    <div class="col-span-1">
                        <x-email-input
                            id="email"
                            name="email"
                            label="Correo electrónico"
                            label_id="email"    
                            value="{{ $email }}"                        
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>
                    <div class="col-span-1">
                        <x-email-input
                            id="email_confirmacion"
                            name="email_confirmacion"
                            label="Confirma correo electrónico"
                            label_id="email_confirmacion"
                        />
                        <x-input-error :messages="$errors->get('email_confirmacion')" class="mt-2"/>
                    </div>
                </div>    
                <div class="border rounded px-4 pb-3 grid grid-cols-2 gap-3 md:w-2/3 xs:w-full">
                    <div class="col-span-1">
                        <x-password-input
                            id="password_actual"
                            name="password_actual"
                            label_id="password_actual"
                            label="Contraseña actual"                            
                        />
                    </div>                  
                    <div class="col-span-1">
                    </div>  
                    <div class="col-span-1">
                        <x-password-input
                            id="password"
                            name="password"
                            label_id="password"
                            label="Nueva contraseña"
                            show_validations="true"
                        />
                    </div>
                    <div class="col-span-1">
                        <div class="mtv-input-wrapper">
                            <x-password-input
                                id="password_confirmacion"
                                name="password_confirmacion"
                                label_id="password_confirmacion"
                                label="Confirma tu contraseña"
                            />
                        </div>
                    </div>                                 
                </div>   
                <div class="flex flex-row justify-end md:w-2/3 xs:w-full">
                    <button type="submit" class="mtv-button-secondary self-end my-4">Guardar</button>
                </div>                
            </form>
        </div>
    </div>
</x-app-layout>