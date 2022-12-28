<!DOCTYPE html>
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
    <body class="font-sans antialiased bg-white">
        <!-- Page Heading -->
        <header class="bg-white">
            @include('layouts.navigation-guest')
        </header>

        <div class="min-h-screen mt-20">
            <!-- Page Content -->
            <main>
                @include('layouts.alert-notification')
                {{ $slot }}
            </main>
        </div>

        <x-site-footer />
    </body>
</html>
