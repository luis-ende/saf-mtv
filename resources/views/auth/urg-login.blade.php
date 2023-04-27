<x-app-layout :with_background_color="false">
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="min-h-screen bg-white">
        <div class="flex flex-col items-center justify-center my-20 bg-white px-3">
            <h1 class="text-mtv-secondary text-2xl font-bold text-center">Bienvenido a Mi Tiendita Virtual</h1>
            <h2 class="text-mtv-secondary text-lg font-bold">Unidades Responsables de Gasto</h2>
            <p class="text-sm md:text-base text-mtv-text-gray text-center">Inicia sesión para tener acceso a funcionalidades del sitio diseñadas sólo para Unidades Responsables de Gasto.</p>

            @php($queryParams = count(request()->query()) > 0 ? '?' . http_build_query(request()->query()) . '&urg_login=true' : '?urg_login=true')

            <form method="POST"
                  action="{{ route('login') . $queryParams }}"
                  class="basis-full flex flex-col items-center">
                @csrf

                <div class="mtv-input-wrapper">
                    <input id="rfc"
                        name="rfc"
                        type="text"
                        class="mtv-text-input"
                        maxlength=13
                        required
                        value="{{ old('rfc') }}"
                        oninput="this.value = this.value.toUpperCase()">
                    <label class="mtv-input-label" for="rfc">RFC</label>
                </div>

                <!-- Password -->
                <x-password-input
                    id="password"
                    name="password"
                    label_id="password"
                    label="Contraseña"
                    required
                />

                <div class="basis-full my-3">
                    <input id="remember_me"
                           type="checkbox"
                           class="w-4 h-4 mr-2 rounded border-gray-300 shadow-sm focus:border-mtv-secondary focus:ring focus:ring-mtv-secondary focus:ring-opacity-50"
                           name="remember">
                    <label for="remember_me" class="inline-flex items-center text-mtv-text-gray">
                        Recordar credenciales
                    </label>
                </div>

                <div class="my-3">
                    <button class="mtv-button-secondary">
                        Ingresar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
    
    
    