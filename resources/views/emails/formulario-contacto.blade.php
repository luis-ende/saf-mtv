<p>Mensaje enviado a través del formulario de contacto de la sección de <strong>Preguntas frecuentes</strong> de Mi Tiendita Virtual.</p>
<br>
<p>Nombre: {{ $mensajeInfo['nombre'] }}</p>
<p>Email: {{ $mensajeInfo['email'] }}</p>
<p>{{ $mensajeInfo['tipo_persona'] }}</p>
@isset($mensajeInfo['tipo_empresa'])
    <p>Tipo de empresa: {{ $mensajeInfo['tipo_empresa'] }}</p>
@endisset
<p>Alcaldía o ciudad: {{ $mensajeInfo['ubicacion'] }}</p>
<p>Mensaje:</p>
<span>{{ $mensajeInfo['mensaje'] }}</span>