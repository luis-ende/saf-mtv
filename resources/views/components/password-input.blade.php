@props(['label_id' => 'password', 'label' => '', 'show_validations' => false])

@if($show_validations)
<div x-data="passwordValidation()">
@endif
    <div class="mtv-input-wrapper relative" x-data="{ show: true }">
        <input
            {{ $attributes }}
            class="mtv-text-input"
            :type="show ? 'password' : 'text'"
            autocomplete="new-password"
            maxlength="15"
            @if($show_validations)
            @change="validaPassword($event)"
            @keyup="validaPassword($event)"
            @endif>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
            @svg('fas-eye', ['class' => 'h-5 w-5 mt-4 text-mtv-text-gray-light', '@click' => 'show = !show', ':class' => "{'hidden': !show, 'block':show}"])
            @svg('fas-eye-slash', ['class' => 'h-5 w-5 mt-4 text-mtv-text-gray-light', '@click' => 'show = !show', ':class' => "{'block': !show, 'hidden':show}"])
        </div>
        <label class="mtv-input-label" for="{{ $label_id }}">{{ $label }}</label>
    </div>
    <x-input-error :messages="$errors->get('{{ $label_id }}')" class="mt-2"/>

    @if($show_validations)
    <div class="text-xs text-mtv-text-gray mt-1">
        Tu contraseña debe tener al menos:
        <ul class="list-outside p-0 ml-1 mt-1">
            <li>
                @svg('fas-check', ['class' => 'w-4 h-4 mr-1 text-green-500 inline-block', 'x-show' => 'contieneLetraMayuscula'])
                @svg('sui-cross', ['class' => 'w-4 h-4 mr-1 text-red-500 inline-block', 'x-show' => '!contieneLetraMayuscula'])
                Una letra mayúscula</li>
            <li>
                @svg('fas-check', ['class' => 'w-4 h-4 mr-1 text-green-500 inline-block', 'x-show' => 'contieneNumeros'])
                @svg('sui-cross', ['class' => 'w-4 h-4 mr-1 text-red-500 inline-block', 'x-show' => '!contieneNumeros'])
                Números
            </li>
            <li>
                @svg('fas-check', ['class' => 'w-4 h-4 mr-1 text-green-500 inline-block', 'x-show' => 'contieneCaracteresEspeciales'])
                @svg('sui-cross', ['class' => 'w-4 h-4 mr-1 text-red-500 inline-block', 'x-show' => '!contieneCaracteresEspeciales'])
                Caracteres especiales (@$!%*#?)
            </li>
            <li>
                @svg('fas-check', ['class' => 'w-4 h-4 mr-1 text-green-500 inline-block', 'x-show' => 'tieneLongitudCorrecta'])
                @svg('sui-cross', ['class' => 'w-4 h-4 mr-1 text-red-500 inline-block', 'x-show' => '!tieneLongitudCorrecta'])
                Entre 8 y 15 caracteres
            </li>
        </ul>
    </div>
    @endif
@if($show_validations)
</div>
@endif

@if($show_validations)
<script type="text/javascript">
    function passwordValidation() {
        return {
            contieneLetraMayuscula: false,
            contieneNumeros: false,
            contieneCaracteresEspeciales: false,
            tieneLongitudCorrecta: false,

            validaPassword(e) {
                const password = e.target.value;

                this.contieneLetraMayuscula = false;
                this.contieneNumeros = false;
                this.contieneCaracteresEspeciales = false;
                this.tieneLongitudCorrecta = false;

                if (password !== '') {
                    this.tieneLongitudCorrecta = password.length >= 8 && password.length <= 15;
                    this.contieneNumeros = /\d/.test(password);
                    this.contieneCaracteresEspeciales = /[@$!%*#?]/.test(password);
                    this.contieneLetraMayuscula = password.match(/[A-Z]/);
                }
            }
        }
    }
</script>
@endif
