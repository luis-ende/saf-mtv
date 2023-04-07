@extends('emails.email-message')
@section('content')
# Solicitud de información
## Estimado usuario de Mi Tiendita Virtual de la Ciudad de México,

Hemos recibido el siguiente mensaje a través del formulario de contacto de la sección de Preguntas frecuentes de Mi Tiendita Virtual.

>Nombre: {{ $mensajeInfo['nombre'] }}<br>
Email: {{ $mensajeInfo['email'] }}<br>
{{ $mensajeInfo['tipo_persona'] }}<br>
@isset($mensajeInfo['tipo_empresa'])<br>
Tipo de empresa: {{ $mensajeInfo['tipo_empresa'] }}<br>
@endisset
Alcaldía o ciudad: {{ $mensajeInfo['ubicacion'] }}<br>
Mensaje:<br>
{{ $mensajeInfo['mensaje'] }}<br>
@endsection