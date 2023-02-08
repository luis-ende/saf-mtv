<?php

namespace App\Models;

use App\Repositories\GrupoPrioritarioRepository;
use App\Repositories\TipoPymeRepository;
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

    public function tipoPyme()
    {
        return TipoPymeRepository::findTipoPyme($this->id_tipo_pyme);
    }

    public function grupoPrioritario()
    {
        return GrupoPrioritarioRepository::findGrupoPrioritario($this->id_grupo_prioritario);
    }

    /**
     * Obtiene los enlaces válidos de redes sociales del perfil de negocio.
     */
    public function enlacesRedesSociales(): array
    {
        $enlaces = [
            'sitio_web' => filter_var($this->sitio_web, FILTER_VALIDATE_URL) ? $this->sitio_web : '',
            'cuenta_facebook' => filter_var($this->cuenta_facebook, FILTER_VALIDATE_URL) ? $this->cuenta_facebook : '',
            'cuenta_twitter' => filter_var($this->cuenta_twitter, FILTER_VALIDATE_URL) ? $this->cuenta_twitter : '',
            'cuenta_linkedin' => filter_var($this->cuenta_linkedin, FILTER_VALIDATE_URL) ? $this->cuenta_linkedin : '',
            'num_whatsapp' => !empty($this->num_whatsapp) ? 'https://wa.me/' . $this->num_whatsapp : '',
        ];

        // Remover enlaces vacíos
        return array_filter($enlaces);
    }
}
