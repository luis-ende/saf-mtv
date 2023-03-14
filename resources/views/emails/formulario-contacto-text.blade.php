Mensaje enviado a través del formulario de contacto de la sección de Preguntas frecuentesde Mi Tiendita Virtual.
----------------------------------------------------------------------------------------------------------------
Nombre: {{ $mensajeInfo['nombre'] }}
Email: {{ $mensajeInfo['email'] }}
Alcaldía o ciudad: {{ $mensajeInfo['ubicacion'] }}
{{ $mensajeInfo['tipo_persona'] }}
@isset($mensajeInfo['tipo_empresa'])
{{ $mensajeInfo['tipo_empresa'] }}
@endisset
Mensaje:
{{ $mensajeInfo['mensaje'] }}