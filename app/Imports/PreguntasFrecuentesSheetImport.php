<?php

namespace App\Imports;

use App\Models\PreguntasFrecuentes\PreguntaFrecuente;
use Maatwebsite\Excel\Concerns\ToModel;

class PreguntasFrecuentesSheetImport implements ToModel
{
    private int $categoria;
    private int $subcategoria;
    public function __construct(int $categoria, int $subcategoria)
    {
        $this->categoria = $categoria;
        $this->subcategoria = $subcategoria;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!empty($row[1]) && !empty($row[2]) && $row[0] !== '#') {
            return new PreguntaFrecuente([
                'categoria' => $this->categoria,
                'subcategoria' => $this->subcategoria,
                'pregunta' => $row[1],
                'respuesta' => $row[2],
            ]);
        }
    }
}