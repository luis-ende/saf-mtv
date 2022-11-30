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
        <header class="bg-white">
            @include('layouts.navigation-guest')
        </header>

        <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <main>
                <div class="row">
                    @include('layouts.alert-notification')
                </div>
                {{ $slot }}
            </main>
        </div>

        <x-site-footer />
    </body>
</html>
