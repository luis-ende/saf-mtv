<input id="rfc"
       name="rfc"
       type="text"
       required autofocus
       data-rfc-existe="0"
       placeholder="RFC con homoclave"
       maxlength="13"
       oninput="this.value = this.value.toUpperCase()" {!! $attributes->merge(['class' => 'form-control']) !!}>
