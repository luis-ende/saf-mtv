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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(
            self::rulesProductoCABMS(),
            self::rulesProductoDescripcion(),
            self::rulesProductoFotos(),
            self::rulesProductoAdjuntos()
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function rulesProductoTipo(): array
    {
        return [
            'tipo_producto' => [
                'required',
                Rule::in([
                    Producto::TIPO_PRODUCTO_BIEN_ID,
                    Producto::TIPO_PRODUCTO_SERVICIO_ID])
                ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function rulesProductoCABMSCategorias(): array
    {
        return [
            'id_cabms' => 'required|integer',
            'ids_categorias_scian' => 'required|array',
            'ids_categorias_scian.*' => 'integer',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function rulesProductoDescripcion(): array
    {
        return [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:140',
            'marca' => 'max:255',
            'modelo' => 'max:255',
            'producto_colores.*' => 'nullable|string', // TODO: Validar longitud máxima de 140 caracteres
            'material' => 'max:255',
            'codigo_barras' => 'max:100',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function rulesProductoFotos(): array
    {
        return [
            'producto_fotos' => 'min:1|max:3',
            'producto_fotos.*' => 'max:1000|mimes:jpg,png',
            'producto_fotos_eliminadas' => 'nullable|string',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function rulesProductoAdjuntos(): array
    {
        return [
            'ficha_tecnica_file' => [
                'required',
                'max:3000',
                'mimes:pdf'
            ],
            'otro_documento_file' => 'max:3000|mimes:pdf',
        ];
    }
}
