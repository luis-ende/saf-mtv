<x-input-label for="rfc" :value="__('RFC')" />
<input id="rfc"
       name="rfc"
       type="text"
       {{ $attributes }}
       required
       oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'mtv-text-input']) !!}>
