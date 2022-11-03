{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    {{ $step['rfc'] }}
    @php($tiposVialidad = [])
    @isset ($step)
        @php($tiposVialidad = $step['tipos_vialidad'])
    @endisset

    <div class="container">
        <h1>{{ $wizard['title'] }}</h1>
        <h2>1. Tu Perfil de Negocio</h2><br>

        @if ($wizard['id'])
            @php($wizardId = $wizard['id'])
            <form method="POST" class="row g-3" action="{{ route('wizard.registro-mtv.update', [$wizardId, 'perfil-negocio']) }}">
        @else
            <form method="POST" class="row g-3" action="{{ route('wizard.registro-mtv.store') }}">
        @endif

            @csrf

            <div x-data="{ tipoPersona: 'F' }">
                <div class="row">
                <div class="form-group col-md-4">
                    <div class="form-check">
                        <label class="form-check-label" for="tipo_persona_fisica">Persona física</label>
                        <input type="radio" class="form-check-input" x-model="tipoPersona" id="tipo_persona_fisica" name="tipo_persona" value="F" checked>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="tipo_persona_moral">Persona moral</label>
                        <input class="form-check-input" type="radio" x-model="tipoPersona" id="tipo_persona_moral" name="tipo_persona" value="M">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <x-input-label for="rfc" :value="__('RFC:')" />
                    <x-rfc-validacion-input :value="__('')" />
                    <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'M'">
                    <label for="razon_social">Razón social:</label>
                    <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ $step['razon_social'] ?? old('razon_social') }}" x-bind:required="tipoPersona != 'F'">
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="curp">CURP:</label>
                    <input type="text" class="form-control" id="curp" name="curp" value="{{ $step['curp'] ?? old('curp') }}" maxlength="18">
                    <x-input-error :messages="$errors->get('curp')" class="mt-2" />
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $step['nombre'] ?? old('nombre') }}">
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="primer_ap">Primer apellido:</label>
                    <input type="text" class="form-control" id="primer_ap" name="primer_ap" value="{{ $step['primer_ap'] ?? old('primer_ap') }}">
                    <x-input-error :messages="$errors->get('primer_ap')" class="mt-2" />
                </div>
                <div class="form-group col-md-4" x-show="tipoPersona === 'F'">
                    <label for="segundo_ap">Segundo apellido:</label>
                    <input type="text" class="form-control" id="segundo_ap" name="segundo_ap" value="{{ $step['segundo_ap'] ??  old('segundo_ap') }}">
                    <x-input-error :messages="$errors->get('segundo_ap')" class="mt-2" />
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_contacto">Persona a contactar:</label>
                <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="{{ $step['nombre_contacto'] ??  old('nombre_contacto') }}">
            </div>

            <input type="hidden" id="id_asentamiento" value="1" name="id_asentamiento">
            <hr>
            <div class="card">
                <div class="card-header">
                    Dirección de contacto
                </div>
                <div class="card-body row g-3">

                    <x-direccion-input :tipos_vialidad="$tiposVialidad" />

                    <div class="form-group col-md-3">
                        <label>Teléfono fijo:</label>
                        <label for="lada">Lada internacional</label>
                        <input type="text" class="form-control" id="lada" name="lada" value="{{ $step['lada'] ?? old('lada') }}">
                        <x-input-error :messages="$errors->get('lada')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono_fijo">Numérico a 10 dígitos</label>
                        <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" value="{{ $step['telefono_fijo'] ?? old('telefono_fijo') }}">
                        <x-input-error :messages="$errors->get('telefono_fijo')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="extension">Ext.</label>
                        <input type="text" class="form-control" id="extension" name="extension" value="{{ $step['extension'] ?? old('extension') }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono_movil">Teléfono móvil:</label>
                        <input type="text" class="form-control" id="telefono_movil" name="telefono_movil" value="{{ $step['extension'] ?? old('extension') }}">
                        <x-input-error :messages="$errors->get('telefono_movil')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email">Correo electrónico principal:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $step['email'] ?? old('email') }}" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email_alterno">Correo electrónico alternativo:</label>
                        <input type="email" class="form-control" id="email_alterno" name="email_alterno" value="{{ $step['email_alterno'] ?? old('email_alterno') }}">
                        <x-input-error :messages="$errors->get('email_alterno')" class="mt-2" />
                    </div>
                </div>
            </div>

            <hr>
            <div class="card">
                <div class="card-header">
                    Dirección fiscal
                </div>
                <div class="card-body">
                    <input type="hidden" id="id_asentamiento" value="1" name="id_asentamiento">

                    <!--<x-direccion-input />-->

                    <div class="form-group">
                        <label for="tipo_vialidad_dfiscal">Tipo vialidad:</label>
                        <input type="text" class="form-control" id="tipo_vialidad_dfiscal" name="tipo_vialidad_dfiscal">
                    </div>
                    <div class="form-group">
                        <label for="vialidad_dfiscal">Vialidad:</label>
                        <input type="text" class="form-control" id="vialidad_dfiscal" name="vialidad_dfiscal">
                    </div>
                    <div class="form-group">
                        <label for="num_ext_dfiscal">Número exterior:</label>
                        <input type="text" class="form-control" id="num_ext_dfiscal" name="num_ext_dfiscal">
                    </div>
                    <div class="form-group">
                        <label for="num_int_dfiscal">Número interior:</label>
                        <input type="text" class="form-control" id="num_int_dfiscal" name="num_int_dfiscal">
                    </div>
                </div>
            </div>

            <hr>
            <div class="form-group">
                <label for="grupo_prioritario">Perteneces a algún grupo prioritario:</label>
                <select class="form-control" id="grupo_prioritario" name="grupo_prioritario">
                    <option value="1" selected>MIPYMES</option>
                    <option value="2">SOCIEDADES COOPERATIVAS</option>
                    <option value="3">MUJERES EMPRENDEDORAS</option>
                    <option value="4">CAMPESINOS O COMUNIDADES INDÍGENAS</option>
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <br>
            <!-- TODO: Deshabilitar toda la sección para impedir continuar con el registro si el RFC ya existe? -->
            <button
                id="btn_perfil_negocio_siguiente"
                class="btn btn-primary">Siguiente</button>
        </form>
    </div>
</x-guest-layout>
