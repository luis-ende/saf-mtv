@props(['show_main_menu' => true])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Mi Tiendita Virtual CDMX</title>
        <link rel="shortcut icon" href="{{ asset('images/tianguis.png') }}">

        <style>
            [x-cloak] { display: none !important; }
        </style>

        @googlefonts

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <header class="bg-white">
            @auth
                @include('layouts.navigation', ['show_main_menu' => $show_main_menu])
            @endauth

            @guest
                @include('layouts.navigation-guest')
            @endguest
        </header>

        <div class="bg-gray-100">
        <div class="min-h-screen">
            <!-- Page Content -->
            <main>
                @include('layouts.alert-notification')
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <!-- <x-site-footer /> -->
        </div>

        @yield('scripts')
    </body>
</html>
