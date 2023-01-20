<x-registro-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
        <div class="bg-white overflow-hidden shadow-sm">
            @include('registro.registro-header',
                       ['titulo' => 'Contactos',
                        'subtitulo' => 'La matriz de escalamiento son los datos de contacto de personas clave en tu negocio. Los requerimos para saber a quién dirigirnos.'])
            <div class="px-6">
                <form action="{{ route('registro-contactos.store') }}" method="POST">
                    @csrf
                    <x-perfil-negocio.contactos-lista
                        :persona="$persona"
                    />

                    <div class="flex flex-row my-4 space-x-2 justify-end">
                        <a href="{{ route('registro-perfil-negocio.show') }}" class="mtv-button-secondary-white no-underline self-center">
                            @svg('fas-arrow-left', ['class' => 'h-5 w-5 inline-block mr-3'])
                            Atrás
                        </a>
                        <button type="submit" class="mtv-button-secondary self-center">Finalizar registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-registro-layout>
