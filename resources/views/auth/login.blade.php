<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <div class="input-group">
            <input id="email" 
                   class="input-field" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder=" "
                   required 
                   autofocus 
                   autocomplete="username" />
            
            <i data-lucide="mail" class="input-icon w-5 h-5"></i>
            
            <label for="email" class="floating-label">Alamat Email</label>
            
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
        </div>

        <div class="input-group">
            <input id="password" 
                   class="input-field" 
                   type="password" 
                   name="password" 
                   placeholder=" "
                   required 
                   autocomplete="current-password" />
            
            <i data-lucide="lock" class="input-icon w-5 h-5"></i>
            <label for="password" class="floating-label">Kata Sandi</label>
            
            <button type="button" class="password-toggle" id="togglePassword" aria-label="Lihat password">
                <i data-lucide="eye" class="w-5 h-5" id="eyeIcon"></i>
            </button>
            
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <div class="flex items-center justify-between mb-8">
            <label for="remember_me" class="checkbox-wrapper">
                <input id="remember_me" type="checkbox" class="custom-checkbox" name="remember">
                <span class="text-sm text-slate-600 font-medium select-none">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-green-600 hover:text-green-700 hover:underline transition-all" 
                   href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary group" id="submitBtn">
            <span id="btnText">Masuk ke Sistem</span>
            <i data-lucide="log-in" id="btnIcon" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
        </button>
    </form>
</x-guest-layout>
