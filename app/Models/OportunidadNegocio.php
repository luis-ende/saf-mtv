<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;

class OportunidadNegocio extends Model
{
    use HasFactory;    
    use Markable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oportunidades_negocio';

    /**
     * Marca de notificación de alerta.
     */
    protected static $marks = [
        Bookmark::class,
    ];
}
