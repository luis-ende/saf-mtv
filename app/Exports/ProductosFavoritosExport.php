<?php

namespace App\Exports;

use App\Models\User;
use App\Repositories\ProductoRepository;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductosFavoritosExport implements WithHeadings, WithMapping, WithColumnFormatting, FromView
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function headings(): array
    {
        return [
            'No',
            'PRODUCTO',
            'BIEN/SERVICIO',
            'Categoría',
            'Partida',
            'Clave CABMS',
            'Nombre de la Clave CABMS',
            'Descripción',
        ];
    }

    public function map($producto): array
    {
        return [
            $producto->row_number,
            $producto->nombre,
            $producto->tipo,
            $producto->categoria,
            $producto->partida,
            $producto->cabms,
            $producto->nombre_cabms,
            $producto->descripcion,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function view(): View
    {
        $productoRepo = new ProductoRepository();

        return view('exports.productos-favoritos', [
            'productos' => $productoRepo->obtieneProductosFavoritosDescarga($this->user),
        ]);
    }
}
