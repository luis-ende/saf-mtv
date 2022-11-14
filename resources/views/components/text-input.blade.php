@props(['disabled' => false, 'is_required' => null])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control']) !!} {{ $is_required ? 'required' : '' }}>
