<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Yayasan Rumah Harapan') }} — Login</title>
        <meta name="description" content="Login to Rumah Harapan management system">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script src="https://unpkg.com/lucide@latest"></script>

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background-color: #f8fafc;
            }

            /* ===== Background Premium & Berdimensi ===== */
            .bg-elegant {
                background-color: #f8fafc;
                position: relative;
                overflow: hidden;
            }

            /* Ambient Glow (Aurora Effect) */
            .ambient-glow {
                position: absolute;
                width: 60vw;
                height: 60vw;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
                top: -20%;
                left: -15%;
                filter: blur(60px);
                animation: floatAura 15s ease-in-out infinite alternate;
                z-index: 0;
            }

            .ambient-glow-2 {
                position: absolute;
                width: 50vw;
                height: 50vw;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(20, 184, 166, 0.06) 0%, rgba(255, 255, 255, 0) 70%);
                bottom: -15%;
                right: -10%;
                filter: blur(60px);
                animation: floatAura2 18s ease-in-out infinite alternate;
                z-index: 0;
            }

            /* Tekstur Titik Halus (Dot Pattern) */
            .bg-texture {
                position: absolute;
                inset: 0;
                background-image: radial-gradient(rgba(148, 163, 184, 0.2) 1px, transparent 1px);
                background-size: 32px 32px;
                z-index: 1;
                /* Masking agar tekstur hanya terlihat di pinggir, memudar di tengah */
                mask-image: radial-gradient(ellipse at center, transparent 30%, black 100%);
                -webkit-mask-image: radial-gradient(ellipse at center, transparent 30%, black 100%);
                pointer-events: none;
            }

            /* Objek Kaca Melayang (Floating Glass) */
            .glass-shape {
                position: absolute;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.6) 0%, rgba(255, 255, 255, 0.1) 100%);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.8);
                border-radius: 50%;
                z-index: 2;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.02);
            }

            .shape-1 {
                width: 140px;
                height: 140px;
                top: 15%;
                right: 18%;
                animation: floatObj 8s ease-in-out infinite;
            }

            .shape-2 {
                width: 80px;
                height: 80px;
                bottom: 25%;
                left: 15%;
                animation: floatObj 12s ease-in-out infinite reverse;
            }

            @keyframes floatAura {
                0% { transform: translate(0, 0) scale(1); }
                100% { transform: translate(5%, 5%) scale(1.1); }
            }

            @keyframes floatAura2 {
                0% { transform: translate(0, 0) scale(1); }
                100% { transform: translate(-5%, -5%) scale(1.15); }
            }

            @keyframes floatObj {
                0% { transform: translateY(0) scale(1); }
                50% { transform: translateY(-25px) scale(1.02); }
                100% { transform: translateY(0) scale(1); }
            }

            /* ===== Kartu Login Glassmorphism ===== */
            .glass-card {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(25px);
                -webkit-backdrop-filter: blur(25px);
                border: 1px solid rgba(255, 255, 255, 1);
                box-shadow: 0 25px 50px -12px rgba(22, 163, 74, 0.08), 
                            0 0 15px rgba(0, 0, 0, 0.02);
                border-radius: 28px;
                z-index: 10;
                position: relative;
            }

            /* ===== Input & Floating Label UX ===== */
            .input-group {
                position: relative;
                margin-bottom: 1.5rem;
            }

            .input-field {
                width: 100%;
                padding: 1rem 1rem 1rem 3rem;
                font-size: 0.95rem;
                color: #1e293b;
                background: #ffffff;
                border: 1.5px solid #e2e8f0;
                border-radius: 14px;
                transition: all 0.3s ease;
                outline: none;
                box-shadow: inset 0 2px 4px rgba(0,0,0,0.01);
            }

            .input-field:focus {
                border-color: #16a34a;
                box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1), inset 0 2px 4px rgba(0,0,0,0.01);
            }

            .input-icon {
                position: absolute;
                left: 1.125rem;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                transition: color 0.3s ease;
                pointer-events: none;
            }

            .input-field:focus ~ .input-icon,
            .input-field:not(:placeholder-shown) ~ .input-icon {
                color: #16a34a;
            }

            .floating-label {
                position: absolute;
                left: 3rem;
                top: 50%;
                transform: translateY(-50%);
                color: #94a3b8;
                font-size: 0.95rem;
                pointer-events: none;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                background: transparent;
            }

            .input-field:focus ~ .floating-label,
            .input-field:not(:placeholder-shown) ~ .floating-label {
                top: 0;
                left: 1rem;
                font-size: 0.75rem;
                font-weight: 600;
                color: #16a34a;
                background: #ffffff;
                padding: 0 0.5rem;
                transform: translateY(-50%);
                border-radius: 4px;
            }

            /* ===== Fitur Lihat Password ===== */
            .password-toggle {
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #94a3b8;
                cursor: pointer;
                transition: color 0.2s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 0.25rem;
            }
            .password-toggle:hover {
                color: #16a34a;
            }

            /* ===== Custom Checkbox UX ===== */
            .checkbox-wrapper {
                display: flex;
                align-items: center;
                cursor: pointer;
                gap: 0.5rem;
            }
            .custom-checkbox {
                appearance: none;
                width: 1.25rem;
                height: 1.25rem;
                border: 2px solid #cbd5e1;
                border-radius: 6px;
                background-color: white;
                cursor: pointer;
                position: relative;
                transition: all 0.2s ease;
            }
            .custom-checkbox:checked {
                background-color: #16a34a;
                border-color: #16a34a;
            }
            .custom-checkbox:checked::after {
                content: '';
                position: absolute;
                left: 6px;
                top: 2px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }

            /* ===== Tombol Login ===== */
            .btn-primary {
                background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
                color: white;
                font-weight: 600;
                border-radius: 14px;
                padding: 0.875rem 1.5rem;
                width: 100%;
                border: none;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 0.5rem;
                box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);
            }
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(22, 163, 74, 0.35);
            }
            .btn-primary:active {
                transform: translateY(1px);
            }

            /* Animasi masuk elemen */
            .animate-fade-in {
                animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                opacity: 0;
                transform: translateY(20px);
            }
            @keyframes fadeInUp {
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body class="text-slate-800">
        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 bg-elegant">
            
            <div class="ambient-glow"></div>
            <div class="ambient-glow-2"></div>
            <div class="bg-texture"></div>
            <div class="glass-shape shape-1"></div>
            <div class="glass-shape shape-2"></div>

            <div class="text-center mb-8 animate-fade-in relative z-10" style="animation-delay: 0.1s;">
                <div class="inline-flex items-center justify-center p-3.5 bg-white rounded-2xl shadow-sm border border-slate-100 mb-4 ring-4 ring-white/50 backdrop-blur-sm">
                    <x-application-logo class="w-12 h-12 text-green-600" />
                </div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Rumah Harapan</h1>
                <p class="text-slate-500 text-sm font-medium mt-1">Sistem Manajemen Terpadu</p>
            </div>

            <div class="w-full max-w-md glass-card p-8 sm:p-10 animate-fade-in" style="animation-delay: 0.2s;">
                
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Selamat Datang</h2>
                    <p class="text-sm text-slate-500 mt-1.5">Silakan masuk menggunakan kredensial Anda.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="input-group">
                        <input type="email" id="email" name="email" class="input-field" placeholder=" " required autofocus autocomplete="username" value="{{ old('email') }}">
                        <i data-lucide="mail" class="input-icon w-5 h-5"></i>
                        <label for="email" class="floating-label">Alamat Email</label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
                    </div>

                    <div class="input-group">
                        <input type="password" id="password" name="password" class="input-field" placeholder=" " required autocomplete="current-password">
                        <i data-lucide="lock" class="input-icon w-5 h-5"></i>
                        <label for="password" class="floating-label">Kata Sandi</label>
                        <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password visibility">
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
                            <a class="text-sm font-semibold text-green-600 hover:text-green-700 hover:underline transition-all" href="{{ route('password.request') }}">
                                Lupa sandi?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary group" id="submitBtn">
                        <span id="btnText">Masuk ke Sistem</span>
                        <i data-lucide="arrow-right" id="btnIcon" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>

            <div class="mt-10 text-center animate-fade-in relative z-10" style="animation-delay: 0.3s;">
                <p class="text-sm text-slate-500 font-medium tracking-wide">
                    &copy; {{ date('Y') }} Yayasan Rumah Harapan. <br class="sm:hidden">Semua hak dilindungi.
                </p>
            </div>
        </div>

        <script>
            // Inisialisasi Icon
            lucide.createIcons();

            // Toggle Show/Hide Password
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#password');
            const eyeIcon = document.querySelector('#eyeIcon');

            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                eyeIcon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
                lucide.createIcons();
            });

            // State Loading Saat Form Disubmit
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');

            loginForm.addEventListener('submit', function() {
                btnIcon.style.display = 'none';
                submitBtn.style.opacity = '0.85';
                submitBtn.style.cursor = 'not-allowed';
                btnText.innerHTML = `
                    <div class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </div>
                `;
            });
        </script>
    </body>
</html>
