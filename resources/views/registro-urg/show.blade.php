<x-app-layout :show_main_menu="false" :with_background_color="true" :show_menu_bar="false">
    @section('page_title', 'Registro Mi Tiendita Virtual')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro-proveedor.registro-header',
                       ['titulo' => 'Registro a Mi Tiendita Virtual',
                        'subtitulo' => 'Crea una cuenta para tener acceso a funcionalidades del sitio diseñadas sólo para Unidades Responsables de Gasto.'])
            <div class="px-4 md:px-6 md:max-w-lg mx-auto">
                <form action="{{ route('registro-urg.store') }}" method="POST" class="flex flex-col">
                    @csrf
                    <div class="md:w-1/2 basis-full">
                        <x-rfc-validacion-input
                                tipo_persona="{{ App\Models\Persona::TIPO_PERSONA_FISICA_ID }}"
                                id="rfc"
                                name="rfc"
                                modo="registro"
                                value="{{ old('rfc') }}" />
                        <x-input-error :messages="$errors->get('rfc')" class="mt-2"/>
                    </div>

                    <div class="basis-full">
                        <div class="mtv-input-wrapper basis-full md:basis-1/2">
                            <input type="text" class="mtv-text-input" id="nombre" name="nombre"
                                   value="{{ old('nombre') }}"
                                   required
                            >
                            <label class="mtv-input-label" for="nombre">Nombre completo</label>
                        </div>
                    </div>

                    <div class="basis-full">
                        <div class="mtv-input-wrapper basis-full md:basis-1/2">
                            <select id="id_urg" name="id_urg" class="mtv-text-input" required>
                                <option value="">Selecciona URG</option>
                                @foreach($unidades_compradoras as $uc)
                                    <option class="uppercase" value="{{ $uc->id }}" @selected($uc->id == old('id_urg'))>
                                        {{ $uc->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="mtv-input-label" for="id_urg">Unidad Responsable de Gasto</label>
                        </div>
                    </div>

                    <div class="basis-full flex flex-col md:flex-row flex-nowrap space-x-0 md:space-x-7">
                        <div class="basis-full md:basis-1/2">
                            <x-email-input
                                    id="email"
                                    name="email"
                                    label="Correo electrónico"
                                    label_id="email"
                                    required
                                    value="{{ old('email') }}"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                        <div class="basis-full md:basis-1/2">
                            <x-email-input
                                    id="email_confirmacion"
                                    name="email_confirmacion"
                                    label="Confirma correo electrónico"
                                    label_id="email_confirmacion"
                                    required
                                    value="{{ old('email_confirmacion') }}"
                            />
                            <x-input-error :messages="$errors->get('email_confirmacion')" class="mt-2"/>
                        </div>
                    </div>

                    <div class="basis-full flex flex-col md:flex-row flex-nowrap space-x-0 md:space-x-7">
                        <div class="basis-full md:basis-1/2">
                            <x-password-input
                                    id="password"
                                    name="password"
                                    label_id="password"
                                    label="Contraseña"
                                    show_validations="true"
                                    required
                            />
                        </div>
                        <div class="basis-full md:basis-1/2">
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
                    <div class="flex flex-col justify-center mt-3">
                        @include('registro-proveedor/terminos-leyenda')
                    </div>
                    <div class="flex flex-col justify-center">
                        <button type="submit" class="mtv-button-secondary w-32 self-center my-4">Crear cuenta</button>
                    </div>
                </form>
                <div class="basis-full mt-24 mb-5 flex flex-col">
                    @include('registro-urg/registro-urg-footer')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
