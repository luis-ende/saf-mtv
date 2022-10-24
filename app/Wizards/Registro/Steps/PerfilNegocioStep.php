<?php

namespace App\Wizards\Registro\Steps;

use Arcanist\Field;
use Arcanist\WizardStep;
use Illuminate\Http\Request;

class PerfilNegocioStep extends WizardStep
{
    public string $title = 'Perfil de tu Negocio';

    public string $slug = 'perfil-negocio';

    public function viewData(Request $request): array
    {
        return $this->withFormData();
    }

    public function fields(): array
    {
        return [
            Field::make('rfc'),
            Field::make('nombre'),
            Field::make('direccion'),
            Field::make('contacto'),
            Field::make('telefono'),
            Field::make('correo_electronico'),
        ];
    }
}