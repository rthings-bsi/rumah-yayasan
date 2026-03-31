<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition-colors">{{ __('Dashboard') }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('users.index') }}" class="hover:text-indigo-600 transition-colors">{{ __('Manage Users') }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Create New User') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="mb-8 animate-fade-in text-center">
            <h1 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Register New Account') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 font-medium">{{ __('Provision a new user account with specific access privileges.') }}</p>
        </div>

        <div class="glass-card !p-0 overflow-hidden shadow-premium animate-fade-in-up">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                
                <div class="p-8 space-y-8">
                    {{-- Identity Section --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-100 dark:border-slate-800/50">
                            <div class="icon-box indigo !w-10 !h-10 !rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">{{ __('Account Identity') }}</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <x-input-label for="name" :value="__('Full Name')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
                                <x-text-input id="name" name="name" type="text" class="form-input-modern" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="space-y-2">
                                <x-input-label for="email" :value="__('Email Address')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
                                <x-text-input id="email" name="email" type="email" class="form-input-modern" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Security & Access Section --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-100 dark:border-slate-800/50">
                            <div class="icon-box purple !w-10 !h-10 !rounded-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-tight">{{ __('Security & Access') }}</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <x-input-label for="role" :value="__('System Role')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
                                <select id="role" name="role" class="form-input-modern h-[50px] cursor-pointer" required>
                                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>{{ __('Staff Member (Standard Access)') }}</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>{{ __('Administrator (Full Access)') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div class="space-y-2">
                                <x-input-label for="password" :value="__('Account Password')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
                                <x-text-input id="password" name="password" type="password" class="form-input-modern" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="md:col-start-2 space-y-2">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="form-input-modern" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="p-8 bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                    <a href="{{ route('users.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-slate-600 transition-colors flex items-center gap-2 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        {{ __('Discard Changes') }}
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        {{ __('Initialize Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
