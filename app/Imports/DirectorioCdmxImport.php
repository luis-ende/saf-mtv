<?php

namespace App\Imports;

use App\Models\Directorio\Funcionario;
use App\Models\UnidadCompradora;
use App\Repositories\OportunidadNegocioRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DirectorioCdmxImport implements ToModel, WithHeadingRow
{
    private OportunidadNegocioRepository $oportunidadesRepo;
    private Collection $unidadesCompradoras;
    private array $nombres = [];

    public function __construct(OportunidadNegocioRepository $oportunidadesRepo)
    {
        $this->unidadesCompradoras = $oportunidadesRepo->obtieneInstitucionesCompradoras(false);
        $this->oportunidadesRepo = $oportunidadesRepo;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!array_search($row['nombre'], $this->nombres)) {
            $nombreURG = trim($row['institucion']);
            $unidadCompradora = $this->unidadesCompradoras->first(function (object $uc, int $key) use($nombreURG) {
                return mb_strtolower($uc->nombre) === mb_strtolower($nombreURG);
            });

            if (!$unidadCompradora) {
                $unidadCompradora = UnidadCompradora::create([
                    'nombre' => $nombreURG,
                ]);
                // Refrescar lista de de unidades compradoras
                $this->unidadesCompradoras = $this->oportunidadesRepo->obtieneInstitucionesCompradoras(false);
            }

            $this->nombres[] = $row['nombre'];

            return new Funcionario([
                'id_unidad_compradora' => $unidadCompradora->id,
                'nombre' => $row['nombre'],
                'puesto' => $row['puesto'],
                'funciones' => $row['funciones'],
                'telefono_oficina' => $row['telefono'],
                'email' => $row['correo_electronico'],
                'fecha_actualizacion' => $row['fecha_de_actualizacion'],
            ]);
        }

        return null;
    }
}
