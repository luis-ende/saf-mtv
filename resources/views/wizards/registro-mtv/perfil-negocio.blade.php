{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    <div class="container">
        {{ $wizard['title'] }}
        <h1>1. Tu Perfil de Negocio</h1><br>

        @if ($wizard['id'])
            @php($wizardId = $wizard['id'])
            <form method="POST" action="{{ route('wizard.registro-mtv.update', [$wizardId, 'perfil-negocio']) }}">
        @else
            <form method="POST" action="{{ route('wizard.registro-mtv.store') }}">
        @endif

            @csrf

            <div class="form-group">
                <x-input-label for="rfc" :value="__('RFC')" />

                <x-rfc-input id="rfc" class="form-control"
                             name="rfc"
                             :value="$step['rfc'] ?? old('rfc')" />

                <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
            </div>
            <div class="form-group">
                <label for="nombre">Nombre o razón social:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $step['nombre'] ?? old('nombre') }}" required>
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>
            <div class="form-group">
                <label for="primer_ap">Primer apellido:</label>
                <input type="text" class="form-control" id="primer_ap" name="primer_ap" value="{{ $step['primer_ap'] ?? old('primer_ap') }}">
                <x-input-error :messages="$errors->get('primer_ap')" class="mt-2" />
            </div>
            <div class="form-group">
                <label for="segundo_ap">Segundo apellido:</label>
                <input type="text" class="form-control" id="segundo_ap" name="segundo_ap" value="{{ $step['segundo_ap'] ??  old('segundo_ap') }}">
                <x-input-error :messages="$errors->get('segundo_ap')" class="mt-2" />
            </div>
            <div class="form-group">
                <label for="nombre_contacto">Persona a contactar:</label>
                <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="{{ $step['nombre_contacto'] ??  old('nombre_contacto') }}">                
            </div>

            <input type="hidden" id="id_asentamiento" value="1" name="id_asentamiento">

            <div class="card">
                <div class="card-header">
                    Dirección de contacto
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="cp">Código postal:</label>
                        <input type="text" class="form-control" id="cp" name="cp" required>
                    </div>
                    <div class="form-group">
                        <label for="entidad_federativa">Entidad federativa:</label>
                        <input type="text" class="form-control" id="entidad_federativa" name="entidad_federativa">
                    </div>
                    <div class="form-group">
                        <label for="alcaldia">Alcaldía:</label>
                        <input type="text" class="form-control" id="alcaldia" name="alcaldia">
                    </div>
                    <div class="form-group">
                        <label for="colonia">Colonia:</label>
                        <input type="text" class="form-control" id="colonia" name="colonia">
                    </div>
                    <div class="form-group">
                        <label for="tipo_vialidad">Tipo vialidad:</label>
                        <input type="text" class="form-control" id="tipo_vialidad" name="tipo_vialidad">
                    </div>
                    <div class="form-group">
                        <label for="vialidad">Vialidad:</label>
                        <input type="text" class="form-control" id="vialidad" name="vialidad" value="{{ $step['vialidad'] ??  old('vialidad') }}">
                        <x-input-error :messages="$errors->get('vialidad')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="num_ext">Número exterior:</label>
                        <input type="text" class="form-control" id="num_ext" name="num_ext" value="{{ $step['num_ext'] ??  old('num_ext') }}">
                        <x-input-error :messages="$errors->get('num_ext')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="num_int">Número interior:</label>
                        <input type="text" class="form-control" id="num_int" name="num_int" value="{{ $step['num_int'] ??  old('num_int') }}">
                    </div>              
                    <div class="form-group">
                        <label>Teléfono fijo:</label>
                        <label for="lada">Lada internacional</label>
                        <input type="text" class="form-control" id="lada" name="lada" value="{{ $step['lada'] ?? old('lada') }}">
                        <x-input-error :messages="$errors->get('lada')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="telefono_fijo">Numérico a 10 dígitos</label>
                        <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" value="{{ $step['telefono_fijo'] ?? old('telefono_fijo') }}">
                        <x-input-error :messages="$errors->get('telefono_fijo')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="extension">Ext.</label>
                        <input type="text" class="form-control" id="extension" name="extension" value="{{ $step['extension'] ?? old('extension') }}">
                    </div>
                    <div class="form-group">
                        <label for="telefono_movil">Teléfono móvil:</label>
                        <input type="text" class="form-control" id="telefono_movil" name="telefono_movil" value="{{ $step['extension'] ?? old('extension') }}">
                        <x-input-error :messages="$errors->get('telefono_movil')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico principal:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $step['email'] ?? old('email') }}" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="email_alterno">Correo electrónico alternativo:</label>
                        <input type="email" class="form-control" id="email_alterno" name="email_alterno" value="{{ $step['email_alterno'] ?? old('email_alterno') }}">
                        <x-input-error :messages="$errors->get('email_alterno')" class="mt-2" />
                    </div>  
                </div>
            </div>            

            <div class="card">
                <div class="card-header">
                    Dirección fiscal
                </div>
                <div class="card-body">
                    <input type="hidden" id="id_asentamiento" value="1" name="id_asentamiento">                    
                    <div class="form-group">
                        <label for="cp_dfiscal">Código postal:</label>
                        <input type="text" class="form-control" id="cp_dfiscal" name="cp_dfiscal">
                    </div>
                    <div class="form-group">
                        <label for="entidad_federativa_dfiscal">Entidad federativa:</label>
                        <input type="text" class="form-control" id="entidad_federativa_dfiscal" name="entidad_federativa_dfiscal">
                    </div>
                    <div class="form-group">
                        <label for="alcaldia_dfiscal">Alcaldía:</label>
                        <input type="text" class="form-control" id="alcaldia_dfiscal" name="alcaldia_dfiscal">
                    </div>
                    <div class="form-group">
                        <label for="colonia_dfiscal">Colonia:</label>
                        <input type="text" class="form-control" id="colonia_dfiscal" name="colonia_dfiscal">
                    </div>
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

            <input class="btn btn-primary" type="submit" value="Siguiente">
        </form>
    </div>
</x-guest-layout>
