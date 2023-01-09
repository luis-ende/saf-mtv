@props(['rfc_input_label' => 'RFC con homoclave'])

<div class="mtv-input-wrapper">
    <input id="rfc"
           name="rfc"
           type="text"
           {{ $attributes }}
           maxlength=13
           required
           oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'mtv-text-input']) !!}>
    <label class="mtv-input-label" for="rfc">{{ $rfc_input_label }}</label>
</div>
