<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold bg-gradient-to-r from-rose-500 to-purple-600 bg-clip-text text-transparent">Selamat Datang</h2>
        <p class="text-sm text-slate-500 mt-2">Masuk untuk menulis artikel hari ini</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-rose-700/80 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-rose-700/80 font-medium" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-2">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-md border-pink-200 text-rose-500 shadow-sm focus:ring-rose-400" name="remember">
                <span class="ms-2 text-xs text-slate-500">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-xs text-slate-500 hover:text-rose-600 rounded-md focus:outline-none focus:ring-2 focus:ring-rose-400" href="{{ route('password.request') }}">
                    {{ __('Lupa sandi?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-rose-400 via-pink-500 to-purple-500 text-white font-semibold rounded-xl shadow-lg shadow-pink-100/80 hover:shadow-pink-200/80 transition-all duration-300 hover:scale-[1.02] focus:ring-2 focus:ring-rose-400 focus:outline-none flex items-center justify-center cursor-pointer">
                {{ __('Masuk Sekarang') }}
            </button>
        </div>

        <div class="text-center pt-4 border-t border-pink-100/50">
            <p class="text-xs text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="text-rose-500 font-semibold hover:underline">Daftar di sini</a></p>
        </div>
    </form>
</x-guest-layout>
