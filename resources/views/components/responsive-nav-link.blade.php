@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-mtv-primary text-sm font-medium text-[#691C32] bg-gray-100 focus:outline-none focus:text-red-800 focus:bg-red-100 focus:border-mtv-primary transition duration-150 ease-in-out no-underline'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out no-underline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
