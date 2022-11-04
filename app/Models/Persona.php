<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_tipo_persona',
        'rfc',
        'id_asentamiento',
        'id_tipo_vialidad',
        'vialidad',
        'num_int',
        'num_ext',
    ];

     /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'id_asentamiento' => 1,
        'id_tipo_vialidad' => 1,
    ];

    /**
     * Obtener catálogo de productos asociado a la persona.
     */
    public function catalogoProductos()
    {
        return $this->hasOne(CatalogoProductos::class, 'id_persona', 'id');
    }
}
