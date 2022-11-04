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
        // TODO: Crear tabla con tipos de vialidad para devolver
        return $this->withFormData([
            'tipos_vialidad' => [ 'Calle', 'Avenida', 'Boulevard', ],
        ]);
    }

    public function fields(): array
    {
        return [
            Field::make('tipo_persona')->rules(['required']),
            Field::make('rfc')->rules(['required', 'min:10', 'max:13', 'unique:users']),
            Field::make('password')->rules(['required']),
            Field::make('curp'),
            Field::make('fecha_nacimiento'),
            Field::make('genero'),
            Field::make('nombre'),
            Field::make('primer_ap'),
            Field::make('segundo_ap'),
            Field::make('fecha_constitucion'),
            Field::make('razon_social'),
            Field::make('id_asentamiento'),
            Field::make('id_tipo_vialidad'),
            Field::make('vialidad')->rules(['required']),
            Field::make('num_ext')->rules(['required']),
            Field::make('num_int'),
        ];
    }
}
