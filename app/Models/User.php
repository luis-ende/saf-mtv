<?php

namespace App\Models;

use App\Notifications\RegistroVerificacionNotification;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Cmgmyr\Messenger\Traits\Messagable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

/**
 * Modelo que corresponde a la entidad Usuario de MTV.
 */
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rfc',
        'id_persona',
        'activo',
        'last_login',
        'password',
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Obtener persona asociada al perfil.
     */
    public function persona(): HasOne
    {
        return $this->hasOne(Persona::class, 'id', 'id_persona');
    }

    /**
     * Obtener usuario URG asociado al perfil.
     */
    public function urg(): HasOne
    {
        return $this->hasOne(UsuarioURG::class, 'id', 'id_urg');
    }


    /**
     * Nombre genérico de usuario.
     */
    public function nombreUsuario()
    {
        if ($this->persona) {
            return $this->persona->nombre_o_razon_social();
        } elseif ($this->urg) {
            return $this->urg->nombre;
        } else {
            return $this->rfc;
        }
    }

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model)
        {
            if ($model->attributes['name']) {
                $model->attributes['rfc'] = $model->attributes['name'];
            }
            $model->attributes['last_login'] = Carbon::now();
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new RegistroVerificacionNotification());
    }

    /**
     * Devuelve si el panel de administración es accesible para el usuario actual.
     * Solamente el rol 'mtv-admin' tiene permiso a este módulo de la plataforma.
     *
     * @return bool
     */
    public function canAccessFilament(): bool
    {
        return $this->hasRole('mtv-admin');
    }
}
