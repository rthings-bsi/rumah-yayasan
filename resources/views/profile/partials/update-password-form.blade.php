<section>
    <form method="post" action="{{ route('password.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('put')

        <div class="space-y-2 md:col-span-2">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-input-modern" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
            <x-text-input id="update_password_password" name="password" type="password" class="form-input-modern" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input-modern" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="md:col-span-2 flex items-center gap-4 mt-4 pt-6 border-t border-slate-100 dark:border-slate-800/50">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                {{ __('Update Security') }}
            </button>

            @if (session('status') === 'password-updated')
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ __('Security Hardened') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
