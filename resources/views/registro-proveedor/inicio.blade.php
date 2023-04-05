<x-app-layout :show_main_menu="false" :with_background_color="true" :show_menu_bar="false">
    @section('page_title', 'Registro Mi Tiendita Virtual')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <div class="bg-white overflow-hidden shadow-sm min-h-screen">
            @include('registro-proveedor.registro-header',
                       ['titulo' => 'Registro a Mi Tiendita Virtual',
                        'subtitulo' => 'Crea una cuenta para realizar tu catálogo de productos y recibir notificaciones personalizadas.'])
            <div class="px-6">
                <div class="w-fit mx-auto flex flex-col" x-data="tipoPersonaData()">
                    <label class="block basis-full text-base md:text-xl font-bold text-mtv-text-gray mt-4 mb-2 self-center">¿Qué tipo de persona eres?</label>
                    <div class="basis-full flex flex-row w-56 self-center"
                         x-data="{ tipoPersona: '{{ \App\Models\Persona::TIPO_PERSONA_FISICA_ID }}' }">
                        <x-tipo-persona-radio
                                tipo_persona="{{ \App\Models\Persona::TIPO_PERSONA_FISICA_ID }}" />
                    </div>
                    <div class="basis-full mt-5 flex flex-col space-y-3">
                        <label class="text-base md:text-xl font-bold text-mtv-primary self-center">Crear cuenta usando:</label>
                        <button type="button"
                                @click="window.location.href = obtieneRutaIdentificacion('{{ \App\Models\RegistroMTV::TIPO_REGISTRO_CERT }}')"
                                class="mtv-button-gray w-48 self-center">
                                e.firma (.cer)
                        </button>
                        <button type="button"
                                @click="window.location.href = obtieneRutaIdentificacion('{{ \App\Models\RegistroMTV::TIPO_REGISTRO_EMAIL }}')"
                                class="mtv-button-gray w-48 self-center">
                                Correo electrónico
                        </button>
                    </div>
                    <div class="basis-full mt-24 mb-5 flex flex-col">
                        @include('registro-proveedor/registro-footer')
                    </div>
                </div>
                <script type="text/javascript">
                    function tipoPersonaData() {
                        return {
                            registroIdentificacionRoute: '/registro-identificacion',

                            obtieneRutaIdentificacion(tipoRegistro) {
                                return this.registroIdentificacionRoute + '/' +
                                    document.querySelector('input[name="tipo_persona"]:checked').value + '/' + tipoRegistro;
                            },
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
