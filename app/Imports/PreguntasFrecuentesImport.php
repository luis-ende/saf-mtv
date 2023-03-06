<?php

namespace App\Imports;

use App\Models\PreguntasFrecuentes\PreguntaFrecuente;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PreguntasFrecuentesImport implements WithMultipleSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Público > Conceptos' => new PreguntasFrecuentesSheetImport(PreguntaFrecuente::CATEGORIA_PUBLICO,
                PreguntaFrecuente::SUBCATEGORIA_PUBLICO_CONCEPTOS),
            'Público > Compras públicas' => new PreguntasFrecuentesSheetImport(PreguntaFrecuente::CATEGORIA_PUBLICO,
                PreguntaFrecuente::SUBCATEGORIA_PUBLICO_COMPRAS),
            'Público > MTV' => new PreguntasFrecuentesSheetImport(PreguntaFrecuente::CATEGORIA_PUBLICO,
                PreguntaFrecuente::SUBCATEGORIA_PUBLICO_MTV),
            'Proveedores > Padrón de Proveed' => new PreguntasFrecuentesSheetImport(PreguntaFrecuente::CATEGORIA_PROVEEDORES,
                PreguntaFrecuente::SUBCATEGORIA_PROVEEDORES_PADRON),
            'Proveedores > Precotizaciones' => new PreguntasFrecuentesSheetImport(PreguntaFrecuente::CATEGORIA_PROVEEDORES,
                PreguntaFrecuente::SUBCATEGORIA_PROVEEDORES_PRECOTIZACIONES),
            'Instituciones compradoras' => new PreguntasFrecuentesSheetImport(PreguntaFrecuente::CATEGORIA_INSTITUCIONES,
                PreguntaFrecuente::SUBCATEGORIA_INSTITUCIONES_PAAPS),
        ];
    }
}
