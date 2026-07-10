<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold bg-gradient-to-r from-rose-500 to-purple-600 bg-clip-text text-transparent">Lupa Kata Sandi?</h2>
        <p class="text-sm text-slate-500 mt-2">Jangan khawatir, kami akan membantu memulihkan akun Anda</p>
    </div>

    <div class="mb-6 text-xs text-slate-500 bg-rose-50/50 p-4 rounded-xl border border-rose-100/50 leading-relaxed">
        {{ __('Masukkan alamat email Anda yang terdaftar di bawah ini, dan kami akan mengirimkan tautan untuk menyetel ulang kata sandi Anda.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-rose-700/80 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl border-pink-100/80 focus:border-rose-400 focus:ring focus:ring-rose-200/50 bg-white/50" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-rose-400 via-pink-500 to-purple-500 text-white font-semibold rounded-xl shadow-lg shadow-pink-100/80 hover:shadow-pink-200/80 transition-all duration-300 hover:scale-[1.02] focus:ring-2 focus:ring-rose-400 focus:outline-none flex items-center justify-center cursor-pointer">
                {{ __('Kirim Tautan Atur Ulang') }}
            </button>
        </div>

        <div class="text-center pt-4 border-t border-pink-100/50">
            <p class="text-xs text-slate-500">Kembali ke halaman <a href="{{ route('login') }}" class="text-rose-500 font-semibold hover:underline">Masuk</a></p>
        </div>
    </form>
</x-guest-layout>
