<x-app-layout>
    <div class="bg-white overflow-hidden min-h-screen 2xl:px-32 xl:px-32 lg:px-16 md:px-8 sm:px-4 xs:px-4 py-4">
        @role('proveedor')
            @include('escritorio/escritorio-proveedor')
        @else
            <div class="p-6 bg-white border-b border-gray-200">
                ¡Bienvenido(a) <strong>{{ Auth::user()->nombreUsuario() }}</strong>!
            </div>
            <div class="p-6">
            </div>
        @endrole
    </div>
</x-app-layout>
