@props(['tipo_persona' => 'F', 'disabled' => false])

<div class="basis-1/2 flex flex-row justify-start">
    <input type="radio"
           class="self-center mr-4 focus:ring-slate-200"
           id="tipo_persona_fisica"
           name="tipo_persona"
           x-model="tipoPersona"
           value="F"
           {{ $tipo_persona === 'F' ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}
    >
    <label
        :class="tipoPersona === 'F' ? 'font-bold text-lg text-mtv-secondary' : 'text-lg text-mtv-gray'"
        for="tipo_persona_fisica">Física</label>
</div>
<div class="basis-1/2 flex flex-row justify-end">
    <input type="radio"
           class="self-center mr-4 focus:ring-slate-200"
           id="tipo_persona_moral"
           name="tipo_persona"
           x-model="tipoPersona"
           value="M"
           {{ $tipo_persona === 'M' ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}
    >
    <label
        :class="tipoPersona === 'M' ? 'font-bold text-lg text-mtv-secondary' : 'text-lg text-mtv-gray'"
        for="tipo_persona_moral">Moral</label>
</div>
