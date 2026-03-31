<section class="space-y-6">
    <div class="p-6 rounded-[1.5rem] bg-rose-500/5 border border-rose-500/10">
        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </div>

    <button 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-rose-600 hover:bg-rose-700 text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-rose-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]"
    >
        {{ __('Terminate Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <div class="flex items-center gap-4 mb-6">
                <div class="icon-box rose !w-12 !h-12 !rounded-2xl shadow-lg shadow-rose-500/10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">
                        {{ __('Confirm Termination?') }}
                    </h2>
                    <p class="text-[10px] font-black text-rose-500 uppercase tracking-widest">{{ __('Destructive Operation') }}</p>
                </div>
            </div>

            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-medium mb-8">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="space-y-2">
                <x-input-label for="password" value="{{ __('Password') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input-modern"
                    placeholder="{{ __('Verification Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex items-center justify-between gap-4">
                <button 
                    type="button" 
                    x-on:click="$dispatch('close')"
                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors"
                >
                    {{ __('Discontinue') }}
                </button>

                <button 
                    type="submit"
                    class="bg-rose-600 hover:bg-rose-700 text-white px-10 py-4 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-rose-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]"
                >
                    {{ __('Finalize Deletion') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
