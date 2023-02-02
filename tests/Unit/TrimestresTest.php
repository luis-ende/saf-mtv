<?php

namespace Tests\Unit;

use App\Services\CalculadoraFechasService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrimestresTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_calcula_rango_fechas_trimestres()
    {        
        $anioTest = 2023;
        $fechas = CalculadoraFechasService::calculaRangoFechasTrimestre(1, $anioTest);

        $this->assertEquals($fechas['fecha_inicio'], '2023-01-01');
        $this->assertEquals($fechas['fecha_final'], '2023-03-31');

        $fechas = CalculadoraFechasService::calculaRangoFechasTrimestre(2, $anioTest);

        $this->assertEquals($fechas['fecha_inicio'], '2023-04-01');
        $this->assertEquals($fechas['fecha_final'], '2023-06-30');

        $fechas = CalculadoraFechasService::calculaRangoFechasTrimestre(3, $anioTest);        

        $this->assertEquals($fechas['fecha_inicio'], '2023-07-01');
        $this->assertEquals($fechas['fecha_final'], '2023-09-30');

        $fechas = CalculadoraFechasService::calculaRangoFechasTrimestre(4, $anioTest);

        $this->assertEquals($fechas['fecha_inicio'], '2023-10-01');
        $this->assertEquals($fechas['fecha_final'], '2023-12-31');
    }
}
