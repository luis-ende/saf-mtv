<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::registerNavigationGroups([
            'Catálogos',
            'Usuarios',
        ]);

        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}
