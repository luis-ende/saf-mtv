<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Persona extends Model
{
    public const TIPO_PERSONA_FISICA_ID = 'F';
    public const TIPO_PERSONA_MORAL_ID = 'M';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_tipo_persona',
        'personable_id',
        'personable_type',
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
    public function catalogoProductos(): HasOne
    {
        return $this->hasOne(CatalogoProductos::class, 'id_persona', 'id');
    }

    /**
     * Obtener los contactos asociados a la persona.
     */
    public function contactos(): HasMany
    {
        return $this->hasMany(Contacto::class, 'id_persona', 'id');
    }

//    public function persona_fisica()
//    {
//        return $this->hasOne(PersonaFisica::class, 'id');
//    }
//
//    public function persona_moral()
//    {
//        return $this->hasOne(PersonaMoral::class, 'id_persona');
//    }

    /**
     * Relación polimórfica devuelve PersonaFisca o PersonaMoral según el tipo_persona.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function tipo_persona()
    {
        return $this->morphTo('tipo_persona', 'personable_type', 'personable_id');
    }
}
