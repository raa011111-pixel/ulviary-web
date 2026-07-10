<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif italic font-bold text-2xl text-rose-900 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-3xl border border-pink-100/40 p-8">
                <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Kategori -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-rose-700/80 mb-1">Nama Kategori <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" placeholder="Contoh: Kuliner, Teknologi, Gaya Hidup" 
                               class="w-full rounded-xl border border-pink-100 bg-white/50 text-slate-800 placeholder-slate-400 focus:border-rose-400 focus:ring focus:ring-rose-200/50 transition duration-150 @error('name') border-rose-500 @enderror">
                        @error('name')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-rose-700/80 mb-1">Deskripsi Singkat</label>
                        <textarea name="description" id="description" rows="4" placeholder="Tuliskan deskripsi singkat mengenai kategori ini..." 
                                  class="w-full rounded-xl border border-pink-100 bg-white/50 text-slate-800 placeholder-slate-400 focus:border-rose-400 focus:ring focus:ring-rose-200/50 transition duration-150 @error('description') border-rose-500 @enderror">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-pink-100/50">
                        <a href="{{ route('categories.index') }}" class="px-5 py-2.5 rounded-xl border border-pink-100 text-rose-500 hover:bg-rose-50/50 font-semibold text-sm transition duration-150">
                            Batal
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white font-semibold px-6 py-2.5 rounded-xl transition duration-150 shadow-md shadow-pink-100 text-sm cursor-pointer">
                            Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
