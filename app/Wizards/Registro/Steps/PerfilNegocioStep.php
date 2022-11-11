<?php

namespace App\Wizards\Registro\Steps;

use App\Repositories\VialidadRepository;
use Arcanist\Field;
use Arcanist\WizardStep;
use Illuminate\Http\Request;

class PerfilNegocioStep extends WizardStep
{
    public string $title = 'Datos de contacto';

    public string $slug = 'perfil-negocio';

    public function viewData(Request $request): array
    {
        return $this->withFormData([
            'tipos_vialidad' => VialidadRepository::obtieneTiposVialidad(),
        ]);
    }

    public function fields(): array
    {
        return [
            Field::make('tipo_persona')->rules(['required']),
            Field::make('rfc')->rules(['required']), // RFC completo (persona moral) o sólo homoclave (persona física)
            Field::make('rfc_sin_homoclave')->rules(['required']), // Si es persona física
            Field::make('rfc_completo')->rules(['required', 'unique:users,rfc']),
            Field::make('password')->rules(['required']),
            Field::make('curp'),
            Field::make('fecha_nacimiento'),
            Field::make('genero'),
            Field::make('nombre'),
            Field::make('primer_ap'),
            Field::make('segundo_ap'),
            Field::make('fecha_constitucion'),
            Field::make('razon_social'),
            Field::make('cp'),
            Field::make('id_asentamiento'),
            Field::make('id_tipo_vialidad'),
            Field::make('vialidad')->rules(['required']),
            Field::make('num_ext')->rules(['required']),
            Field::make('num_int'),
            Field::make('contactos_lista'),
        ];
    }
}
