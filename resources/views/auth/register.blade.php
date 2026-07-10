<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold bg-gradient-to-r from-rose-500 to-purple-600 bg-clip-text text-transparent">Daftar Akun Baru</h2>
        <p class="text-sm text-slate-500 mt-2">Buat akun untuk mulai membagikan ide-ide kreatif Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-rose-700/80 font-medium" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-rose-700/80 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" class="text-rose-700/80 font-medium" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-rose-700/80 font-medium" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-rose-400 via-pink-500 to-purple-500 text-white font-semibold rounded-xl shadow-lg shadow-pink-100/80 hover:shadow-pink-200/80 transition-all duration-300 hover:scale-[1.02] focus:ring-2 focus:ring-rose-400 focus:outline-none flex items-center justify-center cursor-pointer">
                {{ __('Daftar Akun') }}
            </button>
        </div>

        <div class="text-center pt-4 border-t border-pink-100/50">
            <p class="text-xs text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="text-rose-500 font-semibold hover:underline">Masuk di sini</a></p>
        </div>
    </form>
</x-guest-layout>
