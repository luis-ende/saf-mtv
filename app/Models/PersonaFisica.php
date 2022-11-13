<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaFisica extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personas_fisicas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_persona',
        'curp',
        'fecha_nacimiento',
        'genero',
        'nombre',
        'primer_ap',
        'segundo_ap',
    ];

    public function persona()
    {
        return $this->morphOne(Persona::class, 'tipo_persona', 'personable_type', 'personable_id');
    }

    public function rfc_sin_homoclave()
    {
        return substr($this->persona->rfc, 0, -3);
    }

    public function homoclave()
    {
        return substr($this->persona->rfc, -3);
    }
}
