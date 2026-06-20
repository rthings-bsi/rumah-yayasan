<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Children Data') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-2xl md:text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Children Management') }}</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1 md:mt-2 font-medium text-sm md:text-base">{{ __('Manage and track all children data records with ease.') }}</p>
            </div>
            <div class="flex items-center gap-4 w-full md:w-auto">
                <a href="{{ route('children.export', ['search' => request('search')]) }}" class="btn btn-secondary !rounded-2xl flex-1 md:flex-none justify-center group border-transparent bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <svg class="w-5 h-5 text-green-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="font-bold">{{ __('Export') }}</span>
                </a>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('children.create') }}" class="btn btn-primary !rounded-2xl flex-1 md:flex-none justify-center !bg-[#16a34a] hover:!bg-[#15803d] shadow-xl shadow-green-500/20 group text-white">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    <span class="font-bold">{{ __('Add New Child') }}</span>
                </a>
                @endif
            </div>
        </div>

        {{-- Stats Overview --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
            <div class="stat-card accent-green animate-fade-in-up shadow-premium">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Total Children') }}</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $stats['total'] }}</h3>
                    </div>
                    <div class="icon-box green !w-14 !h-14 !rounded-2xl shadow-lg shadow-green-500/10">
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
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Male') }}</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $stats['male'] }}</h3>
                    </div>
                    <div class="icon-box blue !w-14 !h-14 !rounded-2xl shadow-lg shadow-blue-500/10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-rose animate-fade-in-up delay-225 shadow-premium">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Female') }}</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $stats['female'] }}</h3>
                    </div>
                    <div class="icon-box rose !w-14 !h-14 !rounded-2xl shadow-lg shadow-rose-500/10">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Card --}}
        <div class="glass-card overflow-hidden !rounded-[2.5rem] !bg-white/80 dark:!bg-slate-900/80 border-white/40 dark:border-slate-800/50 shadow-premium animate-fade-in-up delay-300">
            <div class="p-6 md:p-8 border-b border-slate-100 dark:border-slate-800/50 bg-slate-50/50 dark:bg-slate-800/20">
                <form method="GET" action="{{ route('children.index') }}" x-data="{ expanded: {{ request('asrama_id') || request('category') || request('enrollment_status') ? 'true' : 'false' }} }">
                    <div class="flex flex-col md:flex-row gap-4">
                        {{-- Search Input --}}
                        <div class="relative flex-1 group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search name or registration number...') }}" 
                                   class="form-input-modern w-full pl-12 !rounded-[1.25rem] !border-slate-200 dark:!border-slate-700 focus:!ring-[#16a34a]/30 text-sm py-3.5">
                        </div>

                        {{-- Toggle Advanced Filters --}}
                        <div class="flex gap-2 sm:gap-3 w-full md:w-auto">
                            <button type="button" @click="expanded = !expanded" 
                                    :class="expanded ? '!bg-[#16a34a] !text-white !border-[#16a34a]' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-slate-700'"
                                    class="btn !py-0 !rounded-[1.25rem] h-[52px] flex-1 md:flex-none px-6 border shadow-sm transition-all hover:shadow-md flex items-center justify-center gap-3 active:scale-95">
                                <svg class="w-4 h-4 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                <span class="text-xs font-black uppercase tracking-widest">{{ __('Filter') }}</span>
                                @php
                                    $activeFilters = count(array_filter([request('asrama_id'), request('category'), request('enrollment_status')]));
                                @endphp
                                @if($activeFilters > 0)
                                    <span class="flex items-center justify-center min-w-[1.25rem] h-5 px-1.5 text-[9px] {{ request('asrama_id') || request('category') || request('enrollment_status') ? 'bg-white text-green-600' : 'bg-green-600 text-white' }} rounded-full font-black ml-1 shadow-sm">{{ $activeFilters }}</span>
                                @endif
                            </button>
                            <button type="submit" class="btn btn-primary !py-0 !rounded-[1.25rem] h-[52px] flex-1 md:flex-none px-10 !bg-[#16a34a] hover:!bg-[#15803d] text-white transition-all shadow-xl shadow-green-500/20 active:scale-95 group">
                                <span class="font-black text-xs uppercase tracking-[0.2em] group-hover:scale-110 transition-transform">{{ __('Apply') }}</span>
                            </button>
                        </div>
                    </div>

                    {{-- Expanded Filters --}}
                    <div x-show="expanded" x-collapse x-cloak class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-800/50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {{-- Asrama Filter --}}
                            <div class="space-y-3 group">
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                    <label class="text-[10px] font-black text-slate-400 group-hover:text-green-500 transition-colors uppercase tracking-[0.2em]">{{ __('Asrama Facility') }}</label>
                                </div>
                                <select name="asrama_id" class="form-input-modern w-full !rounded-2xl !border-slate-200 dark:!border-slate-700 focus:!ring-[#16a34a]/30 text-xs py-3">
                                    <option value="">{{ __('All Asramas') }}</option>
                                    @foreach($asramas as $asrama)
                                        <option value="{{ $asrama->id }}" {{ request('asrama_id') == $asrama->id ? 'selected' : '' }}>
                                            {{ $asrama->kode_asrama }} – {{ $asrama->nama_asrama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Category Filter --}}
                            <div class="space-y-3 group">
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                                    <label class="text-[10px] font-black text-slate-400 group-hover:text-amber-500 transition-colors uppercase tracking-[0.2em]">{{ __('Child Category') }}</label>
                                </div>
                                <select name="category" class="form-input-modern w-full !rounded-2xl !border-slate-200 dark:!border-slate-700 focus:!ring-[#16a34a]/30 text-xs py-3">
                                    <option value="">{{ __('All Categories') }}</option>
                                    <option value="fatherless" {{ request('category') == 'fatherless' ? 'selected' : '' }}>{{ __('fatherless') }}</option>
                                    <option value="motherless" {{ request('category') == 'motherless' ? 'selected' : '' }}>{{ __('motherless') }}</option>
                                    <option value="orphan" {{ request('category') == 'orphan' ? 'selected' : '' }}>{{ __('orphan') }}</option>
                                    <option value="underprivileged" {{ request('category') == 'underprivileged' ? 'selected' : '' }}>{{ __('underprivileged') }}</option>
                                </select>
                            </div>

                            {{-- Status Filter --}}
                            <div class="space-y-3 group">
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                    <label class="text-[10px] font-black text-slate-400 group-hover:text-emerald-500 transition-colors uppercase tracking-[0.2em]">{{ __('Enrollment Status') }}</label>
                                </div>
                                <div class="flex gap-3 w-full">
                                    <div class="flex-1">
                                        <select name="enrollment_status" class="form-input-modern w-full !rounded-2xl !border-slate-200 dark:!border-slate-700 focus:!ring-[#16a34a]/30 text-xs py-3">
                                            <option value="">{{ __('All Status') }}</option>
                                            <option value="active" {{ request('enrollment_status') == 'active' ? 'selected' : '' }}>{{ __('active') }}</option>
                                            <option value="graduated" {{ request('enrollment_status') == 'graduated' ? 'selected' : '' }}>{{ __('graduated') }}</option>
                                            <option value="withdrawn" {{ request('enrollment_status') == 'withdrawn' ? 'selected' : '' }}>{{ __('withdrawn') }}</option>
                                        </select>
                                    </div>
                                    @if(request('search') || request('asrama_id') || request('category') || request('enrollment_status'))
                                        <a href="{{ route('children.index') }}" 
                                           class="w-12 h-12 flex shrink-0 items-center justify-center bg-rose-50 dark:bg-rose-500/10 text-rose-500 border border-transparent hover:border-rose-200 dark:hover:border-rose-500/30 !rounded-2xl transition-all shadow-sm group/reset" 
                                           title="{{ __('Reset All Filters') }}">
                                            <svg class="w-5 h-5 group-hover/reset:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mx-5 md:mx-8 mt-6 flex items-center gap-3 text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 p-4 rounded-[1.5rem] animate-shake">
                    <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="text-xs md:text-sm font-black">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Responsive Content: Table (Desktop) & Cards (Mobile) --}}
            <div class="relative">
                
                {{-- Desktop Table View --}}
                <div class="hidden lg:block overflow-x-auto">
                    <table class="modern-table !border-none w-full">
                        <thead>
                            <tr class="!bg-transparent text-slate-400 dark:text-slate-500 border-b border-slate-100 dark:border-slate-800">
                                <th class="w-20 pl-8 capitalize tracking-[0.1em] text-[10px] font-black pointer-events-none pb-4">{{ __('Identity') }}</th>
                                <th class="capitalize tracking-[0.1em] text-[10px] font-black pointer-events-none pb-4">{{ __('Personal Details') }}</th>
                                <th class="capitalize tracking-[0.1em] text-[10px] font-black pointer-events-none pb-4">{{ __('Registration') }}</th>
                                <th class="capitalize tracking-[0.1em] text-[10px] font-black pointer-events-none pb-4">{{ __('Facility') }}</th>
                                <th class="capitalize tracking-[0.1em] text-[10px] font-black pointer-events-none pb-4">{{ __('Enrollment') }}</th>
                                <th class="text-right pr-8 capitalize tracking-[0.1em] text-[10px] font-black pointer-events-none text-[#16a34a] pb-4">{{ __('Management') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                            @forelse($children as $child)
                                @php
                                    $profilePhoto = $child->documents->where('document_type', 'profile_photo')->first();
                                @endphp
                                <tr class="row-interactive group/row transition-all duration-300 hover:bg-slate-50/50 dark:hover:bg-slate-800/20">
                                    <td class="pl-8 py-5">
                                        <div class="relative">
                                            <div class="absolute inset-0 bg-[#16a34a] blur-lg opacity-0 group-hover/row:opacity-20 transition-opacity"></div>
                                            <div class="relative w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 p-1 shadow-sm group-hover/row:scale-110 transition-transform duration-500 border border-slate-100 dark:border-slate-700">
                                                <div class="w-full h-full rounded-[0.9rem] bg-gradient-to-br from-green-50 to-green-100 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center overflow-hidden">
                                                    @if($profilePhoto)
                                                        <img src="{{ Storage::url($profilePhoto->file_path) }}" class="w-full h-full object-cover" alt="{{ $child->full_name }}">
                                                    @else
                                                        <span class="text-[#16a34a] font-black text-sm">{{ substr($child->full_name, 0, 1) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex flex-col">
                                            <span class="font-black text-slate-800 dark:text-white text-base tracking-tight group-hover/row:text-[#16a34a] transition-colors">{{ $child->full_name }}</span>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">{{ __($child->category) }}</span>
                                                <span class="text-slate-300 dark:text-slate-700">•</span>
                                                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">{{ __($child->gender) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="font-mono text-[10px] font-black tracking-[0.1em] bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-300 px-3 py-1.5 rounded-xl border border-slate-100 dark:border-slate-700/50 group-hover/row:border-[#16a34a]/30 group-hover/row:text-[#16a34a] transition-colors">
                                            {{ $child->registration_number }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($child->asrama)
                                            <a href="{{ route('asramas.show', $child->asrama) }}" class="inline-flex items-center gap-2 text-[10px] font-black bg-green-50 dark:bg-green-500/10 text-[#16a34a] dark:text-green-400 px-3 py-1.5 rounded-xl border border-green-100 dark:border-green-500/20 hover:bg-[#16a34a] hover:text-white transition-colors group/asrama shadow-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                                <span class="uppercase tracking-widest">{{ $child->asrama->kode_asrama }}</span>
                                            </a>
                                        @else
                                            <span class="text-[10px] font-black text-slate-400 italic bg-slate-50 dark:bg-slate-800/30 px-3 py-1.5 rounded-xl uppercase tracking-widest">{{ __('Not Assigned') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-elite !py-1.5 !px-3 inline-flex items-center gap-2 rounded-xl border
                                            {{ $child->enrollment_status == 'active' ? 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20' : '' }}
                                            {{ $child->enrollment_status == 'graduated' ? 'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20' : '' }}
                                            {{ $child->enrollment_status == 'withdrawn' ? 'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20' : '' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $child->enrollment_status == 'active' ? 'bg-emerald-500' : ($child->enrollment_status == 'graduated' ? 'bg-blue-500' : 'bg-rose-500') }}"></span>
                                            <span class="uppercase tracking-widest font-black text-[10px]">{{ __($child->enrollment_status) }}</span>
                                        </span>
                                    </td>
                                    
                                    {{-- PERBAIKAN CLASS UKURAN IKON SVG DESKTOP (w-5 h-5) --}}
                                    <td class="pr-8 text-right">
                                        <div class="flex items-center justify-end gap-1.5 opacity-70 group-hover/row:opacity-100 transition-opacity">
                                            <a href="{{ route('children.show', $child) }}" class="p-2.5 text-slate-400 hover:text-[#16a34a] hover:bg-green-50 dark:hover:bg-slate-800 rounded-xl transition-all shadow-sm border border-transparent hover:border-green-100 dark:hover:border-slate-700" title="View Profile">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                                <a href="{{ route('children.edit', $child) }}" class="p-2.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-slate-800 rounded-xl transition-all shadow-sm border border-transparent hover:border-amber-100 dark:hover:border-slate-700" title="Edit Record">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('children.destroy', $child) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this record?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-slate-800 rounded-xl transition-all shadow-sm border border-transparent hover:border-rose-100 dark:hover:border-slate-700" title="Delete">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="!bg-transparent">
                                    <td colspan="6" class="text-center py-20">
                                        <div class="flex flex-col items-center gap-4 animate-fade-in">
                                            <div class="w-20 h-20 rounded-full bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center text-slate-300 dark:text-slate-600">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            </div>
                                            <div>
                                                <p class="text-lg font-black text-slate-800 dark:text-white">{{ __('No results found') }}</p>
                                                <p class="text-xs font-medium text-slate-400 mt-1">{{ __('Try adjusting your search or filters') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card List View --}}
                <div class="lg:hidden p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                    @forelse($children as $child)
                        @php
                            $profilePhoto = $child->documents->where('document_type', 'profile_photo')->first();
                        @endphp
                        <div class="bg-white dark:bg-slate-900/60 rounded-[1.5rem] border border-slate-100 dark:border-slate-800 shadow-sm relative overflow-hidden flex flex-col">
                            {{-- Status Indicator (Top Bar) --}}
                            <div class="h-1.5 w-full 
                                {{ $child->enrollment_status == 'active' ? 'bg-emerald-500' : '' }}
                                {{ $child->enrollment_status == 'graduated' ? 'bg-blue-500' : '' }}
                                {{ $child->enrollment_status == 'withdrawn' ? 'bg-rose-500' : '' }}">
                            </div>
                            
                            <div class="p-5">
                                {{-- Card Header: Avatar & Info --}}
                                <div class="flex items-start gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 p-1 border border-slate-100 dark:border-slate-700 shrink-0">
                                        <div class="w-full h-full rounded-xl bg-green-50 dark:bg-slate-700 flex items-center justify-center overflow-hidden text-[#16a34a]">
                                            @if($profilePhoto)
                                                <img src="{{ Storage::url($profilePhoto->file_path) }}" class="w-full h-full object-cover" alt="{{ $child->full_name }}">
                                            @else
                                                <span class="font-black text-base">{{ substr($child->full_name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1 min-w-0 pt-0.5">
                                        <h4 class="font-black text-slate-800 dark:text-white text-base truncate">{{ $child->full_name }}</h4>
                                        <p class="text-[10px] font-black text-slate-400 mt-1 uppercase tracking-widest">{{ __($child->gender) }} • {{ __($child->category) }}</p>
                                    </div>
                                </div>

                                {{-- Meta Info Badges --}}
                                <div class="flex flex-wrap items-center gap-2 mt-4">
                                    <span class="inline-flex items-center text-[10px] font-black font-mono text-[#16a34a] bg-green-50 dark:bg-green-500/10 border border-green-100 dark:border-green-500/20 px-2.5 py-1 rounded-lg">
                                        {{ $child->registration_number }}
                                    </span>
                                    
                                    @if($child->asrama)
                                        <span class="inline-flex items-center gap-1 text-[10px] font-black text-slate-500 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 px-2.5 py-1 rounded-lg uppercase tracking-widest">
                                            <svg class="w-3 h-3 text-[#16a34a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                            {{ $child->asrama->kode_asrama }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Actions Footer --}}
                            <div class="mt-auto bg-slate-50 dark:bg-slate-800/40 border-t border-slate-100 dark:border-slate-800 p-3">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-[9px] font-black uppercase tracking-widest px-2
                                        {{ $child->enrollment_status == 'active' ? 'text-emerald-600 dark:text-emerald-400' : '' }}
                                        {{ $child->enrollment_status == 'graduated' ? 'text-blue-600 dark:text-blue-400' : '' }}
                                        {{ $child->enrollment_status == 'withdrawn' ? 'text-rose-600 dark:text-rose-400' : '' }}">
                                        {{ __($child->enrollment_status) }}
                                    </span>
                                    
                                    <div class="flex items-center gap-1.5">
                                        <a href="{{ route('children.show', $child) }}" class="p-2 bg-white dark:bg-slate-800 text-slate-400 hover:text-[#16a34a] border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm active:scale-95 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('children.edit', $child) }}" class="p-2 bg-white dark:bg-slate-800 text-slate-400 hover:text-amber-500 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm active:scale-95 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('children.destroy', $child) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this record?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-white dark:bg-slate-800 text-slate-400 hover:text-rose-500 border border-slate-200 dark:border-slate-700 rounded-xl shadow-sm active:scale-95 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center col-span-full">
                            <p class="text-slate-500 italic font-medium">{{ __('No children found matching your filters.') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Pagination --}}
            @if($children->hasPages())
                <div class="p-6 md:p-8 border-t border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/10">
                    {{ $children->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>