@extends('emails.email-message')
@section('content')
# La cuenta de usuario de Unidad Responsable de Gasto ha sido activada
## Estimado usuario de Mi Tiendita Virtual de la Ciudad de México,<br>

Tu cuenta registrada en Mi Tiendita Virtual ha sido verificada y activada.<br>
Puedes iniciar sesión en la plataforma con el siguiente enlace: [Iniciar sesión]({{ route('urg-login') }}).<br><br><br><br>

Sin más por el momento, recibe un cordial saludo.<br><br>
@endsection