<?php

namespace App\Imports;

use App\Models\CalendarioCompra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Repositories\OportunidadNegocioRepository;
use Illuminate\Support\Collection;

class CalendarioComprasImport implements ToModel, WithHeadingRow
{
    private Collection $unidadesCompradoras;

    public function __construct(OportunidadNegocioRepository $oportunidadRepo)
    {
        $this->unidadesCompradoras = $oportunidadRepo->obtieneInstitucionesCompradoras();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {    
        
        return new CalendarioCompra([
            //
        ]);
    }
}
