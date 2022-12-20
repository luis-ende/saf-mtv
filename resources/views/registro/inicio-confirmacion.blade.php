<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header',
                       ['titulo' => 'Registro a Mi Tiendita Virtual',
                        'subtitulo' => 'Crea una cuenta para realizar tu catálogo de productos y recibir notificaciones personalizadas.'])
            <div class="px-6">
                <div class="w-fit mx-auto flex flex-col">
                    <label class="text-xl font-bold text-mtv-primary self-center">2. Asigna tu contraseña</label>
                    <form action="{{ route('registro-inicio-confirmacion.store') }}" method="POST" class="flex flex-col">
                        @csrf
                        <input name="tipo_registro" id="persona_datos" type="hidden" value="{{ $tipoRegistro }}">
                        <input name="tipo_persona" id="persona_persona" type="hidden" value="{{ $tipoPersona }}">
                        @if($tipoRegistro === 'E')
                            @if($tipoPersona === 'F')
                                <input name="persona_datos" id="persona_datos_reg_email"
                                    type="hidden" value="">
                            @endif
                            <label class="block basis-full text-xl font-bold text-mtv-text-gray mt-2 mb-2 self-center">¿Qué tipo de persona eres?</label>
                            <div class="basis-full flex flex-row w-56 self-center mb-3" x-data="{ tipoPersona: '{{ $tipoPersona }}' }">
                                <x-tipo-persona-radio :value="$tipoPersona" :disabled="true" />
                            </div>
                            <div class="w-fit basis-full flex flex-row flex-nowrap space-x-7">
                                @if($tipoPersona === 'F')
                                    <div class="w-48 sm:basis-full basis-1/2">
                                        <x-curp-input value="" required />
                                        <x-input-error :messages="$errors->get('curp')" class="mt-2"/>
                                    </div>
                                @endif
                                    <div class="w-48 sm:basis-full basis-1/2">
                                        <x-rfc-validacion-input value="" :modo="__('registro')" />
                                        <x-input-error :messages="$errors->get('rfc')" class="mt-2"/>
                                    </div>
                                @if($tipoPersona === 'M')
                                    <div class="mtv-input-wrapper w-48 sm:basis-full basis-1/2">
                                        <input type="date" class="mtv-text-input" id="fecha_constitucion" name="fecha_constitucion"
                                               value=""
                                               required
                                        >
                                        <label class="mtv-input-label" for="fecha_constitucion">Fecha de constitución</label>
                                    </div>
                                @endif
                            </div>
                            @if($tipoPersona === 'M')
                                <div class="w-full basis-full flex flex-row">
                                    <div class="mtv-input-wrapper w-full">
                                        <input type="text" class="mtv-text-input" id="razon_social" name="razon_social"
                                               value=""
                                               required
                                        >
                                        <label class="mtv-input-label" for="razon_social">Razón social</label>
                                    </div>
                                </div>
                            @endif
                            <div class="w-fit basis-full flex flex-row flex-nowrap space-x-7">
                                <div class="w-48 sm:basis-full basis-1/2">
                                    <x-email-input
                                        id="email"
                                        name="email"
                                        label="Correo electrónico"
                                        label_id="email"
                                        required
                                    />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                </div>
                                <div class="w-48 sm:basis-full basis-1/2">
                                    <x-email-input
                                        id="email_confirmacion"
                                        name="email_confirmacion"
                                        label="Confirma correo electrónico"
                                        label_id="email_confirmacion"
                                        required
                                    />
                                    <x-input-error :messages="$errors->get('email_confirmacion')" class="mt-2"/>
                                </div>
                            </div>
                        @elseif($tipoRegistro === 'C')
                            <input name="persona_datos" id="persona_datos_reg_cert"
                                   type="hidden" value="{{ json_encode($personaDatos) }}">
                            @if($tipoPersona === 'F')
                                <ul class="my-3 uppercase text-mtv-text-gray list-outside p-0 ml-16">
                                    <li>Nombre: <strong>{{ $personaDatos['nombre_completo'] }}</strong></li>
                                    <li>CURP: <strong>{{ $personaDatos['curp'] }}</strong></li>
                                    <li>RFC: <strong>{{ $personaDatos['rfc'] }}</strong></li>
                                    <li>Correo electrónico: <strong>{{ $personaDatos['email'] }}</strong></li>
                                </ul>
                            @elseif($tipoPersona === 'M')
                                <ul class="my-3 uppercase text-mtv-text-gray mx-auto list-outside p-0 ml-16">
                                    <li>Razón social: <strong>{{ $personaDatos['razon_social'] }}</strong></li>
                                    <li>Fecha constitución: <strong>{{ $personaDatos['fecha_constitucion'] }}</strong></li>
                                    <li>RFC: <strong>{{ $personaDatos['rfc'] }}</strong></li>
                                    <li>Correo electrónico: <strong>{{ $personaDatos['email'] }}</strong></li>
                                </ul>
                            @endif
                        @endif
                        <div class="w-fit basis-full flex flex-row flex-nowrap space-x-7">
                            <div class="w-48 sm:basis-full basis-1/2">
                                <x-password-input
                                    id="password"
                                    name="password"
                                    label_id="password"
                                    label="Contraseña"
                                    show_validations="true"
                                    required
                                />
                            </div>
                            <div class="w-48 sm:basis-full basis-1/2">
                                <div class="mtv-input-wrapper">
                                    <x-password-input
                                        id="password_confirmacion"
                                        name="password_confirmacion"
                                        label_id="password_confirmacion"
                                        label="Confirma tu contraseña"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-96 justify-center mt-3">
                            @include('registro/terminos-leyenda')
                        </div>
                        <div class="flex flex-col w-96 justify-center">
                            <button type="submit" class="mtv-button-secondary w-32 self-center my-4">Crear cuenta</button>
                        </div>
                    </form>
                    <div class="basis-full mt-24 mb-5 flex flex-col">
                        @include('registro/registro-footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-registro-layout>
