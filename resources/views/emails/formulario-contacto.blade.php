<img src="{{ asset('images/logos/gobierno_cdmx_con.svg') }}" style="width: 144px; height: 80px;" alt="Logo CDMX">
<img src="{{ asset('images/logos/tianguis_digital.svg') }}" style="width: 144px; height: 80px;" alt="Logo Tianguis Digital">

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