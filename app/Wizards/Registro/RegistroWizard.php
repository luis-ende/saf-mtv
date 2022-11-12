<?php

namespace App\Wizards\Registro;

use Arcanist\AbstractWizard;
use Illuminate\Http\Request;
use App\Wizards\Registro\Steps\PerfilNegocioStep;
use App\Wizards\Registro\Steps\DescripcionNegocioStep;
use App\Wizards\Registro\Steps\ProductoInfoStep;

class RegistroWizard extends AbstractWizard
{
    public static string $title = 'Registro Mi Tiendita Virtual';

    public static string $slug = 'registro-mtv';

    public string $onCompleteAction = RegistroAction::class;

    protected array $steps = [
        PerfilNegocioStep::class,
        DescripcionNegocioStep::class,
        ProductoInfoStep::class,
    ];

    public static function middleware(): array
    {
        return [];
    }

    public function sharedData(Request $request): array
    {
        return [];
    }

    protected function redirectTo(): string
    {
        return route('dashboard');
    }
}
