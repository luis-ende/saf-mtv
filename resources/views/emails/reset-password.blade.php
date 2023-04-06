@extends('emails.email-message')
@section('content')
# Recuperación de contraseña
## Estimado usuario de Mi Tiendita Virtual de la Ciudad de México,

Te informamos que desde tu cuenta se ha realizado la siguiente solicitud:<br><br>

**Tipo de operación: Cambio de contraseña**


Fecha y hora: {{ $timestamp }} hrs.<br><br>

Para continuar con la solicitud, da clic en el siguiente enlace:

<x-mail::button :url="$actionUrl" color="gold">
    {{ $actionText }}
</x-mail::button><br><br>

En caso de que no hayas sido tú quien realizó la solicitud, haz caso omiso a este mensaje.

@endsection