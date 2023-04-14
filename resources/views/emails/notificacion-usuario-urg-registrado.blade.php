@extends('emails.email-message')
@section('content')
# Alta de usuario de Unidad Responsable de Gasto
## Estimado usuario de Mi Tiendita Virtual de la Ciudad de México,<br>

Tu cuenta ha sido dada de alta en Mi Tiendita Virtual.<br>
Podrás [ingresar]({{ route('urg-login') }}) a la plataforma una vez que tu cuenta haya sida activada.<br><br>

Sin más por el momento, recibe un cordial saludo.<br><br>
@endsection