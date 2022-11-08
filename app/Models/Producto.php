<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public const TIPO_PRODUCTO_BIEN_ID = 'B';
    public const TIPO_PRODUCTO_SERVICIO_ID = 'S';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_cat_productos',
        'tipo',
        'clave_cabms',
        'nombre',
        'descripcion',
        'precio',
        'marca',
        'modelo',
        'color',
        'material',
    ];
}
