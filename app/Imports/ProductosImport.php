<?php

namespace App\Imports;

use App\Models\Producto;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use _PHPStan_582a9cb8b\Nette\Neon\Exception;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ProductosImport implements ToModel, WithHeadingRow, WithValidation
{
    private int $catalogoId;
    private array $opciones;

    public function __construct(int $catalogoId, array $opciones)
    {
        $this->opciones = $opciones;
        $this->catalogoId = $catalogoId;
        HeadingRowFormatter::default('none');
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // TODO: Asignar índices de columnas según posición de columnas en la plantilla
        return new Producto([
            'id_cat_productos' => $this->catalogoId,
            'tipo' => $row[3],
            'nombre' => $row[4],
            'descripcion' => $row[5],
            'marca' => $row[6],
        ]);
    }

    public function rules(): array
    {
        return [
            'tipo_producto' => [
                'required',
                Rule::in([
                    Producto::TIPO_PRODUCTO_BIEN_ID,
                    Producto::TIPO_PRODUCTO_SERVICIO_ID
                ])
            ],
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:140',
            'marca' => 'string|max:255',
            'modelo' => 'string|max:255',
            'color' => 'string|max:30',
            'material' => 'string|max:255',
            'codigo_barras' => 'string|max:100',
        ];
    }
}
