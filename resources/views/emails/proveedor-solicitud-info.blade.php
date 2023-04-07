@extends('emails.email-message')
@section('content')
# Solicitud de información
## Estimado usuario de Mi Tiendita Virtual de la Ciudad de México,

Has recibido el siguiente mensaje de una institución compradora:

>{!! nl2br($mensaje) !!}
@endsection