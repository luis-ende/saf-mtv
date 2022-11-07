<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_persona',
        'nombre',
        'primer_ap',
        'segundo_ap',
        'cargo',
        'telefono_oficina',
        'extension',
        'telefono_movil',
        'email',
    ];

    public function persona() {
        return $this->belongsTo(Persona::class);
    }
}
