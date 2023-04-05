@props(['tipo_persona' => 'F', 'disabled' => false])

<div class="basis-1/2 flex flex-row justify-start">
    <input type="radio"
           class="self-center mr-4 focus:ring-slate-200"
           id="tipo_persona_fisica"
           name="tipo_persona"
           x-model="tipoPersona"
           value="{{ App\Models\Persona::TIPO_PERSONA_FISICA_ID }}"
           {{ $tipo_persona === App\Models\Persona::TIPO_PERSONA_FISICA_ID ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}
    >
    <label
        class="text-base md:text-lg"
        :class="tipoPersona === '{{ App\Models\Persona::TIPO_PERSONA_FISICA_ID  }}' ? 'font-bold text-mtv-secondary' : 'text-mtv-gray'"
        for="tipo_persona_fisica">Física</label>
</div>
<div class="basis-1/2 flex flex-row justify-end">
    <input type="radio"
           class="self-center mr-4 focus:ring-slate-200"
           id="tipo_persona_moral"
           name="tipo_persona"
           x-model="tipoPersona"
           value="{{ App\Models\Persona::TIPO_PERSONA_MORAL_ID }}"
           {{ $tipo_persona === App\Models\Persona::TIPO_PERSONA_MORAL_ID ? 'checked' : '' }}
           {{ $disabled ? 'disabled' : '' }}
    >
    <label
        class="text-base md:text-lg"
        :class="tipoPersona === '{{ App\Models\Persona::TIPO_PERSONA_MORAL_ID }}' ? 'font-bold text-mtv-secondary' : 'text-mtv-gray'"
        for="tipo_persona_moral">Moral</label>
</div>
