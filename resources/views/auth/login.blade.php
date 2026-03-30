<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input id="email" 
                       class="login-input" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="nama@email.com"
                       required 
                       autofocus 
                       autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-semibold text-slate-300 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password" 
                       class="login-input" 
                       type="password" 
                       name="password" 
                       placeholder="••••••••"
                       required 
                       autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Divider -->
        <div class="divider-line my-5"></div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="login-checkbox" name="remember">
                <span class="ms-2.5 text-sm text-slate-400 group-hover:text-slate-200 transition-colors select-none">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 font-medium transition-colors duration-200" 
                   href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="login-btn flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Masuk
        </button>
    </form>
</x-guest-layout>
