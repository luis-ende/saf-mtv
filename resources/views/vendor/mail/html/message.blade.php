<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ 'Mi Tiendita Virtual' }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
    © {{ date('Y') }} {{ 'Mi Tiendita Virtual' }}. @lang('2023 Gobierno de la CDMX.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
