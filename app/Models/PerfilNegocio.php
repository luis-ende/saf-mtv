<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\catalogoProductos;

class PerfilNegocio extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perfil_negocio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_persona',
        'id_grupo_prioritario',
        'id_tipo_pyme',
        'id_sector',
        'id_categoria_scian',
        'lema_negocio',
        'descripcion_negocio',
        'diferenciadores',
        'sitio_web',
        'cuenta_facebook',
        'cuenta_twitter',
        'cuenta_linkedin',
        'num_whatsapp',
    ];
}
