<?php

namespace App\Wizards\Registro\Steps;

use Arcanist\Field;
use Arcanist\WizardStep;
use Illuminate\Http\Request;

class ProductoInfoStep extends WizardStep
{
    public string $title = 'Tu tiendita virtual (opcional)';

    public string $slug = 'catalogo-productos';

    public function viewData(Request $request): array
    {
        return $this->withFormData();
    }

    public function fields(): array
    {
        return [
            Field::make('tipo_producto'),
            Field::make('clave_cabms'),
            Field::make('nombre_producto'),
            Field::make('descripcion_producto'),
            Field::make('precio'),
            Field::make('marca'),
            Field::make('modelo'),
            Field::make('color'),
            Field::make('material'),
        ];
    }
}
