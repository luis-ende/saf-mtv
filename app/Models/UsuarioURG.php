<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioURG extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'urg_usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'nombre',
    ];
}