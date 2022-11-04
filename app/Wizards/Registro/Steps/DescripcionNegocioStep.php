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
            Field::make('grupo_prioritario'),
            Field::make('lema_negocio')->rules(['required']),
            Field::make('descripcion_negocio')->rules(['required']),
            Field::make('diferenciador'),
            Field::make('sitio_web'),
            Field::make('cuenta_facebook'),
            Field::make('cuenta_twitter'),
            Field::make('cuenta_linkedin'),
            Field::make('num_whatsapp'),
        ];
    }
}
