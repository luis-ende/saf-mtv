<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mi Tiendita Virtual CDMX</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="container py-3">
                <div class="row">
                    <div class="col-9">
                        <x-application-logo />
                    </div>
                    @if (Route::has('login'))
                        @auth
{{--                            <div class="col-6">--}}
{{--                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Escritorio</a>--}}
{{--                            </div>--}}
                        @else
                            <div class="col-3">
                                <a class="btn btn-primary" href="{{ route('login') }}">Ingresa</a>
                            </div>
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="container font-sans text-gray-900 antialiased overflow-auto">
            {{ $slot }}
        </div>

        <x-site-footer />
    </body>
</html>
