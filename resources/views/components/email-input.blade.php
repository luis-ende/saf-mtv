@props(['label_id' => 'email', 'label' => ''])

<div class="mtv-input-wrapper">
    <input
        {{ $attributes }}
        class="mtv-text-input"
        type="email"
        placeholder="nombre@correo.com"
        required
    />
    <label class="mtv-input-label" for="{{ $label_id }}">{{ $label }}</label>
</div>
