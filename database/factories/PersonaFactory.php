<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [            
            'id_tipo_persona' => 'F',
            'personable_id' => null,
            'personable_type' => '',
            'rfc' => 'AONN880915B12',
            'id_asentamiento' => 315,
            'id_tipo_vialidad' => 2,
            'vialidad' => 'Insurgentes',            
            'num_ext' => '1234',
            'num_int' => null,
        ];
    }
}
