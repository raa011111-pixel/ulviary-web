<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-serif italic font-bold text-2xl text-rose-900 leading-tight">
                {{ __('Daftar Artikel Anda') }}
            </h2>
            <a href="{{ route('articles.create') }}" class="bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white font-semibold px-5 py-2.5 rounded-xl transition duration-200 shadow-md shadow-pink-100 text-sm">
                + Tulis Artikel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Alert success -->
            @if(session('success'))
                <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-rose-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-rose-800 font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-2xl border border-pink-100/40">
                <div class="p-6 text-gray-900">
                    @if($articles->isEmpty())
                        <div class="text-center py-12">
                            <span class="text-4xl">📝</span>
                            <h3 class="mt-2 text-sm font-semibold text-slate-800">Belum ada artikel</h3>
                            <p class="mt-1 text-sm text-slate-500">Mulai menulis gagasan dan publikasikan artikel pertama Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('articles.create') }}" class="inline-flex items-center bg-gradient-to-r from-rose-400 to-pink-500 text-white font-semibold px-4 py-2 rounded-xl transition duration-200 text-sm shadow-sm">
                                    + Tulis Artikel
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Mobile stacked layout (hidden on desktop) -->
                        <div class="md:hidden space-y-4">
                            @foreach($articles as $article)
                                <div class="bg-white/80 border border-pink-100/40 p-5 rounded-2xl shadow-sm flex flex-col space-y-3">
                                    <div class="flex items-start gap-3">
                                        <div class="flex-shrink-0">
                                            @if($article->thumbnail)
                                                <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" class="h-14 w-20 object-cover rounded-xl border border-pink-100/40 shadow-sm">
                                            @else
                                                <div class="h-14 w-20 bg-pink-50/40 rounded-xl flex items-center justify-center border border-pink-100/30">
                                                    <span class="text-xl">📷</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <span class="text-xs font-semibold text-rose-600 block mb-0.5">{{ $article->category->name }}</span>
                                            <h4 class="text-sm font-bold text-slate-800 leading-tight truncate">{{ $article->title }}</h4>
                                            <div class="flex items-center gap-2 mt-2">
                                                @if($article->status === 'published')
                                                    <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full bg-pink-50 text-pink-600 border border-pink-200/50">
                                                        Published
                                                    </span>
                                                @else
                                                    <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full bg-orange-50 text-orange-600 border border-orange-200/45">
                                                        Draft
                                                    </span>
                                                @endif
                                                <span class="text-[10px] text-slate-400 font-medium">{{ $article->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-2 border-t border-pink-100/25 pt-3">
                                        @if($article->status === 'published')
                                            <a href="{{ route('public.articles.show', $article->slug) }}" target="_blank" class="text-pink-600 hover:text-pink-900 bg-pink-50 hover:bg-pink-100 px-3 py-1.5 rounded-xl transition duration-150 text-xs font-bold">
                                                Lihat
                                            </a>
                                        @endif
                                        <a href="{{ route('articles.edit', $article) }}" class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1.5 rounded-xl transition duration-150 text-xs font-bold">
                                            Edit
                                        </a>
                                        <button type="button" 
                                                @click="deleteAction = '{{ route('articles.destroy', $article) }}'; showDeleteModal = true"
                                                class="text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-xl transition duration-150 cursor-pointer text-xs font-bold">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Desktop table layout (hidden on mobile) -->
                        <div class="hidden md:block overflow-x-auto rounded-2xl border border-pink-100/30">
                            <table class="min-w-full divide-y divide-pink-100/50">
                                <thead class="bg-rose-50/50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Thumbnail</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Judul</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Tanggal Dibuat</th>
                                        <th class="px-6 py-3 text-right text-xs font-bold text-rose-900 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/30 divide-y divide-pink-100/35">
                                    @foreach($articles as $article)
                                        <tr class="hover:bg-rose-50/20 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($article->thumbnail)
                                                    <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" class="h-10 w-16 object-cover rounded-lg border border-pink-100/40 shadow-sm">
                                                @else
                                                    <div class="h-10 w-16 bg-pink-50/40 rounded-lg flex items-center justify-center border border-pink-100/30">
                                                        <span class="text-lg">📷</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm font-bold text-slate-800 max-w-xs truncate">
                                                {{ $article->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-600 border border-rose-100/50">
                                                    {{ $article->category->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($article->status === 'published')
                                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-pink-50 text-pink-600 border border-pink-200/50">
                                                        Published
                                                    </span>
                                                @else
                                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-orange-50 text-orange-600 border border-orange-200/45">
                                                        Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                                                {{ $article->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    @if($article->status === 'published')
                                                        <a href="{{ route('public.articles.show', $article->slug) }}" target="_blank" class="text-pink-600 hover:text-pink-900 bg-pink-50 hover:bg-pink-100 px-3 py-1.5 rounded-xl transition duration-150">
                                                            Lihat
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('articles.edit', $article) }}" class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1.5 rounded-xl transition duration-150">
                                                        Edit
                                                    </a>
                                                    <button type="button" 
                                                            @click="deleteAction = '{{ route('articles.destroy', $article) }}'; showDeleteModal = true"
                                                            class="text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-xl transition duration-150 cursor-pointer">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $articles->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
