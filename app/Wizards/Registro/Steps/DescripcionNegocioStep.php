<?php

namespace App\Wizards\Registro\Steps;

use Arcanist\Field;
use Arcanist\WizardStep;
use Illuminate\Http\Request;

class DescripcionNegocioStep extends WizardStep
{
    public string $title = 'Completa la descripción del Perfil de tu Negocio';

    public string $slug = 'descripcion-negocio';

    public function viewData(Request $request): array
    {
        return $this->withFormData();
    }

    public function fields(): array
    {
        return [
            Field::make('lema_negocio'),
            Field::make('descripcion_negocio'),
            Field::make('diferenciador'),
            Field::make('sitio_web'),
        ];
    }
}