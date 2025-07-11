<x-guest-layout>
    {{-- Language Switcher --}}
    <div class="relative mb-4 text-end">
        <button id="lang-button" type="button"
            class="flex items-center text-sm border px-3 py-2 rounded shadow-sm focus:outline-none focus:ring">
            <img src="{{ asset('assets/' . app()->getLocale() . '.png') }}" class="w-5 h-5 me-2" alt="flag">
            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <div id="lang-menu" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded-md shadow-lg z-50">
            <a href="{{ route('lang.switch', 'id') }}"
                class="block px-4 py-2 text-sm hover:bg-gray-100 {{ app()->getLocale() == 'id' ? 'bg-gray-100 font-semibold' : '' }}">
                🇮🇩 Indonesia
            </a>
            <a href="{{ route('lang.switch', 'en') }}"
                class="block px-4 py-2 text-sm hover:bg-gray-100 {{ app()->getLocale() == 'en' ? 'bg-gray-100 font-semibold' : '' }}">
                🇺🇸 English
            </a>
        </div>
    </div>

    <script>
        document.getElementById('lang-button').addEventListener('click', function() {
            const menu = document.getElementById('lang-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="text" name="hp_field" style="display: none;" tabindex="-1" autocomplete="off">

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('auth.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('auth.password_name')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('auth.remember') }}
                </span>

            </label>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('auth.forgot_password') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('auth.login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
