<x-guest-layout>
<!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- NPM -->
        <div>
            <x-input-label for="npm" :value="__('NPM')" />
            <x-text-input id="npm" class="block mt-1 w-full" type="text" name="npm" :value="old('npm')" required autofocus autocomplete="username" />
            {{--
                Pesan error akan otomatis mengambil dari validasi di LoginRequest.
                Jika 'npm' gagal validasi atau autentikasi, pesan error akan muncul di sini.
                Pastikan $errors->get('npm') atau $errors->get('email') sesuai dengan field yang gagal.
                Karena kita ubah field utama login jadi 'npm' di LoginRequest, maka $errors->get('npm') yang relevan.
            --}}
            <x-input-error :messages="$errors->get('npm')" class="mt-2" />
            {{-- Jika pesan error dari auth.failed masih terkait 'email' secara hardcode di localization,
                 maka bisa jadi $errors->get('email') yang muncul. Tapi LoginRequest akan kita set agar
                 mengeluarkan error untuk field 'npm'. --}}
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
