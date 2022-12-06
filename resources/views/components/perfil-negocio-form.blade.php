@props(['mode' => 'wizard', 'step' => null, 'wizard', 'persona' => null, 'tipos_vialidad' => null])

@php($idTipoPersona = isset($persona) ? $persona->id_tipo_persona : (isset($step) ? $step['tipo_persona'] : old('tipo_persona')))
@php($rfc = isset($persona) ? $persona->rfc : (isset($step) && isset($step['rfc']) ? $step['rfc'] : old('rfc')))
@php($rfcSinH = isset($persona) ? ($persona->id_tipo_persona === 'F' ? $persona->tipo_persona->rfc_sin_homoclave() : '') : (isset($step) && isset($step['rfc_sin_homoclave']) ? $step['rfc_sin_homoclave'] : old('rfc_sin_homoclave')))
@php($homoclave = isset($persona) ? ($persona->id_tipo_persona === 'F' ? $persona->tipo_persona->homoclave() : '') : '')
@php($curp = isset($persona) ? ($persona->id_tipo_persona === 'F' ? $persona->tipo_persona->curp : '') : (isset($step) ? $step['curp'] : old('curp')))
@php($fechaNacimiento = isset($persona) ? ($persona->id_tipo_persona === 'F' ? date('d/m/Y', strtotime($persona->tipo_persona->fecha_nacimiento)) : '') : (isset($step) ? $step['fecha_nacimiento'] : old('fecha_nacimiento')))
@php($genero = isset($persona) ? ($persona->id_tipo_persona === 'F' ? $persona->tipo_persona->genero : '') : (isset($step) ? $step['genero'] : old('genero')))
@php($nombre = isset($persona) ? ($persona->id_tipo_persona === 'F' ? $persona->tipo_persona->nombre : '') : (isset($step) ? $step['nombre'] : old('nombre')))
@php($primerAp = isset($persona) ? ($persona->id_tipo_persona === 'F' ? $persona->tipo_persona->primer_ap : '') : (isset($step) ? $step['primer_ap'] : old('primer_ap')))
@php($segundoAp = isset($persona) ? ($persona->id_tipo_persona === 'F' ? $persona->tipo_persona->segundo_ap : '') : (isset($step) ? $step['segundo_ap'] : old('segundo_ap')))
@php($fechaConstitucion = isset($persona) ? $persona->fecha_constitucion : ( isset($step) ? $step['fecha_constitucion'] : old('fecha_constitucion')))
@php($razonSocial = isset($persona) ? $persona->razon_social : ( isset($step) ? $step['razon_social'] : old('razon_social')))

@isset ($step)
    @php($tipos_vialidad = $step['tipos_vialidad'])
@endisset

@if ($mode === 'wizard')
    @if ($wizard['id'])
        @php($formAction = route('wizard.registro-mtv.update', [$wizard['id'], 'perfil-negocio']))
    @else
        @php($formAction = route('wizard.registro-mtv.store'))
    @endif
@elseif ($mode === 'edit')
    @php($formAction = route('perfil-negocio.update'))
@endif

<div class="container" x-data="perfilNegocioValidaciones()" x-init="onChangeTipoPersona(tipoPersona)">
    <form id="perfil_negocio_form" method="POST" class="row g-3" action="{{ $formAction }}">
        @csrf

        {{-- Los campos de la sección Datos personales de Persona física sólo están habilitados en modo 'wizard'  --}}
        <div class="card p-0">
            <div class="card-header">
                <label class="text-[#BC955C] font-bold">Datos personales</label>
            </div>
            <div class="card-body row g-3">
                <div class="form-group col-md-3">
                    <label class="mr-5 font-medium">Eres persona</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tipo_persona_fisica">física</label>
                        <input type="radio"
                               class="form-check-input"
                               x-model="tipoPersona"
                               id="tipo_persona_fisica"
                               name="tipo_persona"
                               value="F"
                               @change="onChangeTipoPersona($event.target.value)"
                               {{ $mode === 'edit' ? 'disabled' : '' }}
                        >
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="tipo_persona_moral">moral</label>
                        <input type="radio"
                               class="form-check-input"
                               x-model="tipoPersona"
                               id="tipo_persona_moral"
                               name="tipo_persona"
                               value="M"
                               @change="onChangeTipoPersona($event.target.value)"
                               {{ $mode === 'edit' ? 'disabled' : '' }}
                        >
                    </div>
                </div>
                <div class="form-group col-md-3" x-show="tipoPersona === 'F'">                    
                    @if ($mode === 'wizard')
                        <x-curp-input value="{{ $curp }}" x-bind:required="tipoPersona === 'F'"/>                        
                        <x-input-error :messages="$errors->get('curp')" class="mt-2"/>
                    @else
                        <input type="text" class="form-control" id="curp" value="{{ $curp }}" disabled>
                        <label class="mvt-input-label" for="curp">CURP:</label>
                    @endif
                </div>
                <div class="form-group col-md-3" x-show="tipoPersona === 'F'">
                    <label class="font-medium" for="rfc_sin_homoclave">RFC:</label>
                    <input type="text" class="form-control"
                           style="background-color: #efefef"
                           id="rfc_sin_homoclave"
                           name="rfc_sin_homoclave"
                           value="{{ $rfcSinH ?? '' }}"
                           readonly>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-medium" for="rfc" x-text="tipoPersona === 'F' ? 'Homoclave:' : 'RFC con homoclave:'"></label>
                    @if ($mode === 'wizard')
                        <x-rfc-validacion-input value="{{ $rfc }}"/>
                        <x-input-error :messages="$errors->get('rfc_completo')" class="mt-2"/>
                    @else
                        <x-rfc-input value="{{ $idTipoPersona === 'F' ? $homoclave : $rfc }}" disabled />
                    @endif
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label class="font-medium" for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="text" class="form-control" style="background-color: #efefef" id="fecha_nacimiento"
                           name="fecha_nacimiento" value="{{ $fechaNacimiento }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label class="font-medium" for="genero">Género:</label>
                    <input type="text" class="form-control" style="background-color: #efefef" id="genero"
                           name="genero" value="{{ $genero }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label class="font-medium" for="nombre">Nombre:</label>
                    <input type="text" class="form-control" style="background-color: #efefef" id="nombre"
                           name="nombre" value="{{ $nombre }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label class="font-medium" for="primer_ap">Primer apellido:</label>
                    <input type="text" class="form-control" style="background-color: #efefef" id="primer_ap"
                           name="primer_ap" value="{{ $primerAp }}">
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label class="font-medium" for="segundo_ap">Segundo apellido:</label>
                    <input type="text" class="form-control" style="background-color: #efefef" id="segundo_ap"
                           name="segundo_ap" value="{{ $segundoAp }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'M'">
                    <label class="font-medium" for="fecha_constitucion">Fecha de constitución:</label>
                    <input type="date" class="form-control" id="fecha_constitucion" name="fecha_constitucion"
                           value="{{ $fechaConstitucion }}"
                           x-bind:required="tipoPersona === 'M'"
                    >
                    <x-input-error :messages="$errors->get('rfc')" class="mt-2"/>
                </div>
                <div class="form-group col-md-12" x-show="tipoPersona === 'M'">
                    <label class="font-medium" for="razon_social">Razón social:</label>
                    <input type="text" class="form-control" id="razon_social" name="razon_social"
                           value="{{ $razonSocial }}"
                           x-bind:required="tipoPersona === 'M'"
                    >
                    <x-input-error :messages="$errors->get('razon_social')" class="mt-2"/>
                </div>
            </div>
        </div>

        <div class="card p-0">
            <div class="card-header">
                <label class="text-[#BC955C] font-bold">Dirección</label>
            </div>
            <div class="card-body row g-3">
                <x-direccion-input
                    :step="$step"
                    :direccion="isset($persona) ? $persona->direccion() : null"
                    :tipos_vialidad="$tipos_vialidad"
                />
            </div>
        </div>
        <div class="card p-0">
            <div class="card-header">
                <label class="text-[#BC955C] font-bold">Contactos</label>
            </div>
            <div class="card-body row g-3">
                <x-contactos-lista
                    :persona="$persona"
                    :step="$step"
                />
            </div>
        </div>

        <div class="card p-0">
            <div class="card-header">
                <label class="text-[#BC955C] font-bold">Contraseña</label>
            </div>
            <div class="card-body row g-3">
                <div class="form-group col-md-6">
                    <label class="font-medium" for="password">Contraseña:</label>
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  autocomplete="new-password"
                                  :is_required="$mode === 'wizard'"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-medium" for="password_confirmation">Confirmar contraseña:</label>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation"
                                  :is_required="$mode === 'wizard'"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>
            </div>
        </div>
        <div class="py-4 flex justify-content-end">
            @if ($mode === 'wizard')
                <button
                    id="btn_perfil_negocio_siguiente"
                    class="btn btn-primary"
                    @click="if (!validaPerfilNegocioDatos()) { event.preventDefault() }">
                    Siguiente
                    @svg('heroicon-s-arrow-right-circle', ['class' => 'h-5 w-5 inline-block'])
                </button>
            @elseif ($mode === 'edit')
                <button class="btn btn-primary" type="submit">
                    @svg('gmdi-save-as', ['class' => 'h-5 w-5 inline-block mr-1'])
                    Guardar
                </button>
            @endif
        </div>
    </form>
</div>

<script>
    function perfilNegocioValidaciones() {
        return {
            tipoPersona: '{{ $idTipoPersona ?? 'F' }}',
            mode: {!! json_encode($mode) !!},

            validaPerfilNegocioDatos() {
                if (this.tipoPersona === 'M') {
                    document.getElementById('rfc_sin_homoclave').value = '';
                    document.getElementById('rfc_completo').value = document.getElementById('rfc').value;
                }

                if (document.getElementById('contactos_lista').value === '[]') {
                    Swal.fire({
                        title: 'Información incompleta',
                        html: 'Se requiere al menos un contacto en la lista de contactos.',
                        icon: "error",
                    })

                    return false;
                }

                return true;
            },
            onChangeTipoPersona(tipoPersona) {
                if (this.mode === 'wizard') {
                    let rfcInput = document.getElementById('rfc');
                    let curpInput = document.getElementById('curp');
                    if (tipoPersona === 'F') {
                        rfcInput.maxLength = 3; // Para homoclave
                        curpInput.focus();
                    } else if (tipoPersona === 'M') {
                        rfcInput.maxLength = 12; // Para RFC con homoclave
                        rfcInput.focus();
                    }
                }
            }
        }
    }
</script>
