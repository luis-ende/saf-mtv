<x-app-layout>
    <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="min-h-screen login-page justify-center">                
            <div class="">
                <h1>Bienvenido a Mi Tiendita Virtual</h1>
                <h2>URGs</h2>

                @php($queryParams = count(request()->query()) > 0 ? '?' . http_build_query(request()->query()) : '')
                <div class="form-register">
                    <form method="POST" action="{{ route('login') . $queryParams }}">
                        @csrf
                                
                        <div class="mtv-input-wrapper">
                            <input id="rfc"
                                name="rfc"
                                type="text"                                
                                class="mtv-text-input"
                                maxlength=13
                                required
                                oninput="this.value = this.value.toUpperCase()">
                            <label class="mtv-input-label" for="rfc">Usuario</label>
                        </div>
                                    
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
                                {{-- <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="remember">{{ __('Recordar credenciales') }}</span>
                                </label>
        
                                @if (Route::has('password.request'))
                                    <a class="recover-password" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                                </div> --}}
        
                            <div class="button-content">
                                <button id="btn_login" class="btn-signUp">
                                    Ingresar
                                </button>
                            </div>
                        </div>                
                    </form>  
                </div>
            </div>                                   
        </div>
    </div>
</x-app-layout>
    
    
    