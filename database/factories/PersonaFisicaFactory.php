<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonaFisica>
 */
class PersonaFisicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'curp' => 'AONN880915MDFLNA01',
            'fecha_nacimiento' => fake()->date('15/09/1988'),
            'genero' => 'F',
            'nombre' => 'Nombre',
            'primer_ap' => 'Apellido 1',
            'segundo_ap' => 'Apellido 2',
        ];
    }
}
