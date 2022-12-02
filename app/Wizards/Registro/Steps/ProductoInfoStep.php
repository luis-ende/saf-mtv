<?php

namespace App\Wizards\Registro\Steps;

use Arcanist\Field;
use Arcanist\WizardStep;
use Illuminate\Http\Request;

use App\Http\Requests\ProductoRequest;

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
        $productoRequest = (new ProductoRequest())->rules();

        return [
            Field::make('tipo_producto')->rules($productoRequest['tipo_producto']),
            Field::make('clave_cabms')->rules($productoRequest['clave_cabms']),
            Field::make('nombre_producto')->rules($productoRequest['nombre_producto']),
            Field::make('descripcion_producto')->rules($productoRequest['descripcion_producto']),
            Field::make('precio')->rules($productoRequest['precio']),
            Field::make('marca')->rules($productoRequest['marca']),
            Field::make('modelo')->rules($productoRequest['modelo']),
            Field::make('color')->rules($productoRequest['color']),
            Field::make('material')->rules($productoRequest['material']),
        ];
    }
}
