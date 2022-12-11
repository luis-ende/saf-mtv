<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-5">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header',
                       ['titulo' => 'Contactos',
                        'subtitulo' => 'La matriz de escalamiento son los datos de contacto de personas clave en tu negocio. Los requerimos para saber a quién dirigirnos.'])
            <div class="px-6">
                <x-contactos-lista
                    :persona="$persona"
                />

                <div class="flex flex-row my-4 space-x-2 justify-end">
                    <a href="{{ route('registro-perfil-negocio') }}" class="mtv-button-secondary-white no-underline self-center">
                        @svg('fas-arrow-left', ['class' => 'h-7 w-7 inline-block mr-3'])
                        Atrás
                    </a>
                    <button type="submit" class="mtv-button-secondary self-center">Finalizar registro</button>
                </div>
            </div>
        </div>
    </div>
</x-registro-layout>
