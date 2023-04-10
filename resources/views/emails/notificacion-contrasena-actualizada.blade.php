@extends('emails.email-message')
@section('content')
# Contraseña actualizada
## Estimado usuario de Mi Tiendita Virtual de la Ciudad de México,<br>

Te informamos que tu contraseña ha sido restablecida exitosamente, por lo que ya puedes ingresar a la plataforma de manera normal.<br><br>

Para ver o cambiar información adicional, ingresa a [Mi Tiendita Virtual]({{ route('login') }}).<br><br>

Sin más por el momento, recibe un cordial saludo.<br><br>
@endsection