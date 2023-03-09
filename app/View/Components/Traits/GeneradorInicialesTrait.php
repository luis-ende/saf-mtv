<?php

namespace App\View\Components\Traits;

trait GeneradorInicialesTrait
{
    private function generaLetrasIniciales(array $items): array
    {
        if (count($items) > 0) {
            if (!property_exists($items[0], 'unidad_compradora')) {
                throw new \Exception("Los elementos para el generador de iniciales deben incluir una propiedad 'unidad_compradora'");
            }
        }

        $letrasIniciales = [];
        foreach ($items as $item) {
            $letraInicial = strtoupper(mb_substr($item->unidad_compradora, 0, 1));
            $letraInicial = str_replace(
                array('Á', 'É', 'Í', 'Ó', 'Ú'),
                array('A', 'E', 'I', 'O', 'U'),
                $letraInicial
            );
            $letrasIniciales[] = $letraInicial;
        }

        return array_unique($letrasIniciales);
    }
}