<?php

namespace App\Imports;

use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ProductosImport implements ToModel, WithHeadingRow, WithValidation
{
    private int $catalogoId;

    public function __construct(int $catalogoId)
    {
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
        return new Producto([
            'id_cat_productos' => $this->catalogoId,
            'tipo' => strtoupper(substr($row['tipo'], 0, 1)),
            'nombre' => $row['nombre_producto'],
            'descripcion' => $row['descripcion'],
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'color' => $row['color'],
            'material' => $row['material'],
            'codigo_barras' => $row['codigo_barras'],
            'foto_url_1' => $row['foto_url_1'],
            'foto_url_2' => $row['foto_url_2'],
            'foto_url_3' => $row['foto_url_3'],
            'es_importado' => true,
        ]);
    }

    public function rules(): array
    {
        return [
            'tipo' => [
                'required',
                'starts_with:' . Producto::TIPO_PRODUCTO_BIEN_ID . ',' . Producto::TIPO_PRODUCTO_SERVICIO_ID . ',' .
                                 strtolower(Producto::TIPO_PRODUCTO_BIEN_ID) . ',' . strtolower(Producto::TIPO_PRODUCTO_SERVICIO_ID),
            ],
            ...ProductoRequest::rulesProductoDescripcion(),
            'color' => 'max:30',
            'foto_url_1' => 'nullable|max:255|url',
            'foto_url_2' => 'nullable|max:255|url',
            'foto_url_3' => 'nullable|max:255|url',
        ];
    }
}
