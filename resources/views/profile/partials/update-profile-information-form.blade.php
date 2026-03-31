<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <x-input-label for="name" :value="__('Name')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
            <x-text-input id="name" name="name" type="text" class="form-input-modern" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1" />
            <x-text-input id="email" name="email" type="email" class="form-input-modern" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-2xl bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20">
                    <p class="text-xs font-medium text-amber-800 dark:text-amber-400 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        {{ __('Your email address is unverified.') }}
                    </p>

                    <button form="send-verification" class="mt-2 text-xs font-black uppercase tracking-widest text-amber-600 hover:text-amber-700 underline transition-colors">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-black text-[10px] uppercase tracking-widest text-emerald-600 dark:text-emerald-400">
                            {{ __('A new verification link has been sent.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="md:col-span-2 flex items-center gap-4 mt-4 pt-6 border-t border-slate-100 dark:border-slate-800/50">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                {{ __('Commit Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest">{{ __('Applied Successfully') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>
