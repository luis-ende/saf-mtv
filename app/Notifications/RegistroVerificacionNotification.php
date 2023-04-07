<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class RegistroVerificacionNotification extends VerifyEmail
{
    protected function buildMailMessage($url)
    {
        $mailMessage = new MailMessage();
        $mailMessage->markdown('emails.registro-proveedor-verificacion');

        return $mailMessage
            ->subject('Notificación de registro en Mi Tiendita Virtual')
            ->action('Confirmar correo electrónico', $url);
    }
}
