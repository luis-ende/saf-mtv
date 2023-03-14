<?php

namespace App\Http\Requests;

use App\Models\Persona;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContactoFormularioRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string',
            'ubicacion' => 'required|string',
            'email' => 'required|email',
            'tipo_persona' => [
                'required',
                Rule::in([
                    Persona::TIPO_PERSONA_FISICA_ID,
                    Persona::TIPO_PERSONA_MORAL_ID,
                ])
            ],
            'tipo_empresa'=> 'int',
            'mensaje' => 'string',
        ];
    }
}