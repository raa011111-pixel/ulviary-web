<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif italic font-bold text-2xl text-rose-900 leading-tight">
            {{ __('Edit Artikel') }}
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
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-3xl border border-pink-100/40 p-8">
                <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" id="article-form" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul Artikel -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-rose-700/80 mb-1">Judul Artikel <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" placeholder="Tuliskan judul artikel yang menarik..." 
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
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
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
                                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft (Simpan Internal)</option>
                                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published (Publikasikan)</option>
                            </select>
                            @error('status')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Gambar Thumbnail -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-semibold text-rose-700/80 mb-1">Gambar Thumbnail</label>
                        
                        @if($article->thumbnail)
                            <div class="mb-3 flex items-center space-x-3">
                                <img src="{{ asset($article->thumbnail) }}" alt="Thumbnail saat ini" class="h-20 w-32 object-cover rounded-xl border border-pink-100/40 shadow-sm">
                                <span class="text-xs text-slate-500">Thumbnail saat ini</span>
                            </div>
                        @endif

                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 file:cursor-pointer hover:file:bg-rose-100 border border-pink-100/80 rounded-xl p-1 bg-white/50 transition duration-150 focus:outline-none @error('thumbnail') border-rose-500 @enderror">
                        <p class="text-xs text-slate-400 mt-1">Format file: JPEG, PNG, JPG, GIF, WEBP (Maksimal 2 MB). Biarkan kosong jika tidak ingin mengubah thumbnail.</p>
                        @error('thumbnail')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Galeri Foto Artikel -->
                    <div class="space-y-4 pt-4 border-t border-pink-100/30">
                        <label class="block text-sm font-semibold text-rose-700/80 mb-1">Galeri Foto Artikel (Maksimal 5 gambar)</label>

                        <!-- Existing Gallery Photos -->
                        @if($article->gallery->isNotEmpty())
                            <div class="mb-4">
                                <span class="text-xs text-slate-400 block mb-2">Foto Galeri Saat Ini (Pilih gambar untuk dihapus):</span>
                                <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                                    @foreach($article->gallery as $img)
                                        <div class="relative group rounded-xl overflow-hidden border border-pink-100/40 shadow-sm bg-white/50 p-1 flex flex-col items-center">
                                            <img src="{{ asset($img->image_path) }}" alt="Gallery Image" class="h-20 w-full object-cover rounded-lg">
                                            <label class="mt-2 flex items-center gap-1.5 cursor-pointer">
                                                <input type="checkbox" name="delete_gallery_ids[]" value="{{ $img->id }}" class="rounded text-rose-500 border-pink-200 focus:ring-rose-400 h-3.5 w-3.5">
                                                <span class="text-[10px] text-rose-600 font-bold">Hapus</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 file:cursor-pointer hover:file:bg-rose-100 border border-pink-100/80 rounded-xl p-1 bg-white/50 transition duration-150 focus:outline-none @error('gallery') border-rose-500 @enderror">
                        <p class="text-xs text-slate-400 mt-1">Anda bisa memilih hingga 5 gambar sekaligus (termasuk yang sudah ada). Format file: JPEG, PNG, JPG, GIF, WEBP (Maksimal 2 MB per gambar).</p>
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
                                {!! old('content', $article->content) !!}
                            </div>
                        </div>
                        
                        <!-- Hidden input to store Quill content -->
                        <input type="hidden" name="content" id="content-input" value="{{ old('content', $article->content) }}">
                        
                        @error('content')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-pink-100/50">
                        <a href="{{ route('articles.index') }}" class="px-5 py-2.5 rounded-xl border border-pink-100 text-rose-500 hover:bg-rose-50/50 font-semibold text-sm transition duration-150">
                            Batal
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white font-semibold px-6 py-2.5 rounded-xl transition duration-150 shadow-md shadow-pink-100 text-sm cursor-pointer">
                            Perbarui Artikel
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
