@props(['show_main_menu' => true, 'with_background_color' => true, 'show_menu_bar' => true])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mi Tiendita Virtual CDMX - @yield('page_title')</title>
    <link rel="shortcut icon" href="{{ asset('images/tianguis.png') }}">

    <style>
    [x-cloak] {
        display: none !important;
    }
    </style>

    @googlefonts

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white">
    <header class="bg-white">
        @include('layouts.navigation', [
                                            'show_main_menu' => $show_main_menu ?? true,
                                            'show_menu_bar' => $show_menu_bar ?? true,
                                        ])
    </header>

    {{-- Fondo necesario para algunas vistas --}}
    @if($with_background_color)
    <div class="bg-gray-100">
    @endif
        <div class="min-h-screen">
            <!-- Page Content -->
            <main>
                @include('layouts.alert-notification')
                {{ $slot }}
            </main>
        </div>
    @if($with_background_color)
    </div>
    @endif

    <!-- Page Footer -->
    <x-site-footer />

    @stack('scripts')
</body>

</html>