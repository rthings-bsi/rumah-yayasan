<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Data Asrama') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto" x-data="{ search: '' }">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
            <div class="animate-slide-in-left">
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    {{ __('Manajemen Asrama') }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 flex items-center gap-2">
                    <span class="w-8 h-px bg-indigo-500/30"></span>
                    {{ __('Kelola dan pantau persebaran anak di tiap hunian.') }}
                </p>
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto animate-fade-in">
                <div class="relative flex-1 md:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" x-model="search" placeholder="{{ __('Cari asrama...') }}" 
                           class="form-input-modern pl-10 h-11">
                </div>
                
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('asramas.create') }}" class="btn btn-primary h-11 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="hidden sm:inline">{{ __('Tambah Asrama') }}</span>
                </a>
                @endif
            </div>
        </div>

        {{-- Success Flash --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 class="mb-6 flex items-center gap-3 text-emerald-700 dark:text-emerald-400 bg-emerald-50/50 dark:bg-emerald-500/10 backdrop-blur-md border border-emerald-100 dark:border-emerald-500/20 p-4 rounded-2xl animate-fade-in">
                <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Stats Summary --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
            <div class="stat-card accent-indigo animate-fade-in-up">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Total Asrama') }}</p>
                <div class="flex items-end justify-between mt-2">
                    <p class="text-3xl font-black text-slate-800 dark:text-white">{{ $asramas->count() }}</p>
                    <div class="icon-box indigo opacity-50"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg></div>
                </div>
            </div>
            <div class="stat-card accent-emerald animate-fade-in-up delay-75">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Total Anak') }}</p>
                <div class="flex items-end justify-between mt-2">
                    <p class="text-3xl font-black text-slate-800 dark:text-white">{{ $asramas->sum('children_count') }}</p>
                    <div class="icon-box emerald opacity-50"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                </div>
            </div>
            <div class="stat-card accent-amber animate-fade-in-up delay-150">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Anak Aktif') }}</p>
                <div class="flex items-end justify-between mt-2">
                    <p class="text-3xl font-black text-slate-800 dark:text-white">{{ $asramas->sum('active_children_count') }}</p>
                    <div class="icon-box amber opacity-50"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                </div>
            </div>
            <div class="stat-card accent-rose animate-fade-in-up delay-225">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Asrama Kosong') }}</p>
                <div class="flex items-end justify-between mt-2">
                    <p class="text-3xl font-black text-slate-800 dark:text-white">{{ $asramas->where('children_count', 0)->count() }}</p>
                    <div class="icon-box rose opacity-50"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg></div>
                </div>
            </div>
        </div>

        {{-- Asrama Grid --}}
        @if($asramas->isEmpty())
            <div class="glass-card py-20 text-center animate-fade-in">
                <div class="w-20 h-20 rounded-3xl bg-slate-100 dark:bg-slate-700/50 flex items-center justify-center mx-auto mb-6 animate-float">
                    <svg class="w-10 h-10 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200">{{ __('Belum Ada Data Asrama') }}</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-2 max-w-sm mx-auto">{{ __('Mulai dengan menambahkan asrama baru untuk mengelompokkan data anak.') }}</p>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('asramas.create') }}" class="btn btn-primary mt-8">
                        {{ __('Tambah Asrama Pertama') }}
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($asramas as $index => $asrama)
                    <div x-show="!search || '{{ strtolower($asrama->nama_asrama) }}'.includes(search.toLowerCase()) || '{{ strtolower($asrama->kode_asrama) }}'.includes(search.toLowerCase())"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="animate-fade-in-up" 
                         style="animation-delay: {{ ($index % 8) * 50 }}ms">
                        
                        <div class="glass-card group overflow-hidden h-full flex flex-col relative active:scale-[0.98] transition-transform">
                            {{-- Action Buttons (Hover) --}}
                            @if(auth()->user()->role === 'admin')
                            <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                <a href="{{ route('asramas.edit', $asrama) }}" class="w-8 h-8 rounded-lg bg-white/90 dark:bg-slate-800/90 shadow-sm flex items-center justify-center text-amber-500 hover:bg-amber-500 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('asramas.destroy', $asrama) }}" method="POST" onsubmit="return confirm('Hapus asrama ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-white/90 dark:bg-slate-800/90 shadow-sm flex items-center justify-center text-rose-500 hover:bg-rose-500 hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                            @endif

                            <a href="{{ route('asramas.show', $asrama) }}" class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-4 mb-5">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform duration-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400">{{ $asrama->kode_asrama }}</span>
                                        <h3 class="font-bold text-slate-800 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $asrama->nama_asrama }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="mt-auto space-y-3">
                                    <div class="bg-slate-50 dark:bg-white/5 rounded-xl p-3 border border-slate-100 dark:border-white/10">
                                        <div class="flex justify-between items-center mb-1.5">
                                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ __('Anak Aktif') }}</span>
                                            <span class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $asrama->active_children_count }} / {{ $asrama->children_count }}</span>
                                        </div>
                                        <div class="w-full h-1.5 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all duration-1000" 
                                                 style="width: {{ $asrama->children_count > 0 ? ($asrama->active_children_count / $asrama->children_count) * 100 : 0 }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between px-1">
                                        <div class="flex -space-x-2">
                                            @for($i=0; $i < min($asrama->children_count, 3); $i++)
                                                <div class="w-6 h-6 rounded-full border-2 border-white dark:border-slate-800 bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                                </div>
                                            @endfor
                                            @if($asrama->children_count > 3)
                                                <div class="w-6 h-6 rounded-full border-2 border-white dark:border-slate-800 bg-indigo-50 dark:bg-indigo-500/20 flex items-center justify-center text-[8px] font-bold text-indigo-600 dark:text-indigo-400">
                                                    +{{ $asrama->children_count - 3 }}
                                                </div>
                                            @endif
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 group-hover:text-indigo-500 transition-colors">
                                            {{ __('Lihat Detail') }} &rarr;
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
