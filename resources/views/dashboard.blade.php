<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Dashboard') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        {{-- Elite Hero Section --}}
        <div class="relative mb-12 animate-fade-in">
            <div class="absolute -top-24 -left-20 w-64 h-64 bg-indigo-500/10 blur-[100px] rounded-full"></div>
            <div class="absolute -bottom-24 -right-20 w-64 h-64 bg-purple-500/10 blur-[100px] rounded-full"></div>
            
            <div class="relative flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div>
                    <h1 class="text-5xl font-black text-slate-800 dark:text-white tracking-tight leading-tight">
                        {{ __('Welcome back') }},<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">{{ Auth::user()->name }}</span>
                    </h1>
                    <div class="flex items-center gap-3 mt-4">
                        <div class="flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/50 dark:bg-slate-800/50 border border-white/20 dark:border-slate-700/50 backdrop-blur-sm shadow-sm ring-1 ring-slate-100 dark:ring-slate-800/50">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">{{ __('System Active') }}</span>
                        </div>
                        <div class="px-4 py-2 rounded-2xl bg-slate-800 text-white text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-900/10">
                            {{ now()->format('D, d M Y') }}
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">{{ __('Operational Insight') }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium italic max-w-xs">{{ __('Here is a summary of the foundation metrics today.') }}</p>
                </div>
            </div>
        </div>

        {{-- Premium Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="stat-card accent-indigo animate-fade-in-up shadow-premium">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Total Children') }}</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="icon-box indigo !w-14 !h-14 !rounded-2xl shadow-lg shadow-indigo-500/10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-emerald animate-fade-in-up delay-75 shadow-premium">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Active Status') }}</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $stats['active'] }}</h3>
                    </div>
                    <div class="icon-box emerald !w-14 !h-14 !rounded-2xl shadow-lg shadow-emerald-500/10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-blue animate-fade-in-up delay-150 shadow-premium">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Graduated') }}</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $stats['graduated'] }}</h3>
                    </div>
                    <div class="icon-box blue !w-14 !h-14 !rounded-2xl shadow-lg shadow-blue-500/10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-rose animate-fade-in-up delay-225 shadow-premium">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Total Asrama') }}</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $stats['total_asrama'] }}</h3>
                    </div>
                    <div class="icon-box rose !w-14 !h-14 !rounded-2xl shadow-lg shadow-rose-500/10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Data Intelligence Section --}}
            <div class="lg:col-span-2">
                <div class="glass-card !rounded-[2.5rem] !bg-white/80 dark:!bg-slate-900/80 border-white/40 dark:border-slate-800/50 shadow-premium animate-fade-in-up delay-300">
                    <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="icon-box amber !w-12 !h-12 !rounded-2xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Data Intelligence') }}</h3>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Interactive Breakdown') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        @if(count($stats['by_category']) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($stats['by_category'] as $category => $count)
                                    <div class="group relative flex items-center justify-between p-6 rounded-3xl bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md hover:border-indigo-500/30 transition-all duration-300">
                                        <div class="flex items-center gap-4">
                                            <div class="w-3 h-10 rounded-full 
                                                @if($category == 'fatherless') bg-indigo-500
                                                @elseif($category == 'motherless') bg-pink-500
                                                @elseif($category == 'orphan') bg-amber-500
                                                @elseif($category == 'underprivileged') bg-emerald-500
                                                @else bg-slate-400
                                                @endif">
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ __('Category') }}</p>
                                                <span class="text- base font-black text-slate-800 dark:text-white uppercase tracking-tight">{{ __($category) }}</span>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-black text-slate-300 dark:text-slate-600 group-hover:text-indigo-500 transition-colors">
                                            {{ sprintf("%02d", $count) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16">
                                <div class="w-20 h-20 mx-auto rounded-[2rem] bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center text-slate-200 dark:text-slate-700 mb-4 shadow-inner ring-1 ring-slate-100 dark:ring-slate-800/50">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <p class="text-sm font-black text-slate-400 uppercase tracking-[0.2em]">{{ __('No data available') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Access Section --}}
            <div class="space-y-6 animate-fade-in-up delay-[450ms]">
                <div class="glass-card !rounded-[2.5rem] !bg-slate-800 dark:!bg-indigo-600 p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-500/20 group">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 blur-3xl rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-white/60 mb-2">{{ __('Quick Access') }}</p>
                        <h3 class="text-2xl font-black tracking-tight mb-6">{{ __('Children Management') }}</h3>
                        <a href="{{ route('children.index') }}" class="inline-flex items-center gap-3 bg-white text-slate-900 px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-lg">
                            {{ __('Explore Now') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                    <div class="absolute bottom-4 right-8 opacity-20 group-hover:scale-110 transition-transform duration-700">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>

                <div class="glass-card !rounded-[2.5rem] !bg-white/80 dark:!bg-slate-900/80 border-white/40 dark:border-slate-800/50 p-8 shadow-premium group">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-2">{{ __('Quick Access') }}</p>
                    <h3 class="text-2xl font-black tracking-tight text-slate-800 dark:text-white mb-6">{{ __('Facility Hub') }}</h3>
                    <a href="{{ route('asramas.index') }}" class="inline-flex items-center gap-3 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-700 transition-all border border-slate-200/50 dark:border-slate-700/50">
                        {{ __('Manage Asrama') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
