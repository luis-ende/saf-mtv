<?php

namespace App\Imports;

use App\Models\Producto;
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
        // TODO: Eventualmente remover clave restricción de requerido en Clave CABMS
        if (empty($row[$this->opciones['map_clave_cabms']])) {
            throw new \Exception('Clave CABMS vacía.');
        }

        if (empty($row[$this->opciones['map_nombre']])) {
            throw new \Exception('Nombre de producto vacío.');
        }

        if (empty($row[$this->opciones['map_descripcion']])) {
            throw new \Exception('Descripción de producto vacía.');
        }

        return new Producto([
            'id_cat_productos' => $this->catalogoId,
            'tipo' => $this->opciones['map_tipo_producto'],
            'clave_cabms' => $row[$this->opciones['map_clave_cabms']],
            'nombre' => $row[$this->opciones['map_nombre']],
            'descripcion' => $row[$this->opciones['map_descripcion']],
            'precio' => floatval($row[$this->opciones['map_precio']],),
        ]);
    }

    public function rules(): array
    {
        return [            
        ];
    }
}
