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
                <!-- RFC -->
                <div>
                    <x-input-label for="rfc" :value="__('RFC')" />

                    <x-rfc-input id="rfc" class="form-control"
                                 name="rfc"
                                 :value="old('rfc')" />

                    <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
                </div>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección de contacto</label>
                <input type="text" class="form-control" id="direccion">
            </div>
            <div class="form-group">
                <label for="contacto">Contacto</label>
                <input type="text" class="form-control" id="contacto">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono Fijo</label>
                <input type="text" class="form-control" id="telefono">
            </div>
            <div class="form-group">
                <label for="correo_electronico">Correo Electrónico Principal</label>
                <input type="text" class="form-control" id="correo_electronico">
            </div>
            <div class="form-group">
                <label for="grupo_prioritario">Perteneces a algún grupo prioritario</label>
                <select class="form-control" id="grupo_prioritario">
                    <option value="value1">Value 1</option>
                    <option value="value2" selected>Value 2</option>
                    <option value="value3">Value 3</option>
                </select>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <input class="btn btn-primary" type="submit" value="Siguiente">
        </form>
    </div>
</x-guest-layout>
