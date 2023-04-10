<x-app-layout :with_background_color="false">
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mt-4">
                <x-password-input
                        id="password"
                        name="password"
                        label_id="password"
                        label="Contraseña"
                        required
                />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <div class="flex justify-end mt-4">
                <button type="submit" class="mtv-button-primary">
                    Confirmar
                </button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
