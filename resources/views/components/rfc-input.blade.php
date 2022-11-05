<input id="rfc"
       name="rfc"
       type="text"
       maxlength="13"
       minlength="12"
       required
       oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'form-control']) !!}>
