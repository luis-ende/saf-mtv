<x-app-layout>    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden min-h-screen">
            <div class="p-6 bg-white border-b border-gray-200">
                ¡Bienvenido(a) <strong>{{ Auth::user()->nombreUsuario() }}</strong>!
            </div>
            <div class="p-6">                
            </div>
        </div>
    </div>    
</x-app-layout>
