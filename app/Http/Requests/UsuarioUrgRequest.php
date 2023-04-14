<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUrgRequest extends FormRequest
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
            'rfc' => 'required|min:13|max:13|unique:users,rfc',
            'nombre' => 'max:160',
            'email' => 'required|email|same:email_confirmacion|max:255',
            'id_urg' => 'required|int',
            'password' => 'required|min:8|max:15|same:password_confirmacion'
        ];
    }
}
