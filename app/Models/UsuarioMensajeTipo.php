<?php

namespace App\Models;

enum UsuarioMensajeTipo: string
{
    case SolicitudCotizacion = 'Solicitar cotización';
    case SolicitudInformacion = 'Más información';
}