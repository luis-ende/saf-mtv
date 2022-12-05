@props(['disabled' => false, 'is_required' => null])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mtv-text-input']) !!} {{ $is_required ? 'required' : '' }}>
