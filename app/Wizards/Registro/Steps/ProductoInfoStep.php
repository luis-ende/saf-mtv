<?php

namespace App\Wizards\Registro\Steps;

use Arcanist\Field;
use Arcanist\WizardStep;
use Illuminate\Http\Request;

class ProductoInfoStep extends WizardStep
{
    public string $title = 'Ofrece tus productos (opcional)';

    public string $slug = 'catalogo-productos';

    public function viewData(Request $request): array
    {
        return $this->withFormData();
    }

    public function fields(): array
    {
        return [
            Field::make('nombre_producto'),
            Field::make('clave_cabms'),
            Field::make('descripcion_producto'),
            Field::make('tipo_producto'),
            Field::make('categoria_producto'),
            Field::make('subcategoria_producto'),
            Field::make('marca'),
        ];
    }
}