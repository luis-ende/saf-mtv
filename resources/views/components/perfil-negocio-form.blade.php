@props(['mode' => 'wizard', 'step' => [], 'wizard'])

@php($tiposVialidad = [])

@php($tipoPersona = isset($persona) ? $persona->tipo_persona : (isset($step) ? $step['tipo_persona'] : old('tipo_persona')))
@php($rfc = isset($persona) ? $persona->rfc : (isset($step) ? $step['rfc'] : old('rfc')))
@php($curp = isset($persona) ? $persona->curp : (isset($step) ? $step['curp'] : old('curp')))
@php($fechaNacimiento = isset($persona) ? $persona->fecha_nacimiento : (isset($step) ? $step['fecha_nacimiento'] : old('fecha_nacimiento')))
@php($genero = isset($persona) ? $persona->genero : (isset($step) ? $step['genero'] : old('genero')))
@php($nombre = isset($persona) ? $persona->nombre : (isset($step) ? $step['nombre'] : old('nombre')))
@php($primerAp = isset($persona) ? $persona->primer_ap : (isset($step) ? $step['primer_ap'] : old('primer_ap')))
@php($segudoAp = isset($persona) ? $persona->segundo_ap : (isset($step) ? $step['segundo_ap'] : old('segundo_ap')))
@php($fechaConstitucion = isset($persona) ? $persona->fecha_constitucion : ( isset($step) ? $step['fecha_constitucion'] : old('fecha_constitucion')))
@php($razonSocial = isset($persona) ? $persona->razon_social : ( isset($step) ? $step['razon_social'] : old('razon_social')))

@isset ($step)
    @php($tiposVialidad = $step['tipos_vialidad'])
@endisset

@if ($mode === 'wizard')
    @if ($wizard['id'])
        @php($formAction = route('wizard.registro-mtv.update', [$wizard['id'], 'perfil-negocio']))
    @else
        @php($formAction = route('wizard.registro-mtv.store'))
    @endif
@endif

<div class="container" x-data="perfilNegocioValidaciones()">
    <form id="perfil_negocio_form" method="POST" class="row g-3" action="{{ $formAction }}">
        @csrf

        <div class="card p-0">
            <div class="card-header">
                <label class="text-[#BC955C] font-bold">Datos personales</label>
            </div>
            <div class="card-body row g-3">
                <div class="form-group col-md-4">
                    <label>Eres persona</label>
                    <div class="form-check">
                        <label class="form-check-label" for="tipo_persona_fisica">física</label>
                        <input type="radio"
                               class="form-check-input"
                               x-model="tipoPersona"
                               id="tipo_persona_fisica"
                               name="tipo_persona"
                               value="F"
                        >
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="tipo_persona_moral">moral</label>
                        <input class="form-check-input"
                               type="radio"
                               x-model="tipoPersona"
                               id="tipo_persona_moral"
                               name="tipo_persona"
                               value="M"
                        >
                    </div>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="curp">CURP:</label>
                    <x-curp-input value="{{ $curp }}" x-bind:required="tipoPersona === 'F'" />
                    <x-input-error :messages="$errors->get('curp')" class="mt-2" />
                </div>
                <div class="form-group col-md-4">
                    <label for="rfc">RFC con homoclave:</label>
                    <x-rfc-validacion-input value="{{ $rfc }}" />
                    <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="text" class="form-control" style="background-color: lightgray" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $fechaNacimiento }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="genero">Género:</label>
                    <input type="text" class="form-control" style="background-color: lightgray" id="genero" name="genero" value="{{ $genero }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" style="background-color: lightgray" id="nombre" name="nombre" value="{{ $nombre }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="primer_ap">Primer apellido:</label>
                    <input type="text" class="form-control" style="background-color: lightgray" id="primer_ap" name="primer_ap" value="{{ $primerAp }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="segundo_ap">Segundo apellido:</label>
                    <input type="text" class="form-control" style="background-color: lightgray" id="segundo_ap" name="segundo_ap" value="{{ $segudoAp }}" readonly>
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'M'">
                    <label for="fecha_constitucion">Fecha de constitución:</label>
                    <input type="date" class="form-control" id="fecha_constitucion" name="fecha_constitucion"
                           value="{{ $fechaConstitucion }}"
                           x-bind:required="tipoPersona === 'M'"
                    >
                    <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                </div>
                <div class="form-group col-md-12" x-show="tipoPersona === 'M'">
                    <label for="razon_social">Razón social:</label>
                    <input type="text" class="form-control" id="razon_social" name="razon_social"
                           value="{{ $razonSocial }}"
                           x-bind:required="tipoPersona === 'M'"
                    >
                    <x-input-error :messages="$errors->get('razon_social')" class="mt-2" />
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
                    :tipos_vialidad="$tiposVialidad"
                />
            </div>
        </div>
        <div class="card p-0">
            <div class="card-header">
                <label class="text-[#BC955C] font-bold">Contactos</label>
            </div>
            <div class="card-body row g-3">
                <x-contactos-lista
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
                    <label for="password">Contraseña:</label>
                    <x-text-input id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmar contraseña:</label>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if ($mode === 'wizard')
                    <div class="py-4">
                        <button
                            id="btn_perfil_negocio_siguiente"
                            class="btn btn-primary"
                            @click="if (!validaPerfilNegocioDatos()) { event.preventDefault() }">Siguiente</button>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>

<script>
    function perfilNegocioValidaciones() {
        return {
            tipoPersona: '{{ $tipoPersona ?? 'F' }}',

            validaPerfilNegocioDatos() {
                if (document.getElementById('contactos_lista').value === '[]') {
                    Swal.fire({
                        title: 'Información incompleta',
                        html: 'Se requiere al menos un contacto en la lista de contactos.',
                        icon: "error",
                    })

                    return false;
                }

                return true;
            }
        }
    }
</script>
