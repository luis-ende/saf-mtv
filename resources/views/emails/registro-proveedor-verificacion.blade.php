@extends('emails.email-message')
@section('content')
# Registro exitoso
## ¡Bienvenido a Mi Tiendita Virtual de la Ciudad de México!

Venderle al Gobierno de la Ciudad de México representa grandes beneficios para tu negocio, por eso en MI TIENDITA VIRTUAL buscamos apoyarte para incrementar tu cartera de clientes a nivel Gobierno y te damos las herramientas para iniciar esta meta.<br><br>

Hemos preparado contenido y herramientas para ayudarte. Para que conozcas más sobre Mi Tiendita Virtual y cómo venderle a la CDMX, por favor da clic en el siguiente enlace:<br><br>

[Flujograma]({{ route('flujograma.show') }})<br><br>

## Muchas oportunidades de negocio te esperan, ¡ÉXITO!<br><br><br><br>

Para verificar tu cuenta por favor haz clic en el siguiente enlace:

<x-mail::button :url="$actionUrl" color="gold">
    {{ $actionText }}
</x-mail::button><br><br>
@endsection