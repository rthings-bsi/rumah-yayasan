<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Profile Settings') }}</span>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        {{-- Profile Hero Section --}}
        <div class="relative mb-12 animate-fade-in">
            <div class="absolute -top-24 -left-20 w-64 h-64 bg-green-500/10 blur-[100px] rounded-full"></div>
            <div class="absolute -bottom-24 -right-20 w-64 h-64 bg-purple-500/10 blur-[100px] rounded-full"></div>
            
            <div class="glass-card !p-6 md:!p-8 !rounded-[2.5rem] bg-green-600 dark:bg-green-700 text-white relative overflow-hidden shadow-premium group">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 blur-3xl rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-6 md:gap-8">
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-[1.5rem] md:rounded-[2rem] bg-white text-green-600 flex items-center justify-center text-3xl md:text-4xl font-black shadow-2xl shadow-green-900/20 ring-4 ring-white/20">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="text-center md:text-left">
                        <h1 class="text-2xl md:text-4xl font-black tracking-tight mb-2">{{ Auth::user()->name }}</h1>
                        <div class="flex flex-wrap justify-center md:justify-start items-center gap-2 md:gap-3">
                            <span class="px-3 md:px-4 py-1 rounded-xl bg-white/20 backdrop-blur-md text-[9px] md:text-[10px] font-black uppercase tracking-widest">{{ Auth::user()->role }} {{ __('Account') }}</span>
                            <span class="text-xs md:text-sm font-medium text-white/70">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div class="md:ml-auto flex items-center gap-2 px-3 md:px-4 py-1.5 md:py-2 rounded-2xl bg-black/20 backdrop-blur-md border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-[9px] md:text-[10px] font-black uppercase tracking-widest opacity-80">{{ __('Account Online') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            {{-- Profile Information Section --}}
            <div class="glass-card !p-0 !rounded-[2.5rem] bg-white/80 dark:bg-slate-900/80 border-white/40 dark:border-slate-800/50 shadow-premium animate-fade-in-up delay-150">
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 flex items-center gap-4">
                    <div class="icon-box green !w-12 !h-12 !rounded-2xl shadow-lg shadow-green-500/10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Profile Identity') }}</h3>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Administrative Credentials') }}</p>
                    </div>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password Section --}}
            <div class="glass-card !p-0 !rounded-[2.5rem] bg-white/80 dark:bg-slate-900/80 border-white/40 dark:border-slate-800/50 shadow-premium animate-fade-in-up delay-[300ms]">
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 flex items-center gap-4">
                    <div class="icon-box amber !w-12 !h-12 !rounded-2xl shadow-lg shadow-amber-500/10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Security Protocol') }}</h3>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Password Management') }}</p>
                    </div>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account Section --}}
            <div class="glass-card !p-0 !rounded-[2.5rem] bg-white/80 dark:bg-slate-900/80 border-white/40 dark:border-slate-800/50 shadow-premium animate-fade-in-up delay-[450ms]">
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 flex items-center gap-4">
                    <div class="icon-box rose !w-12 !h-12 !rounded-2xl shadow-lg shadow-rose-500/10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Danger Zone') }}</h3>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Account Termination') }}</p>
                    </div>
                </div>
                <div class="p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
