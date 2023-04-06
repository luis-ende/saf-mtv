<x-app-layout>
    @section('page_title', 'Inicio de sesión Proveedor')
<!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="login-page">
        <div class="login-page-left">
            <!-- Aquí va la imagen que falta -->
        </div>

        <div class="login-page-rigth">
                <h1>Bienvenido a Mi Tiendita Virtual</h1>
                <h2>Has llegado al espacio donde podrás crear tu catálogo de productos y dar seguimiento a las convocatorias del Gobierno de la Ciudad de México</h2>
            
            @php($queryParams = count(request()->query()) > 0 ? '?' . http_build_query(request()->query()) : '')
            <div class="form-register">
                <form method="POST" action="{{ route('login') . $queryParams }}">
                    @csrf

                    <!-- RFC -->
                    <x-rfc-validacion-input id="rfc"
                                            name="rfc"
                                            :modo="__('login')"
                                            :value="old('rfc')" />
                    <x-input-error :messages="$errors->get('rfc')" class="mt-2" />

                    <!-- Password -->
                    <x-password-input
                        id="password"
                        name="password"
                        label_id="password"
                        label="Contraseña"
                        required
                    />

                    <!-- Remember Me -->
                    <div class="remember-password">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="remember">{{ __('Recordar credenciales') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="recover-password" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>

                    <div class="button-content">
                        <button id="btn_login" class="btn-signUp">
                            Ingresar
                        </button>
                    </div>
                </form>
                <p class="font-bold my-3 register">¿Aún no estás regístrado?
                    <br>
                    <a class="register-link" href="{{ route('registro-inicio') }}">Regístrate</a>
                </p>
            <div class="register-providers">
                    <p class="font-bold my-3">¿Estás registrado en el padrón de proveedores?
                        <br>
                        <a href="https://tianguisdigital.finanzas.cdmx.gob.mx/login">ingresa aquí.</a>
                    </p>
            </div>
        </div>
    </div>
</x-app-layout>


