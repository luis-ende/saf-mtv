{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    @php($tiposVialidad = [])
    @isset ($step)
        @php($tiposVialidad = $step['tipos_vialidad'])
    @endisset

    <div class="container">
        <h1>{{ $wizard['title'] }}</h1>
        <h2>1. Tu Perfil de Negocio</h2><br>

        @if ($wizard['id'])
            @php($wizardId = $wizard['id'])
            <form id="perfil_negocio_form" method="POST" class="row g-3" action="{{ route('wizard.registro-mtv.update', [$wizardId, 'perfil-negocio']) }}">
        @else
            <form id="perfil_negocio_form" method="POST" class="row g-3" action="{{ route('wizard.registro-mtv.store') }}">
        @endif

        @php($tipoPersona = $step['tipo_persona'] ?? old('tipo_persona'))

            @csrf

            <div x-data="perfilNegocioValidaciones()">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Soy</label>
                        <div class="form-check">
                            <label class="form-check-label" for="tipo_persona_fisica">Persona física</label>
                            <input type="radio"
                                   class="form-check-input"
                                   x-model="tipoPersona"
                                   id="tipo_persona_fisica"
                                   name="tipo_persona"
                                   value="F"
                            >
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="tipo_persona_moral">Persona moral</label>
                            <input class="form-check-input"
                                   type="radio"
                                   x-model="tipoPersona"
                                   id="tipo_persona_moral"
                                   name="tipo_persona"
                                   value="M"
                            >
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                        <label for="curp">CURP:</label>
                        <x-curp-input value="{{ $step['curp'] ?? old('curp') }}" x-bind:required="tipoPersona === 'F'" />
                        <x-input-error :messages="$errors->get('curp')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rfc">RFC con homoclave:</label>
                        <x-rfc-validacion-input value="{{ $step['rfc'] ?? old('rfc') }}" />
                        <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                        <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $step['fecha_nacimiento'] ?? old('fecha_nacimiento') }}" disabled>
                    </div>
                    <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                        <label for="genero">Género:</label>
                        <input type="text" class="form-control" id="genero" name="genero" value="{{ $step['genero'] ?? old('genero') }}" disabled>
                    </div>
                    <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $step['nombre'] ?? old('nombre') }}" disabled>
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                        <label for="primer_ap">Primer apellido:</label>
                        <input type="text" class="form-control" id="primer_ap" name="primer_ap" value="{{ $step['primer_ap'] ?? old('primer_ap') }}" disabled>
                        <x-input-error :messages="$errors->get('primer_ap')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                        <label for="segundo_ap">Segundo apellido:</label>
                        <input type="text" class="form-control" id="segundo_ap" name="segundo_ap" value="{{ $step['segundo_ap'] ??  old('segundo_ap') }}" disabled>
                        <x-input-error :messages="$errors->get('segundo_ap')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-4" x-show="tipoPersona === 'M'">
                        <label for="fecha_constitucion">Fecha de constitución:</label>
                        <input type="date" class="form-control" id="fecha_constitucion" name="fecha_constitucion"
                               value="{{ $step['fecha_constitucion'] ?? old('fecha_constitucion') }}"
                               x-bind:required="tipoPersona === 'M'"
                        >
                        <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-12" x-show="tipoPersona === 'M'">
                        <label for="razon_social">Razón social:</label>
                        <input type="text" class="form-control" id="razon_social" name="razon_social"
                               value="{{ $step['razon_social'] ?? old('razon_social') }}"
                               x-bind:required="tipoPersona === 'M'"
                        >
                        <x-input-error :messages="$errors->get('razon_social')" class="mt-2" />
                    </div>
                </div>

                <hr>
                <div class="card">
                    <div class="card-header">
                        Dirección
                    </div>
                    <div class="card-body row g-3">
                        <x-direccion-input
                            :step="$step"
                            :tipos_vialidad="$tiposVialidad"
                        />
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">
                        Contactos
                    </div>
                    <div class="card-body row g-3">
                        <x-contactos-lista
                            :step="$step"
                        />
                    </div>
                </div>
                <hr>
                <div class="row">
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
                <br>
                <button
                    id="btn_perfil_negocio_siguiente"
                    @click="if (!validaPerfilNegocioDatos()) { event.preventDefault() }"
                    class="btn btn-primary">Siguiente</button>
            </div>
        </form>
    </div>
</x-guest-layout>

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
