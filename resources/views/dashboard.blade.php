<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        {{-- Welcome Section --}}
        <div class="mb-8 animate-fade-in-up">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
                {{ __('Welcome back') }}, <span class="text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name }}</span> 👋
            </h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1">{{ __('Here is a summary of the children data today.') }}</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
            {{-- Total Children --}}
            <div class="stat-card accent-indigo animate-fade-in-up">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ __('Total Children') }}</p>
                        <p class="text-3xl font-extrabold text-slate-800 dark:text-slate-100 mt-2">{{ $stats['total'] }}</p>
                    </div>
                    <div class="icon-box indigo">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Active --}}
            <div class="stat-card accent-emerald animate-fade-in-up delay-75">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ __('Active') }}</p>
                        <p class="text-3xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-2">{{ $stats['active'] }}</p>
                    </div>
                    <div class="icon-box emerald">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Graduated --}}
            <div class="stat-card accent-blue animate-fade-in-up delay-150">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ __('Graduated') }}</p>
                        <p class="text-3xl font-extrabold text-blue-600 dark:text-blue-400 mt-2">{{ $stats['graduated'] }}</p>
                    </div>
                    <div class="icon-box blue">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Category Breakdown --}}
        <div class="content-card animate-fade-in-up delay-225">
            <div class="content-card-header">
                <div class="icon-box amber">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path></svg>
                </div>
                <h3 class="section-title">{{ __('Breakdown by Category') }}</h3>
            </div>
            <div class="content-card-body">
                @if(count($stats['by_category']) > 0)
                    <div class="flex flex-wrap gap-3">
                        @foreach($stats['by_category'] as $category => $count)
                            <div class="category-chip">
                                <span class="w-2 h-2 rounded-full 
                                    @if($category == 'fatherless') bg-indigo-500
                                    @elseif($category == 'motherless') bg-pink-500
                                    @elseif($category == 'orphan') bg-amber-500
                                    @elseif($category == 'underprivileged') bg-emerald-500
                                    @else bg-slate-400
                                    @endif
                                "></span>
                                <span class="capitalize">{{ $category }}</span>
                                <span class="text-xs font-bold text-slate-400 bg-slate-100 dark:bg-slate-700 dark:text-slate-300 px-2 py-0.5 rounded-full">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-slate-400 text-sm">{{ __('No data available.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
