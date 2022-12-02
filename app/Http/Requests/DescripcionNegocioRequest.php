<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DescripcionNegocioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_grupo_prioritario' => ['required'],
            'id_tipo_pyme' => ['required'],
            'id_sector' => ['required'],
            'id_categoria_scian' => [],
            'lema_negocio' => ['required'],
            'descripcion_negocio' => ['required'],
            'diferenciadores' => [],
            'sitio_web' => ['max:255'],
            'cuenta_facebook' => ['max:240'],
            'cuenta_twitter' => ['max:240'],
            'cuenta_linkedin' => ['max:240'],
            'num_whatsapp' => ['max:15'],
        ];
    }
}
