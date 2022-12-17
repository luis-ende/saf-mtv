<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilNegocioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
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
            'id_pais' => 'required|integer',
            'id_asentamiento' => 'required|integer',
            'id_tipo_vialidad' => 'required|integer',
            'vialidad' => 'required|max:120',
            'num_ext' => 'required|max:100',
            'num_int' => 'max:80',
            'id_grupo_prioritario' => 'required',
            'id_tipo_pyme' => 'required',
            'id_sector' => 'required|required',
            'id_categoria_scian' => 'required|integer',
            'nombre_negocio' => 'required|max:100',
            'lema_negocio' => 'required',
            'descripcion_negocio' => 'required',
            'diferenciadores' => 'required',
            'sitio_web' => 'max:255',
            'cuenta_facebook' => 'max:240',
            'cuenta_twitter' => 'max:240',
            'cuenta_linkedin' => 'max:240',
            'num_whatsapp' => 'max:15',
            'logotipo' => 'nullable|file|image',
            'carta_presentacion' => 'nullable|file|mimes:pdf|max:3000',
            'eliminar_carta' => 'boolean'
        ];
    }
}
