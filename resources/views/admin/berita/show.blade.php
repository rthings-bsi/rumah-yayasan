<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('admin.berita.index') }}" class="hover:text-green-600 transition-colors">Berita</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $beritum->title }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.berita.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke daftar
            </a>
            <div class="flex gap-3">
                <a href="{{ route('admin.berita.edit', $beritum) }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-sm font-bold transition-all">
                    <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.berita.destroy', $beritum) }}" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-xl text-sm font-bold transition-all">
                        <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            @if($beritum->image)
                <div class="w-full h-64 md:h-80 overflow-hidden">
                    <img src="{{ asset('storage/' . $beritum->image) }}" alt="{{ $beritum->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-6 md:p-8">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-[11px] font-bold uppercase tracking-wider
                        @switch($beritum->category)
                            @case('Pendidikan') bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400 @break
                            @case('Kesehatan') bg-green-100 text-green-700 dark:bg-green-500/10 dark:text-green-400 @break
                            @case('Sosial') bg-purple-100 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400 @break
                            @case('Acara') bg-orange-100 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400 @break
                            @default bg-slate-100 text-slate-700 dark:bg-slate-500/10 dark:text-slate-400
                        @endswitch
                    ">{{ $beritum->category }}</span>

                    @if($beritum->status == 'published')
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-[11px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Published
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-[11px] font-bold uppercase tracking-wider bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Draft
                        </span>
                    @endif

                    @if($beritum->featured)
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-[11px] font-bold uppercase tracking-wider bg-amber-100 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            Featured
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-black text-slate-800 dark:text-white tracking-tight mb-4">{{ $beritum->title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 dark:text-slate-400 mb-6 pb-6 border-b border-slate-100 dark:border-slate-700/50">
                    <span>
                        <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ $beritum->author }}
                    </span>
                    <span>
                        <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $beritum->created_at->format('d F Y') }}
                    </span>
                    @if($beritum->published_at)
                        <span>
                            <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Dipublikasikan {{ $beritum->published_at->format('d F Y H:i') }}
                        </span>
                    @endif
                </div>

                @if($beritum->excerpt)
                    <div class="text-lg text-slate-600 dark:text-slate-300 font-medium mb-6 italic">
                        {{ $beritum->excerpt }}
                    </div>
                @endif

                <div class="prose prose-slate dark:prose-invert max-w-none">
                    {!! nl2br(e($beritum->content)) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
