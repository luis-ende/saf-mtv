<?php declare(strict_types = 1);

namespace App\Services;

use Carbon\Carbon;

class CalculadoraFechasService 
{
/**
     * Calcula el rango de fechas de un trimestre del año proporcionado.
     */
    public static function calculaRangoFechasTrimestre(int $trimestre, int $anio): array
    {
        $inicioAnio = Carbon::create($anio, 1, 1, 0, 0, 0);
        $incrementoMesesInicio = 0;
        $incrementoMesesFin = 3;
        for($t = 1; $t <= $trimestre; $t++) {
            $fechaInicio = $t === 1 ? $inicioAnio->copy() : $inicioAnio->copy()->addMonths($incrementoMesesInicio)->startOfDay();
            $fechaFinal = $inicioAnio->copy()->addMonths($incrementoMesesFin)->subDays(1)->endOfDay();
            if ($t === $trimestre) {
                return [
                    'fecha_inicio' => $fechaInicio->format('Y-m-d'),
                    'fecha_final' => $fechaFinal->format('Y-m-d'),
                ];
            } else {
                $incrementoMesesInicio += 3;
                $incrementoMesesFin += 3;
            }
        }

        return [];
    }    
}