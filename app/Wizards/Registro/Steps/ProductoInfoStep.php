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
            Field::make('clave_cabms')->rules(['required']),
            Field::make('nombre_producto')->rules(['required']),
            Field::make('descripcion_producto')->rules(['required']),
            Field::make('precio')->rules(['required']),
            Field::make('marca'),
            Field::make('modelo'),
            Field::make('color'),
            Field::make('material'),
        ];
    }
}
