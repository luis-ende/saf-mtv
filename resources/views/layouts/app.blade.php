@props(['show_main_menu' => true])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mi Tiendita Virtual CDMX</title>
        <link rel="shortcut icon" href="{{ asset('images/tianguis.png') }}">

        @googlefonts

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <header class="bg-white">
            @if (Auth::user())
                @include('layouts.navigation', ['show_main_menu' => $show_main_menu])
            @else
                @include('layouts.navigation-guest')
            @endif
        </header>

        <div class="bg-gray-100">
            <!-- Page Content -->
            <main>                
                <div class="mt-3">
                    @include('layouts.alert-notification')
                </div>
                {{ $slot }}                
            </main>

            <!-- Page Footer -->
            <x-site-footer />
        </div>

        @yield('scripts')
    </body>
</html>
