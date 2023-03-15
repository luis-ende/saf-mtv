Mensaje enviado a través del formulario de contacto de la sección de Preguntas frecuentesde Mi Tiendita Virtual.
----------------------------------------------------------------------------------------------------------------
Nombre: {{ $mensajeInfo['nombre'] }}
Email: {{ $mensajeInfo['email'] }}
{{ $mensajeInfo['tipo_persona'] }}
@isset($mensajeInfo['tipo_empresa'])
Tipo de empresa: {{ $mensajeInfo['tipo_empresa'] }}
@endisset
Alcaldía o ciudad: {{ $mensajeInfo['ubicacion'] }}
Mensaje:
{{ $mensajeInfo['mensaje'] }}