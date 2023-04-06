<x-app-layout :with_background_color="false">
    <x-auth-card>
        <div class="uppercase text-mtv-primary font-bold border-l-4 border-mtv-primary p-2 mb-2">
            Recuperación de contraseña
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mtv-input-wrapper">
                <input id="email"
                       class="mtv-text-input"
                       type="email" name="email"
                       value="{{ old('email', $request->email) }}"
                       readonly autofocus>
                <label class="mtv-input-label" for="email">Correo electrónico</label>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

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

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-password-input
                        id="password_confirmation"
                        name="password_confirmation"
                        label_id="password_confirmation"
                        label="Confirmar contraseña"
                        required
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="mtv-button-primary">
                    Reestablecer contraseña
                </button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
