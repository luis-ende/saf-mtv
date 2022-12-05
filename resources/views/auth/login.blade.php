<x-app-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="text-slate-800 font-bold text-lg p-6 bg-white border-b border-gray-200">
            Inicio de sesión en Mi Tiendita Virtual
            @svg('entypo-login', ['class' => 'h-7 w-7 inline-block ml-1'])
        </div>
        <div class="p-6 bg-[#F7F3ED] rounded border-b border-gray-200 text-base text-center mb-3">
            Inicia sesión para actualizar tus datos, dar a conocer tus productos, y consultar tus notificaciones de oportunidades de negocio.
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- RFC -->
            <div class="mtv-input-wrapper">                
                <x-rfc-validacion-input id="rfc"
                                        name="rfc"
                                        :modo="__('login')"
                                        :value="old('rfc')" />
                <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 mtv-input-wrapper">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordar credenciales') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 px-3" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <button id="btn_login" class="btn btn-primary">
                    Iniciar sesión
                </button>
            </div>
        </form>
        <p class="font-bold my-3">Si ya cuentas con tu registro en el Padrón de Proveedores,
            <a href="https://tianguisdigital.finanzas.cdmx.gob.mx/login">ingresa aquí.</a></p>
    </x-auth-card>
</x-app-layout>
