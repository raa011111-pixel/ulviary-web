<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-serif italic font-bold text-2xl text-rose-900 leading-tight">
                {{ __('Daftar Kategori') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white font-semibold px-5 py-2.5 rounded-xl transition duration-200 shadow-md shadow-pink-100 text-sm">
                + Tambah Kategori
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
                    @if($categories->isEmpty())
                        <div class="text-center py-12">
                            <span class="text-4xl">🏷️</span>
                            <h3 class="mt-2 text-sm font-semibold text-slate-800">Belum ada kategori</h3>
                            <p class="mt-1 text-sm text-slate-500">Mulai dengan menambahkan kategori baru untuk artikel Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('categories.create') }}" class="inline-flex items-center bg-gradient-to-r from-rose-400 to-pink-500 text-white font-semibold px-4 py-2 rounded-xl transition duration-200 text-sm shadow-sm">
                                    + Tambah Kategori
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Mobile stacked layout (hidden on desktop) -->
                        <div class="md:hidden space-y-4">
                            @foreach($categories as $category)
                                <div class="bg-white/80 border border-pink-100/40 p-5 rounded-2xl shadow-sm flex flex-col space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-bold text-slate-800">{{ $category->name }}</span>
                                        <span class="text-[10px] text-slate-400 font-mono bg-rose-50 px-2 py-0.5 rounded-lg border border-pink-100/30">{{ $category->slug }}</span>
                                    </div>
                                    <p class="text-xs text-slate-500 line-clamp-2">{{ $category->description ?? 'Tidak ada deskripsi.' }}</p>
                                    <div class="flex items-center justify-between border-t border-pink-100/25 pt-3">
                                        <span class="text-[10px] text-slate-400">Dibuat: {{ $category->created_at->format('d M Y') }}</span>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('categories.edit', $category) }}" class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1.5 rounded-xl transition duration-150 text-xs font-bold">
                                                Edit
                                            </a>
                                            <button type="button" 
                                                    @click="deleteAction = '{{ route('categories.destroy', $category) }}'; showDeleteModal = true"
                                                    class="text-rose-600 hover:text-rose-900 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-xl transition duration-150 cursor-pointer text-xs font-bold">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Desktop table layout (hidden on mobile) -->
                        <div class="hidden md:block overflow-x-auto rounded-2xl border border-pink-100/30">
                            <table class="min-w-full divide-y divide-pink-100/50">
                                <thead class="bg-rose-50/50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Nama Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Slug</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Deskripsi</th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Tanggal Dibuat</th>
                                        <th class="px-6 py-3 text-right text-xs font-bold text-rose-900 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/30 divide-y divide-pink-100/35">
                                    @foreach($categories as $category)
                                        <tr class="hover:bg-rose-50/20 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-800">
                                                {{ $category->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-mono text-xs">
                                                {{ $category->slug }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-600 max-w-xs truncate">
                                                {{ $category->description ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                                                {{ $category->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('categories.edit', $category) }}" class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1.5 rounded-xl transition duration-150">
                                                        Edit
                                                    </a>
                                                    <button type="button" 
                                                            @click="deleteAction = '{{ route('categories.destroy', $category) }}'; showDeleteModal = true"
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
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
