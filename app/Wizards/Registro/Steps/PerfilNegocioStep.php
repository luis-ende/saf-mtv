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
            Field::make('razon_social'),
            Field::make('nombre'),
            Field::make('primer_ap'),
            Field::make('segundo_ap'),
            Field::make('nombre_contacto'),
            Field::make('id_asentamiento'),
            Field::make('id_tipo_vialidad'),
            Field::make('vialidad')->rules(['required']),
            Field::make('num_int'),
            Field::make('num_ext')->rules(['required']),
            Field::make('id_asentamiento_dfiscal'),
            Field::make('id_tipo_vialidad_dfiscal'),
            Field::make('vialidad_fiscal'),
            Field::make('num_int_dfiscal'),
            Field::make('num_ext_dfiscal'),
            Field::make('lada')->rules(['required']),
            Field::make('telefono_fijo')->rules(['required']),
            Field::make('extension'),
            Field::make('telefono_movil')->rules(['required']),
            Field::make('email')->rules(['required']),
            Field::make('email_alterno'),
            Field::make('grupo_prioritario'),
        ];
    }
}
