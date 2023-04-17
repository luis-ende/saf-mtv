<x-app-layout :with_background_color="false" :show_menu_bar="false" :show_main_menu="false">
    @section('page_title', 'Inicio de sesión Proveedor')
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="login-page">
        <div class="login-page-left">
            <img src="{{ asset('images/ilustracion_login.svg') }}" alt="Imagen de Mi Tiendita Virtual">
        </div>

        <div class="login-page-rigth">
            <h1>Bienvenido a Mi Tiendita Virtual</h1>
            <h2>Has llegado al espacio donde podrás promover tu negocio y encontrar oportunidades para venderle al Gobierno de la Ciudad de México.</h2>

            @php($queryParams = count(request()->query()) > 0 ? '?' . http_build_query(request()->query()) : '')
            <div class="form-register">
                <form method="POST" action="{{ route('login') . $queryParams }}">
                    @csrf

                    <!-- RFC -->
                    <x-rfc-validacion-input id="rfc"
                                            name="rfc"
                                            modo="login"
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
                            <span class="remember">Recordar credenciales</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="recover-password" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <button id="btn_login" class="mtv-button-secondary">
                        Ingresar
                    </button>
                </form>
                <div class="mt-20">
                    <p class="register">¿Aún no tienes tu cuenta?
                        <br>
                        <a class="register-link font-bold" href="{{ route('registro-inicio') }}">Regístrate</a>
                    </p>
                    <div class='dotted-spaced'></div>
                    <div class="register-providers my-3">
                        <p class="my-0">¿Estás registrado en el padrón de proveedores?</p>
                        <a href="https://tianguisdigital.finanzas.cdmx.gob.mx/login"
                           class="mtv-link-gold font-bold">Ingresa aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


