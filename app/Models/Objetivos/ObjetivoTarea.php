<?php

namespace App\Models\Objetivos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoTarea extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'objetivos_tareas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'objetivo',
        'tipo_objetivo',
        'sugerencia',
        'url_accion',
        'objetivo_condicion',
    ];
}
