<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm animate-fade-in">
            <a href="{{ route('asramas.index') }}" class="text-slate-500 hover:text-indigo-600 transition-colors font-medium">{{ __('Data Asrama') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-bold text-slate-800 dark:text-slate-100">{{ $asrama->kode_asrama }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto" x-data="{ childSearch: '' }">
        {{-- Profile Header --}}
        <div class="glass-card overflow-hidden mb-8 animate-fade-in-up">
            <div class="h-32 bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 relative">
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_1px_1px,#fff_1px,transparent_0)] [background-size:20px_20px]"></div>
            </div>
            <div class="px-8 pb-8 flex flex-col md:flex-row items-end gap-6 -mt-12 relative z-10">
                <div class="w-32 h-32 rounded-3xl bg-white dark:bg-slate-800 p-2 shadow-2xl shadow-indigo-500/20">
                    <div class="w-full h-full rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                </div>
                <div class="flex-1 mb-2">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-black rounded-lg uppercase tracking-widest border border-indigo-100 dark:border-indigo-500/20">
                            {{ $asrama->kode_asrama }}
                        </span>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('asramas.edit', $asrama) }}" class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-xl transition-all" title="Edit Asrama">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                        @endif
                    </div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $asrama->nama_asrama }}</h1>
                </div>
                <div class="flex gap-3 mb-2">
                    <a href="{{ route('children.create', ['asrama_id' => $asrama->id]) }}" class="btn btn-primary shadow-indigo-500/10 h-12">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        {{ __('Tambah Anak Ke Sini') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="stat-card accent-indigo animate-fade-in-up delay-75">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Total Penghuni') }}</p>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-4xl font-black text-slate-800 dark:text-white">{{ $asrama->children_count }}</p>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-indigo-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-emerald animate-fade-in-up delay-150">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Anak Aktif') }}</p>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-4xl font-black text-emerald-600 dark:text-emerald-400">{{ $asrama->active_count }}</p>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-blue animate-fade-in-up delay-225">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Anak Lulus') }}</p>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-4xl font-black text-blue-600 dark:text-blue-400">{{ $asrama->graduated_count }}</p>
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Children List --}}
        <div class="content-card overflow-hidden animate-fade-in-up delay-300">
            <div class="content-card-header flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-slate-50/50 dark:bg-white/5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 shadow-sm flex items-center justify-center text-indigo-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="section-title text-base">{{ __('Daftar Penghuni Asrama') }}</h3>
                </div>
                
                <div class="relative w-full md:w-64">
                    <input type="text" x-model="childSearch" placeholder="{{ __('Cari nama penghuni...') }}" 
                           class="form-input-modern pl-10 text-xs py-2">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>
            
            <div class="content-card-body p-0">
                @if($children->isEmpty())
                    <div class="text-center py-20">
                        <div class="w-16 h-16 rounded-2xl bg-slate-50 dark:bg-slate-700/50 flex items-center justify-center mx-auto mb-4 border border-slate-100 dark:border-slate-700">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-medium">{{ __('Belum ada penghuni terdaftar.') }}</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="pl-8">{{ __('ID') }}</th>
                                    <th>{{ __('Nama Lengkap') }}</th>
                                    <th>{{ __('Jenis Kelamin') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="pr-8 text-right">{{ __('Detail') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($children as $child)
                                    <tr x-show="!childSearch || '{{ strtolower($child->full_name) }}'.includes(childSearch.toLowerCase())"
                                        class="hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5 transition-colors group">
                                        <td class="pl-8">
                                            <span class="font-mono text-[10px] font-black bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 px-2 py-1 rounded-md">{{ $child->registration_number }}</span>
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs font-black">
                                                    {{ substr($child->full_name, 0, 1) }}
                                                </div>
                                                <span class="font-bold text-slate-700 dark:text-slate-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors uppercase tracking-tight text-xs">{{ $child->full_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-medium text-slate-500">{{ $child->gender === 'male' ? __('Laki-laki') : __('Perempuan') }}</span>
                                        </td>
                                        <td>
                                            <span class="badge 
                                                {{ $child->enrollment_status == 'active' ? 'badge-active' : '' }}
                                                {{ $child->enrollment_status == 'graduated' ? 'badge-graduated' : '' }}
                                                {{ $child->enrollment_status == 'withdrawn' ? 'badge-withdrawn' : '' }}">
                                                <span class="dot"></span>
                                                {{ ucfirst($child->enrollment_status) }}
                                            </span>
                                        </td>
                                        <td class="pr-8 text-right">
                                            <a href="{{ route('children.show', $child) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-500 hover:text-indigo-700 transition-colors">
                                                <span>{{ __('Lihat') }}</span>
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7-7 7"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-slate-50 dark:border-white/5">
                        {{ $children->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
