<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Notificación de reestablecimiento de contraseña')
            ->greeting("Estimado proveedor,")
            ->line('Has recibido este mensaje debido a que solicitaste restablecer la contraseña de tu cuenta en Mi Tiendita Virtual.')
            ->action('Reestablecer contraseña', $url)
            ->line(Lang::get('Este enlace expirará en :count minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line('Ignora este mensaje si no has solicitado reestablecer contraseña.')
            ->salutation(new HtmlString("Atentamente, <br><br> Mi Tiendita Virtual"));
    }
}
