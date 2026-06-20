<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">Galeri</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
            <div>
                <h1 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">Galeri Foto</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium">Kelola galeri foto untuk website.</p>
            </div>
            <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Foto
            </a>
        </div>

        {{-- Grid View --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($galleries as $gallery)
            <div class="glass-card overflow-hidden group shadow-premium animate-fade-in-up">
                <div class="relative aspect-[4/3] overflow-hidden">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-3 left-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                        <div class="flex items-center justify-between">
                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" onsubmit="return confirm('Yakin ingin menghapus foto ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-white/20 backdrop-blur-sm rounded-xl text-white hover:bg-rose-500/60 transition-all" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="p-2 bg-white/20 backdrop-blur-sm rounded-xl text-white hover:bg-amber-500/60 transition-all" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400 mb-2">
                        {{ $gallery->category }}
                    </span>
                    <h3 class="text-sm font-bold text-slate-800 dark:text-white mt-1.5 line-clamp-1">{{ $gallery->title }}</h3>
                    @if($gallery->description)
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $gallery->description }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100 dark:border-slate-700/50">
                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Urutan: {{ $gallery->order }}</span>
                        <span class="text-[10px] text-slate-400">{{ $gallery->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="glass-card p-16 text-center">
                    <svg class="w-20 h-20 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Belum ada foto galeri.</p>
                    <a href="{{ route('admin.galleries.create') }}" class="text-green-600 hover:text-green-700 text-sm font-bold mt-2 inline-block">Upload foto pertama</a>
                </div>
            </div>
            @endforelse
        </div>

        @if($galleries->hasPages())
            <div class="mt-8">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
