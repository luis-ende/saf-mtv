<?php

namespace App\Models;

use App\Services\BusquedaCPService;

final class Direccion
{
    public string $id_asentamiento;
    public string $cp;
    public int $id_tipo_vialidad;
    public string $vialidad;
    public string $num_ext;
    public ?string $num_int;

    public function __construct(int               $idAsentamiento,
                                int               $idTipoVialidad,
                                string            $vialidad,
                                string            $numExt,
                                ?string           $numInt,
                                BusquedaCPService $busquedaCPService)
    {
        $this ->id_asentamiento = $idAsentamiento;
        $this->cp = $busquedaCPService->buscaAsentamientoCP($idAsentamiento);
        $this->id_tipo_vialidad = $idTipoVialidad;
        $this->vialidad = $vialidad;
        $this->num_ext = $numExt;
        $this->num_int = $numInt;
    }
}