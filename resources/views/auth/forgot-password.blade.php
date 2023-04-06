<x-app-layout :with_background_color="false">
    <x-auth-card>
        <div class="uppercase text-mtv-primary font-bold border-l-4 border-mtv-primary p-2 mb-2"> 
            ¿Olvidaste tu contraseña?
        </div>                    
        <div class="text-mtv-text-gray text-base">
            Te ayudamos a recuperarla. ¿Cuál es el R.F.C. que registraste?
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="my-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <x-rfc-input 
                id="rfc"
                name="rfc"
                maxlength="13"
                :rfc_input_label="__('RFC')"
                :modo="__('reset-password')" />                            
            <div class="flex items-center justify-end mt-4">
                <button id="btn_login" class="mtv-button-secondary">
                    {{ __('Enviar') }}
                </button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
