<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'email',
    ];

    public function unidadCompradora(): HasOne
    {
        return $this->hasOne(UnidadCompradora::class, 'id', 'id_unidad_compradora');
    }
}