<input id="rfc"
       name="rfc"
       type="text"
       placeholder="RFC con homoclave"
       maxlength="13"
       minlength="12"
       oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'form-control']) !!}>
