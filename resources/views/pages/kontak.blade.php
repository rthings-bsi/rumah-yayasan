<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="{ 'dark': $store.darkMode.on }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubungi Kami | Rumah Harapan — Yayasan Kasih Sesama</title>
    <meta name="description" content="Hubungi Rumah Harapan — Kami siap mendengar dan membantu. Silakan hubungi kami melalui telepon, email, atau kunjungi kantor kami untuk informasi lebih lanjut.">

    <!-- Anti-flash: apply dark class before paint -->
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        /* ===== KONTAK PAGE PREMIUM STYLES ===== */
        /* Section divider */
        .section-divider {
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #16a34a, #22c55e);
            border-radius: 999px;
            margin: 0 auto;
        }
        .dark .section-divider {
            background: linear-gradient(90deg, #4ade80, #22c55e);
        }

        /* Gradient text */
        .text-gradient-green {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .dark .text-gradient-green {
            background: linear-gradient(135deg, #4ade80, #22c55e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Dot pattern */
        .dot-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(22, 163, 74, 0.08) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
            z-index: 0;
        }

        /* Scroll-triggered visibility */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Fade in up keyframes */
        .animate-fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .delay-75  { animation-delay: 0.075s; }
        .delay-150 { animation-delay: 0.15s; }
        .delay-225 { animation-delay: 0.225s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Floating animation */
            50% { transform: translateY(-12px); }
        }

        /* Contact icon background */
        .contact-icon-bg {
            position: relative;
        }
        .contact-icon-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.08;
            transform: scale(1.5);
            pointer-events: none;
        }

        /* Form input styling */
        .form-input {
            @apply w-full px-5 py-4 rounded-2xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 border-2 border-slate-200 dark:border-slate-700 font-medium text-sm transition-all duration-300;
        }
        .form-input:focus {
            @apply outline-none border-brand-primary dark:border-green-400 ring-4 ring-brand-primary/10 dark:ring-green-400/10;
        }
        .form-input.error {
            @apply border-red-400 dark:border-red-500 ring-4 ring-red-400/10 dark:ring-red-500/10;
        }

        /* Form textarea specific */
        .form-textarea {
            @apply form-input resize-none min-h-[160px];
        }

        /* Form label */
        .form-label {
            @apply block text-xs font-black uppercase tracking-[0.15em] text-slate-700 dark:text-slate-300 mb-3;
        }

        /* CTA glow */
        .cta-glow {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(22, 163, 74, 0.15) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 50%, rgba(251, 191, 36, 0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        /* Social media icon hover */
        .social-icon {
            @apply w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-500;
        }

        /* Google maps embed responsive */
        .map-container {
            @apply relative w-full overflow-hidden rounded-[2.5rem];
            padding-bottom: 45%;
        }
        .map-container iframe {
            @apply absolute top-0 left-0 w-full h-full border-0;
        }

        /* Smooth anchor scroll offset */
        html {
            scroll-behavior: smooth;
        }

        /* Success message animation */
        @keyframes successPop {
            0% { transform: scale(0.8); opacity: 0; }
            60% { transform: scale(1.05); }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-success {
            animation: successPop 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-['Plus_Jakarta_Sans',sans-serif]">

    <x-site-navbar />

    <main>

        <!-- ============================================================ -->
        <!-- 1. HERO SUBHEADER                                             -->
        <!-- ============================================================ -->
        <section class="relative min-h-[50vh] flex items-center overflow-hidden bg-slate-50 dark:bg-slate-900 dark:from-slate-900 dark:via-slate-950 dark:to-slate-950">

            <!-- Dot Pattern -->
            <div class="dot-pattern"></div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <!-- Icon -->
                <div class="mb-8 animate-fade-in-up">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-md rounded-[1.5rem] flex items-center justify-center mx-auto border border-white/15">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-6 leading-[1.1] tracking-tight animate-fade-in-up delay-75">
                    {{ __('Dukung') }} <span class="text-brand-accent">{{ __('Misi Kami') }}</span>
                </h2>

                <p class="text-lg sm:text-xl text-white/70 leading-relaxed max-w-2xl mx-auto font-medium mb-10 animate-fade-in-up delay-150">
                    {{ __('Setiap doa, donasi, dan waktu yang Anda berikan adalah langkah nyata menuju masa depan yang lebih cerah bagi mereka yang membutuhkan.') }}
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-225">
                    <a href="#" class="group inline-flex items-center justify-center gap-3 bg-brand-accent hover:bg-yellow-400 text-slate-900 px-10 py-5 rounded-2xl font-black text-sm uppercase tracking-[0.15em] shadow-xl shadow-amber-500/20 hover:shadow-2xl hover:shadow-amber-500/30 transition-all duration-300 active:scale-95">
                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ __('Donasi Sekarang') }}</span>
                    </a>
                    <a href="{{ route('program') }}" class="group inline-flex items-center justify-center gap-3 bg-white/10 backdrop-blur-md hover:bg-white/20 text-white px-10 py-5 rounded-2xl font-black text-sm uppercase tracking-[0.15em] border-2 border-white/20 hover:border-white/40 transition-all duration-300 active:scale-95">
                        <svg class="w-5 h-5 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>{{ __('Lihat Program') }}</span>
                    </a>
                </div>

                <!-- Bottom trust text -->
                <p class="text-white/40 text-xs font-bold uppercase tracking-[0.15em] mt-10 animate-fade-in-up delay-300">
                    {{ __('Bersama kita wujudkan perubahan — satu kebaikan pada satu waktu') }}
                </p>
            </div>

            <!-- Bottom Wave -->
            <div class="absolute bottom-0 left-0 right-0 z-10">
                <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                    <path d="M0 60V20C240 0 480 40 720 40C960 40 1200 0 1440 20V60H0Z" fill="white" class="fill-white dark:fill-slate-950"/>
                </svg>
            </div>
        </section>

    </main>

    <x-site-footer />

    <script>
        // ===== Scroll Reveal Logic =====
        document.addEventListener('DOMContentLoaded', function() {
            const revealEls = document.querySelectorAll('.reveal');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            revealEls.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
