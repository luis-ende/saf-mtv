<div class="mtv-input-wrapper">
    <input id="rfc"
           name="rfc"
           type="text"
           {{ $attributes }}
           required
           oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'mtv-text-input']) !!}>
    <label class="mtv-input-label" for="rfc">RFC con homoclave</label>
</div>
