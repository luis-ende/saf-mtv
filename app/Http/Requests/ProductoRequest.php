<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Producto;

class ProductoRequest extends FormRequest
{
    public const PRODUCTO_REQUEST_RULES = [
        'id_cabms' => 'required|integer',
        'tipo_producto' => [
            'required', 
            Rule::in([
                Producto::TIPO_PRODUCTO_BIEN_ID, 
                Producto::TIPO_PRODUCTO_SERVICIO_ID
            ])
        ],
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:140',
        'marca' => 'string|max:255',
        'modelo' => 'string|max:255',
        'color' => 'string|max:30',
        'material' => 'string|max:255',
        'codigo_barras' => 'string|max:100',
    ];

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
        return self::PRODUCTO_REQUEST_RULES;
    }
}
