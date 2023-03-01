<?php

namespace App\Exports;

use App\Models\ComprasProcedimiento;
use App\Models\UnidadCompradora;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ComprasProcedimientosExport implements FromView
{
    private array $procedimientos;
    private string $unidadCompradora;
    public function __construct(array $procedimientos,
                                string $unidadCompradora)
    {
        $this->procedimientos = $procedimientos;
        $this->unidadCompradora = $unidadCompradora;
    }

    public function view(): View
    {
        return view('exports.compras-procedimientos', [
            'procedimientos' => $this->procedimientos,
            'unidad_compradora' => $this->unidadCompradora,
        ]);
    }
}
