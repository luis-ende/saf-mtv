<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header',
                       ['titulo' => 'Registro a Mi Tiendita Virtual',
                        'subtitulo' => 'Crea una cuenta para realizar tu catálogo de productos y recibir notificaciones personalizadas.'])
            <div class="px-6">
                <div class="w-fit mx-auto flex flex-col">
                    <div class="basis-full mt-3 flex flex-col space-y-3">
                        <label class="text-xl font-bold text-mtv-primary self-center">1. Selecciona tu certificado</label>
                        <form
                            action="{{ route('registro-inicio-identificacion.store') }}" method="POST"
                            enctype="multipart/form-data"
                            class="self-center w-75 flex flex-col"
                            x-data="{ archivoCert: null }"
                        >
                            @csrf
                            <input type="hidden" id="tipo_persona" name="tipo_persona" value="{{ $tipoPersona }}">
                            <div class="border rounded flex flex-col space-y-2 pb-4">
                                <label class="text-mtv-text-gray font-bold self-center my-3">Archivo .cer</label>
                                <div class="px-5 m-0">
                                    <x-certificado-file-upload />
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="mtv-button-secondary w-1/4 self-center my-4"
                                x-show="archivoCert"
                            >
                                Utilizar
                            </button>
                        </form>
                    </div>
                    <div class="basis-full mt-24 mb-5 flex flex-col">
                        @include('registro/registro-footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-registro-layout>
