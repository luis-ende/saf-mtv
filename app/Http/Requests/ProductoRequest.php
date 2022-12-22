<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Producto;

class ProductoRequest extends FormRequest
{
    /**          
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**     
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'clave_cabms' => ['required'],
            'nombre_producto' => ['required'],
            'descripcion_producto' => ['required'],            
            'tipo_producto' => [
                'required', 
                Rule::in([
                    Producto::TIPO_PRODUCTO_BIEN_ID, 
                    Producto::TIPO_PRODUCTO_SERVICIO_ID,
                ]),
            ],
            'marca' => ['max:255'],
            'modelo' => ['max:255'],
            'color' => ['max:30'],
            'material' => ['max:255'],
        ];
    }
}
