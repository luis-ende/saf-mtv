<?php

namespace App\Services;

use App\Models\ObjetivoTarea;
use App\Models\ObjetivoTareaCondicion;
use App\Models\Persona;
use App\Repositories\ObjetivoTareaRepository;
use function PHPUnit\Framework\isEmpty;

class ObjetivosTareasService
{
    /**
     * Obtiene una tarea de objetivo aleatoria para desplegar en el banner del escritorio del proveedor.
     */
    public static function obtieneObjetivoTarea(array $objetivos,
                                                ObjetivoTareaRepository $objetivosTareasRepo): ObjetivoTarea
    {
        $objetivosTareas = $objetivosTareasRepo->obtieneObjetivosTareas();
        $condiciones = [];
        foreach ($objetivos as $objetivo) {
            if ($objetivo['id'] === ObjetivoTareaCondicion::CatalogoCreado->value) {
                if ($objetivo['completo'] === true) {
                    $condiciones[] = ObjetivoTareaCondicion::CatalogoCreado->value;
                } else {
                    $condiciones[] = ObjetivoTareaCondicion::CatalogoNoCreado->value;
                    break;
                }
            } else if ($objetivo['id'] === ObjetivoTareaCondicion::OportunidadesBuscadasGuardadas->value) {
                if ($objetivo['completo'] === true) {
                    $condiciones[] = ObjetivoTareaCondicion::ObjetivosCumplidos->value;
                } else {
                    $condiciones[] = ObjetivoTareaCondicion::OportunidadesBuscadasGuardadas->value;
                    break;
                }
            }
        }

        return $objetivosTareas->filter(function ($ot) use($condiciones) {
            return in_array($ot->objetivo_condicion, $condiciones);
        })->random();
    }
}