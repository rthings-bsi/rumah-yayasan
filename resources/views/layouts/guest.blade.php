<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Yayasan') }} — Login</title>
        <meta name="description" content="Login to Rumah Harapan management system">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ===== Login Page Specific Styles ===== */
            .login-bg {
                background: linear-gradient(135deg, #0c0a1a 0%, #151030 25%, #1a1145 50%, #0f172a 100%);
                position: relative;
            }

            /* Mesh gradient overlay */
            .login-bg::before {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(ellipse 80% 60% at 10% 90%, rgba(99, 102, 241, 0.15) 0%, transparent 60%),
                    radial-gradient(ellipse 60% 50% at 90% 10%, rgba(139, 92, 246, 0.12) 0%, transparent 50%),
                    radial-gradient(ellipse 50% 40% at 50% 50%, rgba(79, 70, 229, 0.08) 0%, transparent 50%);
                pointer-events: none;
            }

            /* Animated grid pattern */
            .grid-pattern {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
                background-size: 60px 60px;
                mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
                -webkit-mask-image: radial-gradient(ellipse at center, black 30%, transparent 70%);
            }

            /* Floating orbs */
            @keyframes orbFloat1 {
                0%, 100% { transform: translate(0, 0) scale(1); }
                25% { transform: translate(30px, -40px) scale(1.05); }
                50% { transform: translate(-20px, -80px) scale(0.95); }
                75% { transform: translate(40px, -30px) scale(1.02); }
            }
            @keyframes orbFloat2 {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(-50px, 30px) scale(1.1); }
                66% { transform: translate(30px, -50px) scale(0.9); }
            }
            @keyframes orbFloat3 {
                0%, 100% { transform: translate(0, 0); }
                50% { transform: translate(60px, 40px); }
            }

            .orb-1 {
                position: absolute;
                width: 300px;
                height: 300px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(99, 102, 241, 0) 70%);
                filter: blur(60px);
                animation: orbFloat1 12s ease-in-out infinite;
                top: -5%;
                right: -5%;
            }
            .orb-2 {
                position: absolute;
                width: 400px;
                height: 400px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, rgba(139, 92, 246, 0) 70%);
                filter: blur(80px);
                animation: orbFloat2 15s ease-in-out infinite;
                bottom: -10%;
                left: -10%;
            }
            .orb-3 {
                position: absolute;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0) 70%);
                filter: blur(40px);
                animation: orbFloat3 10s ease-in-out infinite;
                top: 40%;
                left: 30%;
            }

            /* Glowing ring */
            @keyframes ringPulse {
                0%, 100% { opacity: 0.3; transform: translate(-50%, -50%) scale(1); }
                50% { opacity: 0.6; transform: translate(-50%, -50%) scale(1.05); }
            }
            .glow-ring {
                position: absolute;
                width: 500px;
                height: 500px;
                border-radius: 50%;
                border: 1px solid rgba(99, 102, 241, 0.1);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                animation: ringPulse 4s ease-in-out infinite;
            }
            .glow-ring::after {
                content: '';
                position: absolute;
                inset: 30px;
                border-radius: 50%;
                border: 1px solid rgba(139, 92, 246, 0.08);
            }

            /* Card animations */
            @keyframes cardReveal {
                from {
                    opacity: 0;
                    transform: translateY(30px) scale(0.96);
                    filter: blur(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                    filter: blur(0);
                }
            }
            @keyframes brandReveal {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            @keyframes footerReveal {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .animate-card-reveal {
                animation: cardReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }
            .animate-brand-reveal {
                animation: brandReveal 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }
            .animate-footer-reveal {
                animation: footerReveal 0.5s ease-out 0.5s forwards;
                opacity: 0;
            }

            /* Login card glass effect */
            .login-card {
                background: rgba(255, 255, 255, 0.04);
                backdrop-filter: blur(40px);
                -webkit-backdrop-filter: blur(40px);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 1.5rem;
                box-shadow:
                    0 0 0 1px rgba(255, 255, 255, 0.05) inset,
                    0 25px 50px -12px rgba(0, 0, 0, 0.4),
                    0 0 80px rgba(99, 102, 241, 0.06);
                position: relative;
                overflow: hidden;
            }
            .login-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            }

            /* Inner form card — dark mode */
            .login-form-inner {
                background: rgba(15, 23, 42, 0.8);
                backdrop-filter: blur(20px);
                border-radius: 1rem;
                border: 1px solid rgba(255, 255, 255, 0.06);
                box-shadow:
                    0 4px 6px -1px rgba(0, 0, 0, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.03) inset;
            }

            /* Input styling — dark mode */
            .login-input {
                width: 100%;
                padding: 0.75rem 1rem;
                padding-left: 2.75rem;
                border: 1.5px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.875rem;
                background: rgba(255, 255, 255, 0.05);
                color: #e2e8f0;
                font-size: 0.875rem;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                outline: none;
            }
            .login-input::placeholder {
                color: #64748b;
            }
            .login-input:focus {
                border-color: #818cf8;
                background: rgba(255, 255, 255, 0.08);
                box-shadow:
                    0 0 0 3px rgba(99, 102, 241, 0.15),
                    0 1px 2px rgba(0, 0, 0, 0.2);
            }
            .login-input:hover:not(:focus) {
                border-color: rgba(255, 255, 255, 0.15);
                background: rgba(255, 255, 255, 0.07);
            }

            /* Login button */
            .login-btn {
                width: 100%;
                padding: 0.75rem 1.5rem;
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
                color: white;
                font-weight: 600;
                font-size: 0.875rem;
                border-radius: 0.875rem;
                border: none;
                cursor: pointer;
                position: relative;
                overflow: hidden;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow:
                    0 4px 15px rgba(99, 102, 241, 0.35),
                    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
                letter-spacing: 0.025em;
            }
            .login-btn:hover {
                transform: translateY(-2px);
                box-shadow:
                    0 8px 25px rgba(99, 102, 241, 0.45),
                    0 0 0 1px rgba(255, 255, 255, 0.15) inset;
                background: linear-gradient(135deg, #818cf8 0%, #6366f1 50%, #4f46e5 100%);
            }
            .login-btn:active {
                transform: translateY(0);
                box-shadow:
                    0 2px 10px rgba(99, 102, 241, 0.3),
                    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            }
            .login-btn::after {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
                transition: left 0.5s ease;
            }
            .login-btn:hover::after {
                left: 100%;
            }

            /* Divider line — dark mode */
            .divider-line {
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            }

            /* Checkbox styling — dark mode */
            .login-checkbox {
                width: 1rem;
                height: 1rem;
                border-radius: 0.375rem;
                border: 1.5px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.05);
                accent-color: #818cf8;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            .login-checkbox:checked {
                border-color: #818cf8;
            }

            /* Particles */
            @keyframes particleFade {
                0%, 100% { opacity: 0; }
                50% { opacity: 1; }
            }
            .particle {
                position: absolute;
                width: 2px;
                height: 2px;
                background: rgba(165, 180, 252, 0.4);
                border-radius: 50%;
                animation: particleFade 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 login-bg">

            <!-- Background effects -->
            <div class="grid-pattern"></div>
            <div class="orb-1"></div>
            <div class="orb-2"></div>
            <div class="orb-3"></div>
            <div class="glow-ring"></div>

            <!-- Particles -->
            <div class="particle" style="top: 15%; left: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="top: 25%; left: 80%; animation-delay: 0.8s;"></div>
            <div class="particle" style="top: 60%; left: 15%; animation-delay: 1.5s;"></div>
            <div class="particle" style="top: 75%; left: 70%; animation-delay: 2.2s;"></div>
            <div class="particle" style="top: 40%; left: 90%; animation-delay: 0.4s;"></div>
            <div class="particle" style="top: 85%; left: 40%; animation-delay: 1.8s;"></div>

            <!-- Branding -->
            <div class="relative mb-10 animate-brand-reveal">
                <div class="flex flex-col items-center gap-4">
                    <div class="relative">
                        <!-- Logo glow -->
                        <div class="absolute inset-0 bg-indigo-500/30 rounded-2xl blur-xl scale-150"></div>
                        <div class="relative p-4 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-2xl shadow-indigo-500/30">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="text-white text-2xl font-bold tracking-tight">Rumah Harapan</h1>
                        <p class="text-indigo-300/70 text-sm mt-1 font-light tracking-wide">Management System</p>
                    </div>
                </div>
            </div>

            <!-- Login Card -->
            <div class="w-full max-w-md relative animate-card-reveal" style="animation-delay: 150ms; opacity: 0; animation-fill-mode: forwards;">
                <div class="login-card p-1.5">
                    <div class="login-form-inner px-8 py-8">
                        <!-- Card Header -->
                        <div class="text-center mb-7">
                            <h2 class="text-xl font-bold text-white tracking-tight">Selamat Datang</h2>
                            <p class="text-slate-500 text-sm mt-1.5">Masuk ke akun Anda untuk melanjutkan</p>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <p class="relative text-indigo-300/40 text-xs mt-10 animate-footer-reveal tracking-wide">
                &copy; {{ date('Y') }} Rumah Harapan &mdash; All rights reserved.
            </p>
        </div>
    </body>
</html>
