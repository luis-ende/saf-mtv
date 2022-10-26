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
            Field::make('password'),
            Field::make('nombre')->rules(['required']),
            Field::make('primer_ap'),
            Field::make('segundo_ap'),
            Field::make('id_asentamiento'),
            Field::make('id_tipo_vialidad'),
            Field::make('vialidad'),            
            Field::make('num_int'),
            Field::make('num_ext'),            
            Field::make('id_asentamiento_dfiscal'),
            Field::make('id_tipo_vialidad_dfiscal'),
            Field::make('vialidad_fiscal'),            
            Field::make('num_int_dfiscal'),
            Field::make('num_ext_dfiscal'),
            Field::make('lada'),            
            Field::make('telefono_fijo'),
            Field::make('extension'),
            Field::make('telefono_movil'),
            Field::make('email'),
            Field::make('email_alterno'),
            Field::make('grupo_prioritario'),            
        ];
    }
}