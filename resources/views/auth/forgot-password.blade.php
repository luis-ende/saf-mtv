<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Para restablecer su contraseña ingrese el RFC que utiliza para iniciar sesión.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="rfc" :value="__('RFC')" />

                <x-text-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" :value="old('rfc')" required autofocus />

                <x-input-error :messages="$errors->get('rfc')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button id="btn_login" class="btn btn-primary">
                    {{ __('Recuperar contraseña') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
