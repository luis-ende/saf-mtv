<?php

namespace App\Services\Traits;
use App\Models\UnidadCompradora;
use App\Repositories\OportunidadNegocioRepository;
use Illuminate\Support\Collection;

trait BusquedaUnidadDeCompra
{
    protected ?Collection $unidadesCompradoras = null;
    protected OportunidadNegocioRepository $opnRepo;

    /**
     * Busca una unidad compradora por nombre similar a la del parámetro proporcionado.
     * Devuelve el id de la unidad encontrada o de una nueva unidad creada.
     */
    public function buscaUnidadCompraHomologada(string $nombre): int
    {
        if (!$this->unidadesCompradoras) {
            $this->opnRepo = new OportunidadNegocioRepository();
            $this->unidadesCompradoras = $this->opnRepo->obtieneInstitucionesCompradoras(false);
        }

        $nombreUC = $this->homologarNombre($nombre);

        $uc = $this->unidadesCompradoras->first(function (object $value, int $key) use($nombreUC) {
            similar_text($nombreUC, $value->nombre, $perc);

            return $perc > 80;
        });

        if (!$uc) {
            $uc = UnidadCompradora::create([
                'nombre' => $nombreUC,
            ]);

            $this->unidadesCompradoras = $this->opnRepo->obtieneInstitucionesCompradoras(false);
        }

        return $uc->id;
    }

    private function homologarNombre(string $nombre): string
    {
        $nombre = trim($nombre);
        $nombre = str_replace(
            ['á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú'],
            ['a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U'],
            $nombre
        );
        $nombre = strtoupper($nombre);

        return $nombre;
    }
}