<x-app-layout>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('children.index') }}" class="text-slate-500 hover:text-green-600 transition-colors">{{ __('Children Data') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Child Profile') }}</span>
        </div>
    </x-slot>

    @php
        $birthDate = \Carbon\Carbon::parse($child->date_of_birth);
        $age = $birthDate->age;
        $admissionDate = \Carbon\Carbon::parse($child->admission_date);
        $yearsIn = $admissionDate->diffInYears(now());
        $monthsIn = $admissionDate->diffInMonths(now()) % 12;
        $tenureDisplay = $yearsIn > 0 ? $yearsIn . ' Yrs ' . ($monthsIn > 0 ? $monthsIn . ' Mo' : '') : $monthsIn . ' Months';
        $profilePhoto = $child->documents->where('document_type', 'profile_photo')->first();
    @endphp

    <div x-data="{ activeTab: 'identity', fabOpen: false }" class="max-w-7xl mx-auto pb-20 md:pb-12 px-3 sm:px-4 md:px-6 lg:px-8">
        {{-- Profile Header --}}
        <div class="mb-10">
            <div class="bg-white dark:bg-slate-900 rounded-2xl md:rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 p-4 sm:p-6 md:p-8">
                
                {{-- Top Row: Avatar & Actions --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-6 mb-6 md:mb-8">
                    {{-- Avatar --}}
                    <div class="relative shrink-0">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-2xl sm:rounded-3xl bg-slate-50 dark:bg-slate-800 p-1.5 shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                            @if($profilePhoto)
                                <img src="{{ Storage::url($profilePhoto->file_path) }}"
                                     class="w-full h-full object-cover object-top rounded-2xl"
                                     alt="{{ $child->full_name }}">
                            @else
                                <div class="w-full h-full rounded-xl sm:rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                    <span class="text-2xl sm:text-3xl font-black text-white">{{ substr($child->full_name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        {{-- Status dot --}}
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-[3px] border-white dark:border-slate-900
                            {{ $child->enrollment_status == 'active' ? 'bg-emerald-500' : ($child->enrollment_status == 'graduated' ? 'bg-blue-500' : 'bg-rose-500') }}">
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                        <a href="{{ route('children.id_card', $child) }}" target="_blank"
                           class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 rounded-lg sm:rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                            <span class="hidden xs:inline">{{ __('ID Card') }}</span>
                            <span class="xs:hidden">ID</span>
                        </a>
                        <a href="{{ route('children.pdf', $child) }}" target="_blank"
                           class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 rounded-lg sm:rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            <span>{{ __('PDF') }}</span>
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('children.edit', $child) }}" 
                           class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 rounded-lg sm:rounded-xl bg-[#16a34a] hover:bg-green-700 text-white text-xs sm:text-sm font-semibold transition-colors shadow-sm">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <span>Ubah</span>
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Badges --}}
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold tracking-wide text-green-700 bg-green-50 border border-green-100 dark:bg-green-500/10 dark:text-green-400 dark:border-green-500/20">
                        <svg class="w-3.5 h-3.5 text-[#16a34a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        {{ $child->registration_number }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold tracking-wide
                        {{ $child->enrollment_status == 'active' ? 'text-emerald-700 bg-emerald-50 border border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20' : ($child->enrollment_status == 'graduated' ? 'text-blue-700 bg-blue-50 border border-blue-100' : 'text-rose-700 bg-rose-50 border border-rose-100') }}">
                        <svg class="w-3.5 h-3.5 {{ $child->enrollment_status == 'active' ? 'text-emerald-500' : ($child->enrollment_status == 'graduated' ? 'text-blue-500' : 'text-rose-500') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        {{ ucfirst(__($child->enrollment_status)) }}
                    </span>
                </div>

                {{-- Name & Meta --}}
                <div>
                    <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight break-words">{{ $child->full_name }}</h1>
                    <div class="w-8 h-[3px] bg-[#16a34a] rounded-full mt-2 mb-4"></div>
                    <p class="flex flex-wrap items-center gap-x-3 sm:gap-x-4 gap-y-2 text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#16a34a] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $child->place_of_birth }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[#16a34a] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ \Carbon\Carbon::parse($child->date_of_birth)->translatedFormat('d F Y') }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Quick Stats: Scrollable on Mobile --}}
        <div class="flex overflow-x-auto lg:grid lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-12 no-scrollbar -mx-3 px-3 sm:-mx-4 sm:px-4 lg:mx-0 lg:px-0 snap-x snap-mandatory">
            <div class="stat-card accent-green animate-fade-in-up delay-75 shrink-0 w-[240px] sm:w-[280px] lg:w-auto snap-start">
                <div class="flex items-center gap-4">
                    <div class="icon-box green !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Age') }}</p>
                        <h4 class="text-xl sm:text-2xl font-black text-slate-800 dark:text-white">{{ $age }} <span class="text-xs sm:text-sm font-bold text-slate-400">Yrs</span></h4>
                    </div>
                </div>
            </div>
            
            <div class="stat-card accent-emerald animate-fade-in-up delay-150 shrink-0 w-[240px] sm:w-[280px] lg:w-auto snap-start">
                <div class="flex items-center gap-4">
                    <div class="icon-box emerald !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Tenure') }}</p>
                        <h4 class="text-xl sm:text-2xl font-black text-slate-800 dark:text-white">{{ $tenureDisplay }}</h4>
                    </div>
                </div>
            </div>

            <div class="stat-card accent-blue animate-fade-in-up delay-225 shrink-0 w-[240px] sm:w-[280px] lg:w-auto snap-start">
                <div class="flex items-center gap-4">
                    <div class="icon-box blue !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Category') }}</p>
                        <h4 class="text-lg sm:text-xl font-black text-slate-800 dark:text-white capitalize">{{ __($child->category) }}</h4>
                    </div>
                </div>
            </div>

            <div class="stat-card accent-amber animate-fade-in-up delay-300 shrink-0 w-[240px] sm:w-[280px] lg:w-auto snap-start">
                <div class="flex items-center gap-4">
                    <div class="icon-box amber !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Gender') }}</p>
                        <h4 class="text-lg sm:text-xl font-black text-slate-800 dark:text-white capitalize">{{ __($child->gender) }}</h4>
                    </div>
                </div>
            </div>
            
            {{-- Scroll Indicator --}}
            <div class="flex lg:hidden justify-center gap-1.5 mt-4">
                <div class="w-4 h-1 rounded-full bg-green-600"></div>
                <div class="w-1 h-1 rounded-full bg-slate-300"></div>
                <div class="w-1 h-1 rounded-full bg-slate-300"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-12 relative">
            {{-- Left Column: Information --}}
            <div class="lg:col-span-2">
                {{-- Mobile Tab Switcher --}}
                <div class="flex overflow-x-auto no-scrollbar bg-slate-100 dark:bg-slate-800 p-1.5 rounded-2xl mb-6 gap-1 sticky top-4 z-40 shadow-lg border border-white/20 dark:border-slate-700/50">
                    <button @click="activeTab = 'identity'" :class="activeTab === 'identity' ? 'bg-white dark:bg-slate-700 text-green-600 dark:text-green-400 shadow-sm' : 'text-slate-500'" class="flex-1 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                        {{ __('Identity') }}
                    </button>
                    <button @click="activeTab = 'family'" :class="activeTab === 'family' ? 'bg-white dark:bg-slate-700 text-green-600 dark:text-green-400 shadow-sm' : 'text-slate-500'" class="flex-1 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                        {{ __('Family') }}
                    </button>
                    <button @click="activeTab = 'academic'" :class="activeTab === 'academic' ? 'bg-white dark:bg-slate-700 text-green-600 dark:text-green-400 shadow-sm' : 'text-slate-500'" class="flex-1 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                        {{ __('Academic') }}
                    </button>
                    <button @click="activeTab = 'history'" :class="activeTab === 'history' ? 'bg-white dark:bg-slate-700 text-green-600 dark:text-green-400 shadow-sm' : 'text-slate-500'" class="flex-1 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                        {{ __('History') }}
                    </button>
                    <button @click="activeTab = 'documents'" :class="activeTab === 'documents' ? 'bg-white dark:bg-slate-700 text-green-600 dark:text-green-400 shadow-sm' : 'text-slate-500'" class="flex-1 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                        {{ __('Documents') }}
                    </button>
                </div>

                <div class="space-y-12">
                    {{-- Biological & Legal Identity --}}
                    <div x-show="activeTab === 'identity'" x-transition class="glass-card !bg-white/50 dark:!bg-slate-900/50 p-4 sm:p-6 md:p-8 border-transparent">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box green shadow-lg shadow-green-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Biological & Legal Identity') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <p class="text-[10px] font-black text-green-500 uppercase tracking-[0.2em] mb-1">{{ __('National ID (NIK)') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 font-mono tracking-wider break-all">{{ $child->nik ?: '-' }}</p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <p class="text-[10px] font-black text-blue-500 uppercase tracking-[0.2em] mb-1">{{ __('Family Card (KK)') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 font-mono tracking-wider break-all">{{ $child->no_kk ?: '-' }}</p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-1">{{ __('Gender') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 capitalize">{{ $child->gender }}</p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <p class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] mb-1">{{ __('Birth Details') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 capitalize break-words">{{ $child->place_of_birth }}, {{ \Carbon\Carbon::parse($child->date_of_birth)->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                    {{-- Family & Guardianship --}}
                    <div x-show="activeTab === 'family'" x-transition class="glass-card !bg-white/50 dark:!bg-slate-900/50 p-4 sm:p-6 md:p-8 border-transparent">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box blue shadow-lg shadow-blue-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Family & Guardianship') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm col-span-1">
                            <p class="text-[10px] font-black text-sky-500 uppercase tracking-[0.2em] mb-1">{{ __('Father\'s Name') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 capitalize break-words">{{ $child->father_name ?: '-' }}</p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm col-span-1">
                            <p class="text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] mb-1">{{ __('Mother\'s Name') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 capitalize break-words">{{ $child->mother_name ?: '-' }}</p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm md:col-span-2">
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-1">{{ __('Parent/Guardian Contact') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 break-all">{{ $child->parent_phone_number ?: '-' }}</p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm md:col-span-2">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ __('Home Address') }}</p>
                            <p class="text-base font-bold text-slate-700 dark:text-slate-200 italic leading-relaxed">{{ $child->address ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                    {{-- Academic & Education --}}
                    <div x-show="activeTab === 'academic'" x-transition class="glass-card !bg-white/50 dark:!bg-slate-900/50 p-4 sm:p-6 md:p-8 border-transparent">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box emerald shadow-lg shadow-emerald-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4 2.222"></path></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Academic & Education') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <p class="text-[10px] font-black text-violet-500 uppercase tracking-[0.2em] mb-1">{{ __('Level') }}</p>
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-200 capitalize">
                                @switch($child->education_level)
                                    @case('BS') Belum Sekolah @break
                                    @case('SD') SD/MI @break
                                    @case('SMP') SMP/MTs @break
                                    @case('SMA') SMA/SMK @break
                                    @default {{ $child->education_level ?: '-' }}
                                @endswitch
                            </p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <p class="text-[10px] font-black text-fuchsia-500 uppercase tracking-[0.2em] mb-1">{{ __('Class') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200">{{ $child->class_level ?: '-' }}</p>
                        </div>
                        <div class="p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm">
                            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-1">{{ __('Economic Grade') }}</p>
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-200">
                                Grade {{ $child->grade ?: '-' }}

                            </p>
                        </div>
                    </div>
                </div>

                    {{-- Administrative History --}}
                    <div x-show="activeTab === 'history'" x-transition class="glass-card !bg-white/50 dark:!bg-slate-900/50 p-4 sm:p-6 md:p-8 border-transparent">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box emerald shadow-lg shadow-emerald-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Administrative History') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 md:gap-8">
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-green-500 uppercase tracking-widest mb-2">{{ __('Admission Date') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 break-words">{{ \Carbon\Carbon::parse($child->admission_date)->format('l, d F Y') }}</p>
                        </div>
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-blue-500 uppercase tracking-widest mb-2">{{ __('Recommended By') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 capitalize break-words">{{ $child->recommended_by ?: '-' }}</p>
                        </div>
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-emerald-500 uppercase tracking-widest mb-2">{{ __('Current Status') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold text-slate-700 dark:text-slate-200 capitalize">{{ __($child->enrollment_status) }}</p>
                        </div>
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-purple-500 uppercase tracking-widest mb-2">{{ __('Registration No.') }}</p>
                            <p class="text-sm sm:text-base md:text-lg font-bold font-mono text-slate-700 dark:text-slate-200 break-all">{{ $child->registration_number }}</p>
                        </div>
                    </div>
                </div>

                    {{-- Legal Documents --}}
                    <div x-show="activeTab === 'documents'" x-transition class="glass-card !bg-white/50 dark:!bg-slate-900/50 p-4 sm:p-6 md:p-8 border-transparent">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="icon-box amber shadow-lg shadow-amber-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-lg sm:text-xl md:text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Legal Attachments') }}</h3>
                        </div>
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 dark:bg-slate-800 px-4 py-2 rounded-full uppercase tracking-widest">
                            {{ count($child->documents) }} Files
                        </span>
                    </div>

                    <div class="flex overflow-x-auto sm:grid sm:grid-cols-2 gap-4 sm:gap-6 no-scrollbar snap-x snap-mandatory pb-4 -mx-4 px-4 sm:mx-0 sm:px-0">
                        @forelse($child->documents as $doc)
                            <div class="group relative rounded-2xl sm:rounded-3xl border border-slate-200/50 dark:border-slate-700/50 bg-white dark:bg-slate-800 hover:border-green-400 dark:hover:border-green-500 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden shrink-0 w-[260px] sm:w-auto snap-start">
                                <div class="aspect-[4/3] bg-slate-50 dark:bg-slate-900 flex items-center justify-center relative overflow-hidden border-b border-slate-100 dark:border-slate-700">
                                    @if(in_array(strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                                        <img src="{{ Storage::url($doc->file_path) }}" alt="{{ $doc->document_type }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="flex flex-col items-center gap-4 group-hover:scale-110 transition-transform duration-500">
                                            <div class="w-20 h-20 rounded-[2rem] bg-rose-50 dark:bg-rose-500/10 flex items-center justify-center text-rose-500 shadow-inner">
                                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"></path></svg>
                                            </div>
                                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">PDF Asset</span>
                                        </div>
                                    @endif
                                    
                                    {{-- Overlay --}}
                                    <div class="absolute inset-0 bg-green-900/60 opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-[2px] flex items-center justify-center gap-3">
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="w-12 h-12 bg-white dark:bg-slate-800 text-green-600 dark:text-green-400 rounded-2xl flex items-center justify-center shadow-xl transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 delay-75">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ Storage::url($doc->file_path) }}" download class="w-12 h-12 bg-white dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center shadow-xl transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 delay-150">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        </a>
                                        @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('children.documents.destroy', $doc) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Hapus dokumen ini?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-12 h-12 bg-white dark:bg-slate-800 text-rose-600 dark:text-rose-400 rounded-2xl flex items-center justify-center shadow-xl transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 delay-[225ms]">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>

                                </div>
                                <div class="p-5">
                                    <h4 class="text-sm font-black text-slate-700 dark:text-slate-200 uppercase tracking-wider truncate">{{ str_replace('_', ' ', $doc->document_type) }}</h4>
                                    <p class="text-xs font-bold text-slate-400 mt-1">Modified {{ $doc->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-16 flex flex-col items-center justify-center gap-4 bg-slate-50/50 dark:bg-slate-900/30 rounded-[3rem] border-2 border-dashed border-slate-200 dark:border-slate-800">
                                <div class="w-20 h-20 rounded-[2.5rem] bg-white dark:bg-slate-800 flex items-center justify-center text-slate-200 dark:text-slate-700 shadow-sm border border-slate-100 dark:border-slate-700">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-lg font-black text-slate-400 italic mb-1">{{ __('No Documents Found') }}</p>
                                    <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">{{ __('Please upload required files') }}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Facility & Quick Links --}}
            <div class="space-y-6">
                {{-- Facility Card --}}
                <div class="content-card !rounded-3xl overflow-hidden animate-fade-in-up delay-300">
                    {{-- Card Header --}}
                    <div class="h-2 bg-gradient-to-r from-green-500 to-emerald-600"></div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="icon-box green !w-9 !h-9 !rounded-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-200 uppercase tracking-wider">{{ __('Facility Assignment') }}</h3>
                        </div>

                        @if($child->asrama)
                            <div class="text-center py-4">
                                <div class="w-16 h-16 rounded-2xl bg-green-50 dark:bg-green-500/10 flex items-center justify-center text-green-600 dark:text-green-400 mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </div>
                                <h4 class="text-lg font-bold text-slate-800 dark:text-white">{{ $child->asrama->nama_asrama }}</h4>
                                <p class="text-xs font-mono text-slate-400 mt-1 uppercase tracking-widest">{{ $child->asrama->kode_asrama }}</p>
                                <a href="{{ route('asramas.show', $child->asrama) }}" class="btn btn-primary w-full justify-center mt-5">
                                    {{ __('View Facility') }}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-300 mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-400">{{ __('Not Assigned') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Back Link --}}
                <a href="{{ route('children.index') }}" class="group flex items-center gap-3 text-slate-400 hover:text-green-600 dark:hover:text-green-400 transition-colors px-2 py-1">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="text-sm font-semibold">{{ __('Back to Children List') }}</span>
                </a>
            </div>
        </div>


    {{-- Mobile Floating Action Button (FAB) --}}
    <div class="fixed bottom-8 right-6 z-50 md:hidden">
        {{-- FAB Menu --}}
        <div x-show="fabOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="absolute bottom-20 right-0 space-y-4">
            
            <a href="{{ route('children.id_card', $child) }}" target="_blank" class="flex items-center gap-3 bg-white dark:bg-slate-800 px-6 py-3 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700">
                <span class="text-xs font-black uppercase tracking-widest text-slate-800 dark:text-white">{{ __('ID Card') }}</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                </div>
            </a>

            <a href="{{ route('children.pdf', $child) }}" target="_blank" class="flex items-center gap-3 bg-white dark:bg-slate-800 px-6 py-3 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700">
                <span class="text-xs font-black uppercase tracking-widest text-slate-800 dark:text-white">{{ __('Export PDF') }}</span>
                <div class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-500/10 flex items-center justify-center text-rose-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ route('children.edit', $child) }}" class="flex items-center gap-3 bg-green-600 px-6 py-3 rounded-2xl shadow-xl shadow-green-500/20">
                <span class="text-xs font-black uppercase tracking-widest text-white">{{ __('Edit Profile') }}</span>
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
            </a>
            @endif
        </div>

        {{-- Main FAB Toggle --}}
        <button @click="fabOpen = !fabOpen" 
                class="w-16 h-16 bg-green-600 rounded-3xl shadow-2xl flex items-center justify-center text-white transform active:scale-95 transition-all">
            <svg x-show="!fabOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <svg x-show="fabOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    </div>
</x-app-layout>
