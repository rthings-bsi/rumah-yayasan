<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="{ 'dark': $store.darkMode.on }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Berita' }} | Rumah Harapan — Yayasan Kasih Sesama</title>
    <meta name="description" content="Baca selengkapnya tentang {{ $title ?? 'artikel' }} di Rumah Harapan — Yayasan Kasih Sesama.">

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

        /* ===== BERITA DETAIL PAGE PREMIUM STYLES ===== */
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

        /* Floating animation */
            50% { transform: translateY(-12px); }
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

        /* Article content typography */
        .article-content h2 {
            font-size: 1.75rem;
            font-weight: 900;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: inherit;
        }
        .article-content h3 {
            font-size: 1.35rem;
            font-weight: 800;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            color: inherit;
        }
        .article-content p {
            font-size: 1.05rem;
            line-height: 1.85;
            margin-bottom: 1.25rem;
            @apply text-slate-600 dark:text-slate-300;
        }
        .article-content ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 1.5rem;
        }
        .article-content ul li {
            position: relative;
            padding-left: 1.75rem;
            margin-bottom: 0.75rem;
            font-size: 1.05rem;
            line-height: 1.7;
            @apply text-slate-600 dark:text-slate-300;
        }
        .article-content ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.6em;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #16a34a;
        }
        .article-content blockquote {
            border-left: 4px solid #16a34a;
            padding: 1.25rem 1.5rem;
            margin: 2rem 0;
            border-radius: 0 1rem 1rem 0;
            font-style: italic;
            font-size: 1.1rem;
            line-height: 1.7;
            @apply bg-green-50/50 dark:bg-green-500/5 text-slate-600 dark:text-slate-300;
        }
        .article-content .highlight-box {
            padding: 1.5rem 2rem;
            border-radius: 1.5rem;
            margin: 2rem 0;
            @apply bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-100/50 dark:border-green-500/10;
        }

        /* Share button */
        .share-btn {
            @apply w-11 h-11 rounded-xl flex items-center justify-center transition-all duration-200 active:scale-90;
        }

        /* Related article card */
        .related-card {
            @apply group flex gap-4 p-4 rounded-2xl transition-all duration-300;
        }
        .related-card:hover {
            @apply bg-green-50 dark:bg-green-500/5;
        }

        /* Back button */
        .back-btn {
            @apply inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-black text-xs uppercase tracking-[0.1em] transition-all duration-200 active:scale-95;
        }

        /* Smooth anchor scroll offset */
        html {
            scroll-behavior: smooth;
        }

        /* Table of contents sticky sidebar */
        .toc-item {
            @apply block py-2 text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-brand-primary dark:hover:text-green-400 transition-colors border-l-2 border-transparent hover:border-brand-primary dark:hover:border-green-400 pl-4 -ml-1;
        }
        .toc-item.active {
            @apply text-brand-primary dark:text-green-400 border-brand-primary dark:border-green-400;
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 font-['Plus_Jakarta_Sans',sans-serif]">

    <x-site-navbar />

    <main>

        @php
            // Derive a human-readable title and metadata from the slug
            $title = ucwords(str_replace('-', ' ', $slug));

            // Sample article data keyed by slug — in a real app this comes from the database
            $articles = [
                'beasiswa-pendidikan-2026' => [
                    'title' => 'Program Beasiswa Pendidikan 2026 Telah Dibuka',
                    'date' => '15 Juni 2026',
                    'category' => 'Pendidikan',
                    'category_class' => 'bg-green-100 text-green-700 dark:bg-green-500/15 dark:text-green-400',
                    'author' => 'Tim Redaksi Rumah Harapan',
                    'read_time' => '5 menit',
                ],
                'layanan-kesehatan-keliling' => [
                    'title' => 'Layanan Kesehatan Keliling Menjangkau 5 Desa',
                    'date' => '10 Juni 2026',
                    'category' => 'Kesehatan',
                    'category_class' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
                    'author' => 'Tim Medis Rumah Harapan',
                    'read_time' => '4 menit',
                ],
                'donasi-bencana-alam' => [
                    'title' => 'Rumah Harapan Salurkan Bantuan untuk Korban Bencana',
                    'date' => '5 Juni 2026',
                    'category' => 'Bantuan Sosial',
                    'category_class' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/15 dark:text-blue-400',
                    'author' => 'Tim Program Rumah Harapan',
                    'read_time' => '3 menit',
                ],
                'workshop-keterampilan-orang-tua' => [
                    'title' => 'Workshop Keterampilan untuk Orang Tua: Membangun Ekonomi Keluarga',
                    'date' => '28 Mei 2026',
                    'category' => 'Pendidikan',
                    'category_class' => 'bg-green-100 text-green-700 dark:bg-green-500/15 dark:text-green-400',
                    'author' => 'Tim Pemberdayaan Rumah Harapan',
                    'read_time' => '6 menit',
                ],
                'peringatan-hari-anak-nasional' => [
                    'title' => 'Peringatan Hari Anak Nasional Bersama 300 Anak Binaan',
                    'date' => '20 Mei 2026',
                    'category' => 'Acara',
                    'category_class' => 'bg-rose-100 text-rose-700 dark:bg-rose-500/15 dark:text-rose-400',
                    'author' => 'Tim Acara Rumah Harapan',
                    'read_time' => '4 menit',
                ],
                'konseling-psikologi-gratis' => [
                    'title' => 'Layanan Konseling Psikologi Gratis untuk Masyarakat',
                    'date' => '15 Mei 2026',
                    'category' => 'Kesehatan',
                    'category_class' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
                    'author' => 'Tim Kesehatan Mental Rumah Harapan',
                    'read_time' => '5 menit',
                ],
                'donasi-buku-untuk-perpustakaan' => [
                    'title' => 'Gerakan Donasi Buku: Membangun Perpustakaan Desa',
                    'date' => '8 Mei 2026',
                    'category' => 'Pendidikan',
                    'category_class' => 'bg-green-100 text-green-700 dark:bg-green-500/15 dark:text-green-400',
                    'author' => 'Tim Pendidikan Rumah Harapan',
                    'read_time' => '3 menit',
                ],
                'program-makanan-sehat-anak' => [
                    'title' => 'Program Makanan Sehat untuk Tumbuh Kembang Anak',
                    'date' => '1 Mei 2026',
                    'category' => 'Kesehatan',
                    'category_class' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
                    'author' => 'Tim Gizi Rumah Harapan',
                    'read_time' => '4 menit',
                ],
                'relawan-muda-menginspirasi' => [
                    'title' => 'Kisah Relawan Muda yang Menginspirasi',
                    'date' => '25 April 2026',
                    'category' => 'Umum',
                    'category_class' => 'bg-purple-100 text-purple-700 dark:bg-purple-500/15 dark:text-purple-400',
                    'author' => 'Tim Relawan Rumah Harapan',
                    'read_time' => '7 menit',
                ],
            ];

            $article = $articles[$slug] ?? [
                'title' => $title,
                'date' => '—',
                'category' => 'Umum',
                'category_class' => 'bg-purple-100 text-purple-700 dark:bg-purple-500/15 dark:text-purple-400',
                'author' => 'Tim Redaksi Rumah Harapan',
                'read_time' => '5 menit',
            ];

            $articleTitle = $article['title'];
            $articleDate = $article['date'];
            $articleCategory = $article['category'];
            $articleCategoryClass = $article['category_class'];
            $articleAuthor = $article['author'];
            $articleReadTime = $article['read_time'];

            // Related articles (exclude current)
            $relatedArticles = collect($articles)->except($slug)->take(4);
        @endphp

        <!-- ============================================================ -->
        <!-- 1. HERO WITH TITLE                                           -->
        <!-- ============================================================ -->
        <section class="relative min-h-[40vh] flex items-center overflow-hidden bg-slate-50 dark:bg-slate-900 dark:from-slate-900 dark:via-slate-950 dark:to-slate-950">

            <!-- Dot Pattern -->
            <div class="dot-pattern"></div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-30 pt-20 pb-32 lg:pt-32 lg:pb-40 text-center">
                <div class="space-y-6">
                    <!-- Breadcrumb -->
                    <div class="animate-fade-in-up">
                        <nav class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">
                            <a href="{{ route('berita') }}" class="hover:text-brand-primary dark:hover:text-green-400 transition-colors">
                                {{ __('Berita') }}
                            </a>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-brand-primary dark:text-green-400">{{ $articleCategory }}</span>
                        </nav>
                    </div>

                    <!-- Category Badge -->
                    <div class="animate-fade-in-up delay-75">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-black uppercase tracking-[0.15em] {{ $articleCategoryClass }}">
                            {{ $articleCategory }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-[1.15] tracking-tight animate-fade-in-up delay-150 max-w-4xl mx-auto">
                        {{ $articleTitle }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap justify-center gap-4 sm:gap-8 text-sm font-medium text-slate-500 dark:text-slate-400 animate-fade-in-up delay-225">
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $articleAuthor }}
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $articleDate }}
                        </span>
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $articleReadTime }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Wave Divider -->
            <div class="absolute bottom-0 left-0 right-0 z-10">
                <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                    <path d="M0 60V20C240 0 480 40 720 40C960 40 1200 0 1440 20V60H0Z" fill="white" class="fill-white dark:fill-slate-950"/>
                </svg>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 2. ARTICLE CONTENT + SIDEBAR                                  -->
        <!-- ============================================================ -->
        <section class="relative py-16 lg:py-24 bg-white dark:bg-slate-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">

                    <!-- ================================================ -->
                    <!-- MAIN CONTENT COLUMN                              -->
                    <!-- ================================================ -->
                    <div class="lg:col-span-8">

                        <!-- Featured Image Placeholder -->
                        <div class="relative w-full h-64 sm:h-80 lg:h-96 rounded-[2.5rem] overflow-hidden mb-10 reveal">
                            <div class="absolute inset-0 bg-gradient-to-br from-brand-primary via-green-500 to-emerald-400 dark:from-green-600 dark:via-green-700 dark:to-emerald-800">
                                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 40%, rgba(255,255,255,0.12) 0%, transparent 50%), radial-gradient(circle at 80% 60%, rgba(255,255,255,0.06) 0%, transparent 40%);"></div>
                                <!-- Decorative icon -->
                                <div class="absolute bottom-4 right-6 text-7xl opacity-20 select-none" aria-hidden="true">📰</div>
                            </div>
                            <!-- Image caption -->
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/40 to-transparent p-6">
                                <span class="text-white/80 text-xs font-bold uppercase tracking-[0.1em]">{{ __('Ilustrasi') }} — {{ $articleTitle }}</span>
                            </div>
                        </div>

                        <!-- Share Buttons (Top) -->
                        <div class="flex flex-wrap items-center gap-3 mb-10 reveal">
                            <span class="text-xs font-black uppercase tracking-[0.15em] text-slate-400 dark:text-slate-500 mr-2">{{ __('Bagikan:') }}</span>

                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-btn bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-500/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>

                            <!-- Twitter / X -->
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($articleTitle) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-btn bg-slate-800 dark:bg-slate-700 text-white hover:bg-slate-900 dark:hover:bg-slate-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://wa.me/?text={{ urlencode($articleTitle . ' — ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-btn bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-500/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </a>

                            <!-- Telegram -->
                            <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($articleTitle) }}" target="_blank" rel="noopener noreferrer" class="share-btn bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 hover:bg-sky-100 dark:hover:bg-sky-500/20">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0012 0a12 12 0 00-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 01.171.325c.016.127.037.336.027.52-.096 2.639-.847 9.044-1.198 11.995-.134.574-.321.669-.564.704-.376.054-.66-.248-1.024-.486-1.073-.701-2.724-1.706-4.222-2.745-.482-.336-.031-.522.14-.742a819.35 819.35 0 001.544-1.667c.277-.305.484-.337.759-.033.26.287 1.896 1.36 2.162 1.579.2.163.354.21.543.104.19-.106.288-.152.487-.88.616-2.159.604-2.21.5-2.441-.063-.145-.244-.212-.61-.251-2.562-.277-4.096-1.47-4.143-3.643-.026-.958.398-1.654 1.077-2.13.108-.076.238-.112.34-.104z"/></svg>
                            </a>

                            <!-- Copy Link -->
                            <button onclick="navigator.clipboard.writeText(window.location.href).then(() => { this.classList.add('bg-brand-primary','text-white'); setTimeout(() => this.classList.remove('bg-brand-primary','text-white'), 2000); })" class="share-btn bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </button>
                        </div>

                        <!-- Article Body -->
                        <div class="article-content reveal">
                            <p>Rumah Harapan kembali menunjukkan komitmennya dalam menciptakan dampak positif bagi masyarakat Indonesia. Melalui program-program unggulan yang telah berjalan selama lebih dari satu dekade, yayasan ini terus bergerak untuk memberikan harapan dan masa depan yang lebih cerah bagi mereka yang membutuhkan.</p>

                            <div class="highlight-box">
                                <p class="font-black text-lg !text-slate-900 dark:!text-white !mb-2"><strong>Poin Penting:</strong></p>
                                <ul class="!mb-0">
                                    <li>Program berkelanjutan yang dirancang untuk dampak jangka panjang</li>
                                    <li>Melibatkan relawan dan donatur dari berbagai kalangan</li>
                                    <li>Transparansi penuh dalam pengelolaan dana dan pelaporan</li>
                                </ul>
                            </div>

                            <h2>Latar Belakang Program</h2>
                            <p>Sejak berdiri pada tahun 2015, Rumah Harapan telah berkembang dari sebuah posko kecil dengan 15 anak binaan menjadi yayasan yang dipercaya oleh ribuan donatur dan melayani lebih dari 1.250 anak di seluruh Indonesia. Perjalanan ini tidak lepas dari dukungan masyarakat dan semangat para relawan yang terus mengabdikan diri untuk kebaikan bersama.</p>
                            <p>Setiap program yang kami jalankan didasarkan pada kebutuhan nyata di lapangan. Kami secara rutin melakukan riset dan evaluasi untuk memastikan bahwa bantuan yang diberikan tepat sasaran dan memberikan manfaat yang optimal bagi penerima manfaat.</p>

                            <h2>Tujuan dan Sasaran</h2>
                            <p>Program ini bertujuan untuk:</p>
                            <ul>
                                <li>Meningkatkan akses terhadap pendidikan berkualitas bagi anak-anak kurang mampu</li>
                                <li>Menyediakan layanan kesehatan yang layak dan merata bagi masyarakat</li>
                                <li>Memberdayakan ekonomi keluarga melalui pelatihan keterampilan dan pendampingan usaha</li>
                                <li>Membangun kesadaran dan kepedulian masyarakat terhadap isu-isu sosial</li>
                                <li>Menciptakan jaringan relawan yang solid dan berkelanjutan</li>
                            </ul>

                            <h2>Pelaksanaan Kegiatan</h2>
                            <p>Kegiatan dilaksanakan secara bertahap dengan melibatkan berbagai pemangku kepentingan. Tim kami bekerja sama dengan pemerintah daerah, sekolah-sekolah, puskesmas, serta komunitas lokal untuk memastikan setiap program berjalan lancar dan tepat sasaran.</p>

                            <blockquote>
                                "Kami percaya bahwa perubahan besar dimulai dari langkah kecil. Setiap donasi, setiap waktu yang diluangkan, dan setiap doa yang dipanjatkan memiliki dampak yang luar biasa bagi mereka yang menerimanya."
                                <br>
                                <span class="block mt-3 text-sm font-black not-italic text-brand-primary dark:text-green-400">— Ketua Yayasan Rumah Harapan</span>
                            </blockquote>

                            <p>Dalam pelaksanaannya, kami menerapkan prinsip transparansi dan akuntabilitas penuh. Setiap donasi yang masuk dicatat dan dilaporkan secara berkala kepada para donatur melalui laporan keuangan yang dapat diakses oleh publik.</p>

                            <h2>Dampak yang Telah Dicapai</h2>
                            <p>Hingga saat ini, program-program Rumah Harapan telah memberikan dampak yang signifikan bagi masyarakat. Ribuan anak telah merasakan manfaat dari beasiswa pendidikan dan program pendampingan. Ratusan keluarga telah mendapatkan bantuan kesehatan dan kebutuhan pokok. Lebih dari 350 relawan aktif telah bergabung dalam berbagai kegiatan sosial.</p>
                            <p>Kami tidak akan berhenti di sini. Ke depan, Rumah Harapan berencana untuk memperluas jangkauan program ke lebih banyak wilayah di Indonesia, termasuk daerah-daerah terpencil yang masih sangat membutuhkan uluran tangan kita bersama.</p>

                            <h2>Cara Berkontribusi</h2>
                            <p>Anda dapat berpartisipasi dalam program-program Rumah Harapan melalui berbagai cara:</p>
                            <ul>
                                <li>Donasi tunai melalui rekening resmi yayasan</li>
                                <li>Donasi barang (buku, pakaian layak pakai, perlengkapan sekolah)</li>
                                <li>Menjadi relawan di program-program yang berjalan</li>
                                <li>Menyebarkan informasi tentang program Rumah Harapan kepada orang lain</li>
                            </ul>
                        </div>

                        <!-- Share Buttons (Bottom) -->
                        <div class="mt-12 pt-8 border-t border-slate-100 dark:border-slate-700/60 reveal">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="text-xs font-black uppercase tracking-[0.15em] text-slate-400 dark:text-slate-500">{{ __('Bagikan:') }}</span>
                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-btn bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-500/20">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($articleTitle) }}&url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-btn bg-slate-800 dark:bg-slate-700 text-white hover:bg-slate-900 dark:hover:bg-slate-600">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($articleTitle . ' — ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-btn bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-500/20">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    </a>
                                    <button onclick="navigator.clipboard.writeText(window.location.href).then(() => { this.classList.add('bg-brand-primary','text-white'); setTimeout(() => this.classList.remove('bg-brand-primary','text-white'), 2000); })" class="share-btn bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Back to Berita -->
                                <a href="{{ route('berita') }}" class="back-btn bg-green-50 dark:bg-green-500/10 text-brand-primary dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-500/20 border border-green-200/50 dark:border-green-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <span>{{ __('Kembali ke Berita') }}</span>
                                </a>
                            </div>
                        </div>

                        <!-- Author Bio -->
                        <div class="mt-10 p-8 rounded-[2.5rem] bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/15 dark:to-emerald-900/15 border border-green-100/50 dark:border-green-500/10 reveal">
                            <div class="flex items-start gap-5">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-primary to-green-400 flex items-center justify-center flex-shrink-0 shadow-lg shadow-green-500/20">
                                    <span class="text-2xl font-black text-white">RH</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-black text-slate-900 dark:text-white mb-1">{{ $articleAuthor }}</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium leading-relaxed">
                                        {{ __('Penulis adalah bagian dari tim redaksi Rumah Harapan yang berdedikasi untuk menyajikan informasi akurat dan inspiratif seputar kegiatan dan program yayasan.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Comments / Response CTA -->
                        <div class="mt-10 p-8 rounded-[2.5rem] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/60 text-center reveal">
                            <div class="text-4xl mb-4">💬</div>
                            <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2">{{ __('Punya Pertanyaan?') }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium max-w-md mx-auto mb-6">
                                {{ __('Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang program ini, jangan ragu untuk menghubungi kami.') }}
                            </p>
                            <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 bg-brand-primary hover:bg-brand-dark text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.15em] transition-all shadow-lg shadow-green-500/20 active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                {{ __('Hubungi Kami') }}
                            </a>
                        </div>
                    </div>

                    <!-- ================================================ -->
                    <!-- SIDEBAR                                          -->
                    <!-- ================================================ -->
                    <aside class="lg:col-span-4 space-y-10">

                        <!-- Back to Berita (Mobile) -->
                        <div class="lg:hidden reveal">
                            <a href="{{ route('berita') }}" class="back-btn bg-green-50 dark:bg-green-500/10 text-brand-primary dark:text-green-400 hover:bg-green-100 dark:hover:bg-green-500/20 border border-green-200/50 dark:border-green-500/20 w-full justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                </svg>
                                <span>{{ __('Kembali ke Berita') }}</span>
                            </a>
                        </div>

                        <!-- Related Articles -->
                        <div class="reveal">
                            <div class="flex items-center gap-3 mb-8">
                                <span class="w-2 h-2 rounded-full bg-brand-primary"></span>
                                <h3 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">
                                    {{ __('Artikel Terkait') }}
                                </h3>
                            </div>

                            <div class="space-y-2">
                                @forelse($relatedArticles as $relatedSlug => $related)
                                    <a href="{{ route('berita.detail', $relatedSlug) }}" class="related-card">
                                        <!-- Thumbnail Mini -->
                                        <div class="w-20 h-20 rounded-xl flex-shrink-0 overflow-hidden">
                                            <div class="w-full h-full bg-gradient-to-br from-brand-primary/20 to-green-400/20 dark:from-green-600/30 dark:to-green-800/30 flex items-center justify-center">
                                                <span class="text-2xl opacity-60">📄</span>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.1em] block mb-1">
                                                {{ $related['category'] }}
                                            </span>
                                            <h4 class="text-sm font-black text-slate-900 dark:text-white leading-snug group-hover:text-brand-primary dark:group-hover:text-green-400 transition-colors line-clamp-2">
                                                {{ $related['title'] }}
                                            </h4>
                                            <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 mt-1 block">
                                                {{ $related['date'] }}
                                            </span>
                                        </div>
                                    </a>
                                    @if(!$loop->last)
                                        <div class="border-b border-slate-100 dark:border-slate-700/40 mx-4"></div>
                                    @endif
                                @empty
                                    <div class="text-center py-8">
                                        <p class="text-sm text-slate-400 dark:text-slate-500 font-medium">{{ __('Belum ada artikel terkait.') }}</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Category Widget -->
                        <div class="reveal">
                            <div class="flex items-center gap-3 mb-8">
                                <span class="w-2 h-2 rounded-full bg-brand-accent"></span>
                                <h3 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">
                                    {{ __('Kategori') }}
                                </h3>
                            </div>

                            <div class="space-y-3">
                                <a href="{{ route('berita') }}" class="flex items-center justify-between px-5 py-3.5 rounded-2xl bg-green-50 dark:bg-green-500/10 text-green-700 dark:text-green-400 text-sm font-bold transition-all hover:bg-green-100 dark:hover:bg-green-500/20">
                                    <span class="inline-flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        {{ __('Pendidikan') }}
                                    </span>
                                    <span class="text-xs font-black text-green-400 dark:text-green-500">12</span>
                                </a>
                                <a href="{{ route('berita') }}" class="flex items-center justify-between px-5 py-3.5 rounded-2xl bg-amber-50 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-sm font-bold transition-all hover:bg-amber-100 dark:hover:bg-amber-500/20">
                                    <span class="inline-flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        {{ __('Kesehatan') }}
                                    </span>
                                    <span class="text-xs font-black text-amber-400 dark:text-amber-500">8</span>
                                </a>
                                <a href="{{ route('berita') }}" class="flex items-center justify-between px-5 py-3.5 rounded-2xl bg-blue-50 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-sm font-bold transition-all hover:bg-blue-100 dark:hover:bg-blue-500/20">
                                    <span class="inline-flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                        {{ __('Sosial') }}
                                    </span>
                                    <span class="text-xs font-black text-blue-400 dark:text-blue-500">6</span>
                                </a>
                                <a href="{{ route('berita') }}" class="flex items-center justify-between px-5 py-3.5 rounded-2xl bg-purple-50 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400 text-sm font-bold transition-all hover:bg-purple-100 dark:hover:bg-purple-500/20">
                                    <span class="inline-flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                        {{ __('Umum') }}
                                    </span>
                                    <span class="text-xs font-black text-purple-400 dark:text-purple-500">4</span>
                                </a>
                                <a href="{{ route('berita') }}" class="flex items-center justify-between px-5 py-3.5 rounded-2xl bg-rose-50 dark:bg-rose-500/10 text-rose-700 dark:text-rose-400 text-sm font-bold transition-all hover:bg-rose-100 dark:hover:bg-rose-500/20">
                                    <span class="inline-flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                        {{ __('Acara') }}
                                    </span>
                                    <span class="text-xs font-black text-rose-400 dark:text-rose-500">3</span>
                                </a>
                            </div>
                        </div>

                        <!-- Donation CTA Widget -->
                        <div class="relative bg-gradient-to-br from-green-600 to-emerald-700 dark:from-green-700 dark:to-emerald-900 rounded-[2.5rem] p-8 text-center overflow-hidden reveal">
                            <!-- Decorative circles -->
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-xl"></div>
                            <div class="absolute -bottom-6 -left-6 w-28 h-28 bg-brand-accent/10 rounded-full blur-xl"></div>

                            <div class="relative z-10">
                                <div class="text-5xl mb-6">❤️</div>
                                <h3 class="text-xl font-black text-white mb-3">{{ __('Dukung Program Kami') }}</h3>
                                <p class="text-sm text-white/70 font-medium leading-relaxed mb-8">
                                    {{ __('Setiap donasi Anda membawa harapan baru bagi mereka yang membutuhkan. Bersama kita bisa membuat perubahan nyata.') }}
                                </p>
                                <a href="#" class="inline-flex items-center gap-2 bg-white text-green-700 hover:bg-green-50 px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.15em] transition-all shadow-xl active:scale-95">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    {{ __('Donasi Sekarang') }}
                                </a>
                            </div>
                        </div>

                        <!-- Tags Widget -->
                        <div class="reveal">
                            <div class="flex items-center gap-3 mb-8">
                                <span class="w-2 h-2 rounded-full bg-brand-primary"></span>
                                <h3 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">
                                    {{ __('Tags') }}
                                </h3>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('berita') }}" class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 hover:bg-brand-primary hover:text-white dark:hover:bg-brand-primary dark:hover:text-white transition-all">#Beasiswa</a>
                                <a href="{{ route('berita') }}" class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 hover:bg-brand-primary hover:text-white dark:hover:bg-brand-primary dark:hover:text-white transition-all">#Kesehatan</a>
                                <a href="{{ route('berita') }}" class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 hover:bg-brand-primary hover:text-white dark:hover:bg-brand-primary dark:hover:text-white transition-all">#Sosial</a>
                                <a href="{{ route('berita') }}" class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 hover:bg-brand-primary hover:text-white dark:hover:bg-brand-primary dark:hover:text-white transition-all">#Relawan</a>
                                <a href="{{ route('berita') }}" class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 hover:bg-brand-primary hover:text-white dark:hover:bg-brand-primary dark:hover:text-white transition-all">#Donasi</a>
                                <a href="{{ route('berita') }}" class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 hover:bg-brand-primary hover:text-white dark:hover:bg-brand-primary dark:hover:text-white transition-all">#Pendidikan</a>
                                <a href="{{ route('berita') }}" class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500 dark:text-slate-400 hover:bg-brand-primary hover:text-white dark:hover:bg-brand-primary dark:hover:text-white transition-all">#AnakBangsa</a>
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </section>

        <!-- Scroll-triggered reveal -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                        }
                    });
                }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

                document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
            });
        </script>
    </main>

    <x-site-footer />
</body>
</html>
