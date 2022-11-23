<x-app-layout>
    <div class="row h-[48rem]">
        @if (Route::has('login'))
            @auth
                <div class="col-6">
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Escritorio</a>
                </div>
            @else
                <div class="col-6">
                    @if (Route::has('wizard.registro-mtv.create'))
                        <a class="btn btn-primary m-5" href="{{ route('wizard.registro-mtv.create') }}">Sé parte de Mi Tiendita Virtual</a>
                    @endif
                </div>
            @endauth
        @endif
    </div>
</x-app-layout>
