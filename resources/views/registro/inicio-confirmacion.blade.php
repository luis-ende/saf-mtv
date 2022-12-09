<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header', 
                       ['titulo' => 'Registro a Mi Tiendita Virtual', 
                        'subtitulo' => 'Crea una cuenta para realizar tu catálogo de productos y recibir notificaciones personalizadas.'])
            <div class="px-6">
                <div class="w-fit mx-auto flex flex-col">
                    <label class="block basis-full text-2xl font-bold text-mtv-text-gray mt-4 mb-2 self-center">¿Qué tipo de persona eres?</label>
                    <div class="basis-full flex flex-row w-64 self-center mb-3" x-data="{ tipoPersona: 'F' }">
                        <x-tipo-persona-radio />
                    </div>
                    <div class="w-fit basis-full flex flex-row flex-nowrap space-x-7">
                        <div class="w-48 sm:basis-full basis-1/2">
                            <x-curp-input value="" required />
                            <x-input-error :messages="$errors->get('curp')" class="mt-2"/>
                        </div>
                        <div class="w-48 sm:basis-full basis-1/2">
                            <x-rfc-validacion-input value="" />
                            <x-input-error :messages="$errors->get('rfc')" class="mt-2"/>
                        </div>
                    </div>
                    <div class="w-fit basis-full flex flex-row flex-nowrap space-x-7">
                        <div class="w-48 sm:basis-full basis-1/2">
                            <x-email-input
                                id="email"
                                name="email"
                                label="Correo electrónico"
                                label_id="email"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                        <div class="w-48 sm:basis-full basis-1/2">
                            <x-email-input
                                id="email_confirmacion"
                                name="email_confirmacion"
                                label="Confirma correo electrónico"
                                label_id="email_confirmacion"
                            />
                            <x-input-error :messages="$errors->get('email_confirmacion')" class="mt-2"/>
                        </div>
                    </div>
                    <div class="w-fit basis-full flex flex-row flex-nowrap space-x-7">
                        <div class="w-48 sm:basis-full basis-1/2">
                            <x-password-input
                                id="password"
                                name="password"
                                label_id="password"
                                label="Contraseña"
                                show_validations="true"
                            />
                        </div>
                        <div class="w-48 sm:basis-full basis-1/2">
                            <div class="mtv-input-wrapper">
                                <x-password-input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    label_id="password_confirmation"
                                    label="Confirma tu contraseña"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-96 justify-center mt-3">
                        @include('registro/terminos-leyenda-2')
                    </div>
                    <div class="flex flex-col w-96 justify-center">
                        <button class="mtv-button-secondary w-32 self-center my-4">Crear cuenta</button>
                    </div>
                    <div class="basis-full mt-24 mb-5 flex flex-col">
                        @include('registro/registro-footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-registro-layout>
