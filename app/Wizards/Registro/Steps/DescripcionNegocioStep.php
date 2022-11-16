<?php

namespace App\Wizards\Registro\Steps;

use App\Repositories\GrupoPrioritarioRepository;
use App\Repositories\SectorRepository;
use App\Repositories\TipoPymeRepository;
use Arcanist\Field;
use Arcanist\StepResult;
use Arcanist\WizardStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DescripcionNegocioStep extends WizardStep
{
    public string $title = 'Perfil de tu Negocio';

    public string $slug = 'descripcion-negocio';

    public function viewData(Request $request): array
    {
        return $this->withFormData([
            'grupos_prioritarios' => GrupoPrioritarioRepository::obtieneGruposPrioritarios(),
            'tipos_pyme' => TipoPymeRepository::obtieneTiposPyme(),
            'sectores' => SectorRepository::obtieneSectores(),
            'categorias_scian' => [], // TODO: Implementar cuando esté listo el catálogo
        ]);
    }

    public function fields(): array
    {
        return [
            Field::make('id_grupo_prioritario'),
            Field::make('id_tipo_pyme'),
            Field::make('id_sector'),
            Field::make('id_categoria_scian'),
            Field::make('lema_negocio')->rules(['required']),
            Field::make('descripcion_negocio')->rules(['required']),
            Field::make('diferenciadores'),
            Field::make('sitio_web'),
            Field::make('cuenta_facebook'),
            Field::make('cuenta_twitter'),
            Field::make('cuenta_linkedin'),
            Field::make('num_whatsapp'),
            Field::make('logotipo'),
        ];
    }
    public function process(Request $request): StepResult
    {
        // TODO: Guardar imagen temporalmente hasta completa registro (después mover a carpeta de media)
        //$path = $request->file('logotipo')->store('logotipos_tmp');

        return parent::process($request);
    }
}
