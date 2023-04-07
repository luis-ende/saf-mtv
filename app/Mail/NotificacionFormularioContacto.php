<?php

namespace App\Mail;

use App\Repositories\TipoPymeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Mensaje de correo al administrador de MTV para notificar sobre una nueva solicitud de información
 * desde el formulario de contacto de la página de Preguntas frecuentes.
 */
class NotificacionFormularioContacto extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public array $mensajeInfo)
    {
        $this->mensajeInfo['tipo_persona'] = $this->mensajeInfo['tipo_persona'] === 'F' ?
                                                'Persona Física' :
                                                ($this->mensajeInfo['tipo_persona'] === 'M' ? 'Persona Moral' : '');

        if (isset($this->mensajeInfo['tipo_empresa'])) {
            if ($this->mensajeInfo['tipo_empresa'] === '0') {
                unset($this->mensajeInfo['tipo_empresa']);
            } else {
                $tipos_empresa = TipoPymeRepository::obtieneTiposPyme();
                foreach ($tipos_empresa as $tipo) {
                    if ($tipo['id'] == $this->mensajeInfo['tipo_empresa']) {
                        $this->mensajeInfo['tipo_empresa'] = $tipo['tipo_pyme'];
                        break;
                    }
                }
            }
        }
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->mensajeInfo['email'], $this->mensajeInfo['nombre']),
            subject: 'MTV - Preguntas frecuentes',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.notificacion-formulario-contacto',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
