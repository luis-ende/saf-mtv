<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

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
        'email',
        'registro_fase',
    ];

     /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [        
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

    public function perfil_negocio(): HasOne
    {
        return $this->hasOne(PerfilNegocio::class, 'id_persona', 'id');
    }

    /**
     * Relación polimórfica devuelve PersonaFisca o PersonaMoral según el tipo_persona.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function tipo_persona()
    {
        return $this->morphTo('tipo_persona', 'personable_type', 'personable_id');
    }

    public function nombre_o_razon_social(): string
    {
        if ($this->id_tipo_persona === Persona::TIPO_PERSONA_FISICA_ID) {
            return $this->tipo_persona->nombre . ' ' . $this->tipo_persona->primer_ap . ' ' . $this->tipo_persona->segundo_ap;
        } elseif ($this->id_tipo_persona === Persona::TIPO_PERSONA_MORAL_ID) {
            return $this->tipo_persona->razon_social;
        }

        return '';
    }

    public function direccion(): Direccion
    {
        return App::makeWith(
            Direccion::class, [
                'idAsentamiento' => $this->id_asentamiento,
                'idTipoVialidad' => $this->id_tipo_vialidad,
                'vialidad' => $this->vialidad,
                'numExt' => $this->num_ext,
                'numInt' => $this->num_int,
            ]
        );
    }

    public function registroCompleto(): bool
    {
        return $this->registro_fase === RegistroMTV::FASE_REGISTRO_COMPLETO;
    }
}
