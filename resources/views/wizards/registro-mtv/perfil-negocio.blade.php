{{--@include('layouts.registro-navigation')--}}
<x-guest-layout>
    <div class="container">
        {{ $wizard['title'] }}
        <h1>1. Tu Perfil de Negocio</h1><br>

        @error('wizard')
            <div class="bg-red-300 text-red-700 px-6 py-4">
                <span class="font-semibold">Whoops!</span>
                {{ $message }}
            </div>
        @enderror

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
                             :value="old('rfc')" />

                <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
            </div>
            <div class="form-group">
                <label for="nombre">Nombre o razón social:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="primer_ap">Primer apellido:</label>
                <input type="text" class="form-control" id="primer_ap" name="primer_ap">
            </div>
            <div class="form-group">
                <label for="segundo_ap">Segundo apellido:</label>
                <input type="text" class="form-control" id="segundo_ap" name="segundo_ap">
            </div>

            <input type="hidden" id="id_asentamiento" value="1" name="id_asentamiento">

            <div class="form-group">
                <label for="cp">Código postal:</label>
                <input type="text" class="form-control" id="cp" name="cp">
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
                <input type="text" class="form-control" id="vialidad" name="vialidad">
            </div>
            <div class="form-group">
                <label for="num_ext">Número exterior:</label>
                <input type="text" class="form-control" id="num_ext" name="num_ext">
            </div>
            <div class="form-group">
                <label for="num_int">Número interior:</label>
                <input type="text" class="form-control" id="num_int" name="num_int">
            </div>

            <!-- Dirección fiscal -->
            <input type="hidden" id="id_asentamiento" value="1" name="id_asentamiento">            

            <label>Dirección fiscal:</label>
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

            <div class="form-group">
                <label>Teléfono fijo:</label>
                <label for="lada">Lada internacional</label>
                <input type="text" class="form-control" id="lada" name="lada">
            </div>
            <div class="form-group">                
                <label for="telefono_fijo">Numérico a 10 dígitos</label>
                <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo">
            </div>
            <div class="form-group">                
                <label for="extension">Ext.</label>
                <input type="text" class="form-control" id="extension" name="extension">
            </div>
            <div class="form-group">                
                <label for="telefono_movil">Teléfono móvil:</label>
                <input type="text" class="form-control" id="telefono_movil" name="telefono_movil">
            </div>
            <div class="form-group">                
                <label for="email">Correo electrónico principal:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">                
                <label for="email_alterno">Correo electrónico alternativo:</label>
                <input type="email" class="form-control" id="email_alterno" name="email_alterno">
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