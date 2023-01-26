<?php

namespace App\Models;

use App\Repositories\PaisesRepository;
use App\Repositories\CatAsentamientosRepository;

final class Direccion
{
    public ?int $id_pais;
    public ?int $id_asentamiento;
    public ?string $cp = '';
    public ?int $id_tipo_vialidad;
    public ?string $vialidad;
    public ?string $num_ext;
    public ?string $num_int;
    public ?string $entidad;
    public ?string $ciudad;
    public ?string $municipio;
    public ?string $pais = '';

    public function __construct(?int              $idPais,
                                ?int              $idAsentamiento,
                                ?int              $idTipoVialidad,
                                ?string           $vialidad,
                                ?string           $numExt,
                                ?string           $numInt,
                                CatAsentamientosRepository $catAsentamientosRepo)
    {
        $this ->id_asentamiento = $idAsentamiento;
        if ($idAsentamiento) {
            $asentamiento = $catAsentamientosRepo->buscaAsentamientoInfo($idAsentamiento);
            $this->cp = $asentamiento->cp;
            $this->entidad = $asentamiento->entidad;
            $this->ciudad = $asentamiento->ciudad;
            $this->municipio = $asentamiento->municipio;
        }
        $this->id_tipo_vialidad = $idTipoVialidad;
        $this->vialidad = $vialidad;
        $this->num_ext = $numExt;
        $this->num_int = $numInt;
        $this->id_pais = $idPais;
        if ($this->id_pais) {
            $this->pais = PaisesRepository::obtienePaisNombre($this->id_pais);
        }
    }
}
