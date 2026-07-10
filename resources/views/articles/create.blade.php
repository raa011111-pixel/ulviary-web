<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif italic font-bold text-2xl text-rose-900 leading-tight">
            {{ __('Tulis Artikel Baru') }}
        </h2>
    </x-slot>

    <!-- Include Quill Editor CSS -->
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
        <style>
            .ql-toolbar.ql-snow {
                border-color: #fce7f3 !important; /* pink-100 */
                background-color: #fff5f6; /* blush-50 */
                border-top-left-radius: 0.75rem;
                border-top-right-radius: 0.75rem;
            }
            .ql-container.ql-snow {
                border-color: #fce7f3 !important;
                border-bottom-left-radius: 0.75rem;
                border-bottom-right-radius: 0.75rem;
                background-color: rgba(255, 255, 255, 0.5);
            }
        </style>
    @endpush

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($categories->isEmpty())
                <div class="bg-orange-50 border-l-4 border-orange-500 p-6 rounded-2xl shadow-sm mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0 text-xl">
                            ⚠️
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-orange-800">Kategori diperlukan!</h3>
                            <p class="text-sm text-orange-700 mt-1">Anda harus membuat minimal satu kategori terlebih dahulu sebelum dapat menulis artikel.</p>
                            <div class="mt-4">
                                <a href="{{ route('categories.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-4 py-2 rounded-xl transition duration-150 text-xs">
                                    + Buat Kategori Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-3xl border border-pink-100/40 p-8">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" id="article-form" class="space-y-6">
                    @csrf

                    <!-- Judul Artikel -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-rose-700/80 mb-1">Judul Artikel <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Tuliskan judul artikel yang menarik..." 
                               class="w-full rounded-xl border border-pink-100 bg-white/50 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-rose-400 focus:ring focus:ring-rose-200/50 transition duration-150 @error('title') border-rose-500 @enderror" required>
                        @error('title')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-rose-700/80 mb-1">Kategori <span class="text-rose-500">*</span></label>
                            <select name="category_id" id="category_id" 
                                    class="w-full rounded-xl border border-pink-100 bg-white/50 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-rose-400 focus:ring focus:ring-rose-200/50 transition duration-150 @error('category_id') border-rose-500 @enderror" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-rose-700/80 mb-1">Status Publikasi <span class="text-rose-500">*</span></label>
                            <select name="status" id="status" 
                                    class="w-full rounded-xl border border-pink-100 bg-white/50 px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-rose-400 focus:ring focus:ring-rose-200/50 transition duration-150 @error('status') border-rose-500 @enderror" required>
                                <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft (Simpan Internal)</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                            </select>
                            @error('status')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Gambar Thumbnail -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-semibold text-rose-700/80 mb-1">Gambar Thumbnail (Opsional)</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 file:cursor-pointer hover:file:bg-rose-100 border border-pink-100/80 rounded-xl p-1 bg-white/50 transition duration-150 focus:outline-none @error('thumbnail') border-rose-500 @enderror">
                        <p class="text-xs text-slate-400 mt-1">Format file: JPEG, PNG, JPG, GIF, WEBP (Maksimal 2 MB)</p>
                        @error('thumbnail')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Galeri Foto Artikel -->
                    <div>
                        <label for="gallery" class="block text-sm font-semibold text-rose-700/80 mb-1">Galeri Foto Artikel (Maksimal 5 gambar)</label>
                        <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 file:cursor-pointer hover:file:bg-rose-100 border border-pink-100/80 rounded-xl p-1 bg-white/50 transition duration-150 focus:outline-none @error('gallery') border-rose-500 @enderror">
                        <p class="text-xs text-slate-400 mt-1">Anda bisa memilih hingga 5 gambar sekaligus. Format file: JPEG, PNG, JPG, GIF, WEBP (Maksimal 2 MB per gambar).</p>
                        @error('gallery')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('gallery.*')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konten Editor (Quill.js) -->
                    <div>
                        <label class="block text-sm font-semibold text-rose-700/80 mb-1">Isi Artikel <span class="text-rose-500">*</span></label>
                        
                        <!-- Quill editor container -->
                        <div class="rounded-xl overflow-hidden border border-pink-100/85 focus-within:border-rose-400 focus-within:ring-2 focus-within:ring-rose-200/50 transition duration-150 @error('content') border-rose-500 @enderror">
                            <div id="editor-container" class="min-h-[300px]">
                                {!! old('content') !!}
                            </div>
                        </div>
                        
                        <!-- Hidden input to store Quill content -->
                        <input type="hidden" name="content" id="content-input" value="{{ old('content') }}">
                        
                        @error('content')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-pink-100/50">
                        <a href="{{ route('articles.index') }}" class="px-5 py-2.5 rounded-xl border border-pink-100 text-rose-500 hover:bg-rose-50/50 font-semibold text-sm transition duration-150">
                            Batal
                        </a>
                        <button type="submit" @disabled($categories->isEmpty()) class="bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 disabled:from-slate-200 disabled:to-slate-300 disabled:cursor-not-allowed text-white font-semibold px-6 py-2.5 rounded-xl transition duration-150 shadow-md shadow-pink-100 text-sm cursor-pointer">
                            Terbitkan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Quill Editor JS Script -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var quill = new Quill('#editor-container', {
                    theme: 'snow',
                    placeholder: 'Tuliskan isi artikel Anda secara lengkap di sini...',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['link', 'blockquote', 'code-block'],
                            ['clean']
                        ]
                    }
                });

                // Sync Quill editor contents to the hidden input on form submit
                var form = document.getElementById('article-form');
                form.addEventListener('submit', function() {
                    var contentInput = document.getElementById('content-input');
                    var text = quill.getText().trim();
                    if (text.length === 0) {
                        contentInput.value = '';
                    } else {
                        contentInput.value = quill.root.innerHTML;
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
