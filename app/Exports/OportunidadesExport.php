<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Repositories\OportunidadNegocioRepository;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class OportunidadesExport implements WithHeadings, WithMapping, WithColumnFormatting, FromView
{
    private $oportunidades;

    public function __construct($oportunidades)
    {
        $this->oportunidades = $oportunidades;
    }

    public function headings(): array
    {
        return [            
            'Institución compradora',
            'Procedimiento',
            'Estatus',            
            'Publicación',
            'Presentación de propuestas',
            'Tipo de contratación',
            'Método de contratación',
        ];
    }

    public function map($oportunidad): array
    {
        return [            
            // $producto->nombre,
            // $producto->tipo,
            // $producto->categoria,
            // $producto->partida,
            // $producto->cabms,
            // $producto->nombre_cabms,
            // $producto->descripcion,
        ];
    }

    public function columnFormats(): array
    {
        return [
            // 'E' => NumberFormat::FORMAT_TEXT,
            // 'F' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function view(): View
    {
        return view('exports.oportunidades-busqueda', [
            'oportunidades' => $this->oportunidades
        ]);
    }
}