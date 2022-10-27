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
        'rfc',
        'nombre',        
        'primer_ap',
        'segundo_ap',
        'id_asentamiento',
        'id_tipo_vialidad',
        'vialidad',
        'num_int',
        'num_ext',
        'lada',
        'telefono_fijo',
        'extension',
        'telefono_movil',
        'email',
        'email_alterno',
        'grupo_prioritario',
        'nombre_contacto',
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
}
