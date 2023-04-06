<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{ 'Mi Tiendita Virtual' }}
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
<p>Dudas o aclaraciones de Mi Tiendita Virtual:</p>
<p>5557236565 o 5551342600 Ext. 5004 y 5026</p>
<p><a href="mailto:proveedores@finanzas.cdmx.gob.mx">proveedores@finanzas.cdmx.gob.mx</a> o <a href="mailto:proveedores_cdmx@finanzas.cdmx.gob.mx">proveedores_cdmx@finanzas.cdmx.gob.mx</a></p>
<br>
<p>O acude a nuestras oficinas ubicadas en la siguiente dirección:</p>
<p>Calle Viaducto 515, (Entrada por Añil, piso 7), Granjas México, C.P. 08400, Ciudad de México</p>
<p>Horario de atención: Lunes a viernes de 09:00 a 18:00 hrs.</p>
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
