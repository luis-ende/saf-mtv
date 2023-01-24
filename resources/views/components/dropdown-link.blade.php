@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2 text-sm leading-5 font-bold text-mtv-primary hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out no-underline'
            : 'block px-4 py-2 text-sm leading-5 text-mtv-gold hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out no-underline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
{{ $slot }}
</a>
