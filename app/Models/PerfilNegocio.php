<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PerfilNegocio extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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
        'nombre_negocio',
        'lema_negocio',
        'descripcion_negocio',
        'diferenciadores',
        'sitio_web',
        'cuenta_facebook',
        'cuenta_twitter',
        'cuenta_linkedin',
        'num_whatsapp',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
