<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('children.index') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Children Data') }}</a>
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

    <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        {{-- Elite Profile Header --}}
        <div class="relative mb-12">
            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-r from-indigo-600/10 to-purple-600/10 dark:from-indigo-500/5 dark:to-purple-500/5 blur-3xl -z-10 rounded-full transform -translate-y-12 h-64"></div>
            
            <div class="glass-card overflow-hidden !rounded-[2.5rem] !bg-white/80 dark:!bg-slate-900/80 border-white/40 dark:border-slate-800/50 shadow-premium">
                <div class="h-40 bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-800 relative overflow-hidden">
                    {{-- Decorative pattern --}}
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>
                </div>
                
                <div class="px-8 pb-10">
                    <div class="relative flex flex-col md:flex-row items-center md:items-end gap-8 -mt-16">
                        {{-- Avatar with Glow --}}
                        <div class="relative group">
                            <div class="absolute inset-0 bg-indigo-500 blur-2xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-40 h-40 rounded-[2.5rem] bg-white dark:bg-slate-800 p-1.5 shadow-2xl">
                                <div class="w-full h-full rounded-[2.2rem] bg-gradient-to-br from-slate-50 to-slate-200 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center overflow-hidden border border-slate-100 dark:border-slate-600">
                                    @if($profilePhoto)
                                        <img src="{{ Storage::disk('s3')->url($profilePhoto->file_path) }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                             alt="{{ $child->full_name }}">
                                    @else
                                        <span class="text-5xl font-black text-indigo-600 dark:text-indigo-400">
                                            {{ substr($child->full_name, 0, 1) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 border-4 border-white dark:border-slate-800 rounded-2xl shadow-lg flex items-center justify-center" title="Verified Member">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                        </div>

                        {{-- Identity --}}
                        <div class="flex-1 text-center md:text-left pt-4">
                            <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mb-2">
                                <span class="badge-elite bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-100 dark:border-indigo-500/20">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                                    {{ $child->registration_number }}
                                </span>
                                <span class="badge-elite 
                                    {{ $child->enrollment_status == 'active' ? 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20' : '' }}
                                    {{ $child->enrollment_status == 'graduated' ? 'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20' : '' }}
                                    {{ $child->enrollment_status == 'withdrawn' ? 'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:text-rose-400 dark:border-rose-500/20' : '' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $child->enrollment_status == 'active' ? 'bg-emerald-500' : ($child->enrollment_status == 'graduated' ? 'bg-blue-500' : 'bg-rose-500') }} animate-pulse"></span>
                                    {{ ucfirst($child->enrollment_status) }}
                                </span>
                            </div>
                            <h1 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight drop-shadow-sm">{{ $child->full_name }}</h1>
                            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium flex items-center justify-center md:justify-start gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $child->place_of_birth }}, {{ \Carbon\Carbon::parse($child->date_of_birth)->format('d F Y') }}
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <a href="{{ route('children.pdf', $child) }}" target="_blank" class="btn btn-secondary !rounded-2xl group border-transparent bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700">
                                <svg class="w-5 h-5 text-rose-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span class="hidden sm:inline">{{ __('Export') }}</span>
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('children.edit', $child) }}" class="btn btn-primary !rounded-2xl !bg-indigo-600 hover:!bg-indigo-700 shadow-xl shadow-indigo-500/20 group">
                                <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                <span>{{ __('Edit') }}</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Stats Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="stat-card accent-indigo animate-fade-in-up delay-75">
                <div class="flex items-center gap-4">
                    <div class="icon-box indigo !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Age') }}</p>
                        <h4 class="text-2xl font-black text-slate-800 dark:text-white">{{ $age }} <span class="text-sm font-bold text-slate-400">Yrs</span></h4>
                    </div>
                </div>
            </div>
            
            <div class="stat-card accent-emerald animate-fade-in-up delay-150">
                <div class="flex items-center gap-4">
                    <div class="icon-box emerald !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Tenure') }}</p>
                        <h4 class="text-2xl font-black text-slate-800 dark:text-white">{{ $tenureDisplay }}</h4>
                    </div>
                </div>
            </div>

            <div class="stat-card accent-blue animate-fade-in-up delay-225">
                <div class="flex items-center gap-4">
                    <div class="icon-box blue !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Category') }}</p>
                        <h4 class="text-xl font-black text-slate-800 dark:text-white capitalize">{{ $child->category }}</h4>
                    </div>
                </div>
            </div>

            <div class="stat-card accent-amber animate-fade-in-up delay-300">
                <div class="flex items-center gap-4">
                    <div class="icon-box amber !w-14 !h-14 !rounded-2xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Gender') }}</p>
                        <h4 class="text-xl font-black text-slate-800 dark:text-white capitalize">{{ $child->gender }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {{-- Left Column: Information --}}
            <div class="lg:col-span-2 space-y-12">
                {{-- Personal Details --}}
                <div class="glass-card !bg-white/50 dark:!bg-slate-900/50 p-8 border-transparent animate-fade-in-up delay-150">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box indigo shadow-lg shadow-indigo-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Admission & Records') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-indigo-500 uppercase tracking-widest mb-2">{{ __('Admission Date') }}</p>
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-200">{{ \Carbon\Carbon::parse($child->admission_date)->format('l, d F Y') }}</p>
                        </div>
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-blue-500 uppercase tracking-widest mb-2">{{ __('Place of Birth') }}</p>
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-200">{{ $child->place_of_birth }}</p>
                        </div>
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-emerald-500 uppercase tracking-widest mb-2">{{ __('Current Status') }}</p>
                            <p class="text-lg font-bold text-slate-700 dark:text-slate-200 capitalize">{{ $child->enrollment_status }}</p>
                        </div>
                        <div class="group p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <p class="text-xs font-black text-purple-500 uppercase tracking-widest mb-2">{{ __('Registration No.') }}</p>
                            <p class="text-lg font-bold font-mono text-slate-700 dark:text-slate-200">{{ $child->registration_number }}</p>
                        </div>
                    </div>
                </div>

                {{-- Legal Documents --}}
                <div class="glass-card !bg-white/50 dark:!bg-slate-900/50 p-8 border-transparent animate-fade-in-up delay-300">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="icon-box amber shadow-lg shadow-amber-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Legal Attachments') }}</h3>
                        </div>
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 dark:bg-slate-800 px-4 py-2 rounded-full uppercase tracking-widest">
                            {{ count($child->documents) }} Files
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse($child->documents as $doc)
                            <div class="group relative rounded-3xl border border-slate-200/50 dark:border-slate-700/50 bg-white dark:bg-slate-800 hover:border-indigo-400 dark:hover:border-indigo-500 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">
                                <div class="aspect-[4/3] bg-slate-50 dark:bg-slate-900 flex items-center justify-center relative overflow-hidden border-b border-slate-100 dark:border-slate-700">
                                    @if(in_array(strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                                        <img src="{{ Storage::disk('s3')->url($doc->file_path) }}" alt="{{ $doc->document_type }}" 
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
                                    <div class="absolute inset-0 bg-indigo-900/60 opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-[2px] flex items-center justify-center gap-3">
                                        <a href="{{ Storage::disk('s3')->url($doc->file_path) }}" target="_blank" class="w-12 h-12 bg-white dark:bg-slate-800 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center shadow-xl transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 delay-75">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ Storage::disk('s3')->url($doc->file_path) }}" download class="w-12 h-12 bg-white dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center shadow-xl transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 delay-150">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        </a>
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

            {{-- Right Column: Facility & Quick Links --}}
            <div class="space-y-12">
                {{-- Facility Card --}}
                <div class="glass-card overflow-hidden !rounded-[3rem] shadow-premium animate-fade-in-up delay-450 border-none relative group">
                    <div class="absolute inset-x-0 top-0 h-48 bg-indigo-600 -skew-y-6 origin-top-left -translate-y-12"></div>
                    
                    <div class="relative px-8 pt-10 pb-12">
                        <div class="flex items-center gap-4 mb-8 text-white">
                            <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <h3 class="text-xl font-black tracking-tight uppercase">{{ __('Facility Assignment') }}</h3>
                        </div>

                        @if($child->asrama)
                            <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] p-8 shadow-2xl border border-slate-100 dark:border-slate-700 text-center relative overflow-hidden group/card">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 dark:bg-indigo-500/5 rounded-full blur-3xl -translate-y-16 translate-x-16"></div>
                                
                                <div class="relative">
                                    <div class="w-24 h-24 rounded-[2rem] bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mx-auto mb-6 shadow-inner ring-1 ring-indigo-500/20">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    </div>
                                    <h4 class="text-2xl font-black text-slate-800 dark:text-white tracking-tighter">{{ $child->asrama->nama_asrama }}</h4>
                                    <div class="inline-flex mt-4 px-5 py-2 rounded-2xl bg-slate-100 dark:bg-slate-900 border border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400 font-mono text-xs font-bold uppercase tracking-widest">
                                        ID: {{ $child->asrama->kode_asrama }}
                                    </div>
                                    
                                    <div class="mt-8">
                                        <a href="{{ route('asramas.show', $child->asrama) }}" class="flex items-center justify-center gap-3 w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-lg shadow-indigo-500/30 group-hover/card:scale-[1.02]">
                                            {{ __('Entry Details') }}
                                            <svg class="w-4 h-4 group-hover/card:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-white/20 dark:bg-slate-800/20 backdrop-blur-sm rounded-[2.5rem] p-10 border-2 border-dashed border-white/30 dark:border-slate-700 text-center">
                                <div class="w-20 h-20 bg-white/10 rounded-[2rem] flex items-center justify-center text-white/40 mx-auto mb-6">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </div>
                                <p class="text-white font-black text-lg tracking-tight">{{ __('Not Assigned') }}</p>
                                <p class="text-white/60 text-xs font-bold mt-2 uppercase tracking-widest">{{ __('Update profile to assign') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Navigation Actions --}}
                <div class="glass-card !bg-slate-900 !rounded-[3rem] p-2 animate-fade-in-up delay-600 border-none">
                    <a href="{{ route('children.index') }}" class="group flex items-center gap-4 p-4 hover:bg-white/5 rounded-[2.5rem] transition-all">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white group-hover:bg-indigo-600 transition-colors">
                            <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        </div>
                        <div>
                            <p class="text-white font-black text-sm uppercase tracking-widest">{{ __('Back to List') }}</p>
                            <p class="text-slate-500 text-xs font-bold">Return to Management</p>
                        </div>
                    </a>
                </div>

                {{-- System Insight --}}
                <div class="bg-indigo-50 dark:bg-indigo-500/5 rounded-[2.5rem] p-8 border border-indigo-100/50 dark:border-indigo-500/10 animate-fade-in-up delay-[700ms]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full animate-ping"></div>
                        <span class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-[0.2em]">{{ __('System Insight') }}</span>
                    </div>
                    <p class="text-xs font-medium text-slate-500 dark:text-slate-400 leading-relaxed">
                        Registration ID <span class="font-bold text-slate-700 dark:text-slate-300">#{{ $child->id }}</span> is verified and synchronized with foundation standards.
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
