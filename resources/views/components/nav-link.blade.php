@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-mtv-primary text-base font-base leading-5 text-mtv-primary focus:outline-none focus:border-red-700 transition duration-150 ease-in-out no-underline'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-mtv-transparent text-base font-base leading-5 text-mtv-gold hover:text-mtv-primary hover:border-gray-300 focus:outline-none focus:text-mtv-primary focus:border-gray-300 transition duration-150 ease-in-out no-underline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
