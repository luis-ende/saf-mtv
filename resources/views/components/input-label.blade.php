@props(['value'])

<label {{ $attributes->merge(['class' => 'mtv-input-label']) }}>
    {{ $value ?? $slot }}
</label>
