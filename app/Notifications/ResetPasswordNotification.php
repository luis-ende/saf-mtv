<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

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
        $mailMessage = new MailMessage();
        $mailMessage->markdown('emails.reset-password', [
            'timestamp' => ucfirst(Carbon::now()->translatedFormat('l, d F Y - h:i')) . ' hrs.'
        ]);

        return $mailMessage
            ->subject('Notificación de recuperación de contraseña')
            ->action($url, $url);
    }
}
