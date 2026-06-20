<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita & Kabar Terbaru - {{ $settings['site_name'] ?? 'Rumah Harapan' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-800 font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- Top Bar -->
    <div class="bg-green-700 text-white text-xs font-medium py-2 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-2">
                    <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                    {{ $settings['contact_phone'] ?? '0812-3456-7890' }}
                </span>
                <span class="flex items-center gap-2">
                    <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                    {{ $settings['contact_email'] ?? 'info@rumahharapan.org' }}
                </span>
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-green-200 transition">Facebook</a>
                <a href="#" class="hover:text-green-200 transition">Instagram</a>
                <a href="#" class="hover:text-green-200 transition">YouTube</a>
            </div>
        </div>
    </div>

    <x-site-navbar />

    <main>
        <!-- PAGE HEADER -->
        <section class="relative bg-green-900 w-full min-h-[350px] lg:min-h-[400px] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1600&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white mt-10">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 tracking-tight">
                    Berita & <span class="text-amber-400">Kabar Terbaru</span>
                </h1>
                <p class="text-lg text-green-50 mb-0 max-w-2xl mx-auto leading-relaxed">
                    Informasi terkini seputar kegiatan, distribusi bantuan, dan cerita inspiratif dari para penerima manfaat.
                </p>
            </div>
            
            <!-- Shape Divider -->
            <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
                <svg class="relative block w-full h-[50px] lg:h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="fill-white"></path>
                    <path d="M0,0V15.81C13.07,28.92,27.35,41.45,42.48,53.21c80.53,62.8,170.83,86.68,271.18,91.31,100.86,4.64,198.81-15.14,291.68-45.71,96.34-31.81,192.11-48.47,294.67-42.54,49.26,2.83,97.77,15.68,145.45,34.72V0Z" opacity=".5" class="fill-white"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="fill-white"></path>
                </svg>
            </div>
        </section>

        <!-- KONTEN BERITA -->
        <section class="py-16 lg:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row gap-12">
                    
                    <!-- Kiri: Grid Artikel -->
                    <div class="w-full lg:w-3/4">
                        
                        <!-- Search & Filter Bar Mobile Only -->
                        <div class="mb-8 lg:hidden bg-white p-4 rounded-xl border border-slate-100 flex gap-2">
                            <input type="text" placeholder="Cari berita..." class="w-full border border-slate-200 rounded-lg px-4 py-2 text-sm focus:ring-green-500 focus:border-green-500 outline-none">
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg"><i data-lucide="search" class="w-5 h-5"></i></button>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            @forelse($beritas as $berita)
                                <!-- Article Card -->
                                <article class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition duration-300 group flex flex-col">
                                    <a href="{{ route('berita.detail', $berita->slug) }}" class="block relative aspect-[16/10] overflow-hidden bg-slate-100">
                                        <img src="{{ $berita->image_url ?? 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $berita->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        <!-- Category Badge -->
                                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-md text-xs font-bold text-green-700 shadow-sm">
                                            {{ $berita->category ?? 'Berita Utama' }}
                                        </div>
                                    </a>
                                    <div class="p-6 flex flex-col flex-grow">
                                        <div class="flex items-center gap-4 text-xs font-semibold text-slate-400 mb-3">
                                            <span class="flex items-center gap-1.5">
                                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                                {{ $berita->published_at ? $berita->published_at->format('d F Y') : $berita->created_at->format('d F Y') }}
                                            </span>
                                            <span class="flex items-center gap-1.5">
                                                <i data-lucide="user" class="w-4 h-4"></i>
                                                {{ $berita->author->name ?? 'Admin' }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-black text-slate-900 mb-3 group-hover:text-green-600 transition line-clamp-2 leading-tight">
                                            <a href="{{ route('berita.detail', $berita->slug) }}">{{ $berita->title }}</a>
                                        </h3>
                                        <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                            {{ Str::limit(strip_tags($berita->content), 120) }}
                                        </p>
                                        <div class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between">
                                            <a href="{{ route('berita.detail', $berita->slug) }}" class="text-green-600 font-bold text-sm flex items-center gap-1.5 hover:text-green-700 group-hover:underline">
                                                Baca Selengkapnya
                                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="col-span-1 md:col-span-2 text-center py-20 bg-white rounded-2xl border border-slate-100 border-dashed">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="file-x" class="w-10 h-10 text-slate-300"></i>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Berita</h3>
                                    <p class="text-slate-500 text-sm">Berita dan artikel belum tersedia saat ini.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if(method_exists($beritas, 'links'))
                            <div class="mt-12">
                                {{ $beritas->links() }}
                            </div>
                        @endif

                    </div>

                    <!-- Kanan: Sidebar Kategori & Widget -->
                    <aside class="w-full lg:w-1/4 space-y-8">
                        
                        <!-- Search Widget -->
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hidden lg:block">
                            <h4 class="font-black text-slate-900 mb-4 flex items-center gap-2">
                                <i data-lucide="search" class="w-5 h-5 text-green-600"></i> Cari Berita
                            </h4>
                            <form action="{{ route('berita') }}" method="GET" class="relative">
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Ketik kata kunci..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-green-500 focus:ring-2 focus:ring-green-500/20 outline-none transition">
                                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-green-600">
                                    <i data-lucide="search" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Kategori Widget -->
                        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                            <h4 class="font-black text-slate-900 mb-4 flex items-center gap-2">
                                <i data-lucide="folder-open" class="w-5 h-5 text-amber-500"></i> Kategori
                            </h4>
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('berita') }}" class="flex items-center justify-between text-sm text-slate-600 hover:text-green-600 font-medium p-2 rounded-lg hover:bg-green-50 transition">
                                        <span>Semua Berita</span>
                                        <span class="bg-slate-100 text-slate-500 text-xs py-0.5 px-2 rounded-full">{{ $beritas->total() ?? 0 }}</span>
                                    </a>
                                </li>
                                @forelse($categories ?? [] as $category => $count)
                                <li>
                                    <a href="{{ route('berita', ['category' => $category]) }}" class="flex items-center justify-between text-sm text-slate-600 hover:text-green-600 font-medium p-2 rounded-lg hover:bg-green-50 transition">
                                        <span>{{ $category }}</span>
                                        <span class="bg-slate-100 text-slate-500 text-xs py-0.5 px-2 rounded-full">{{ $count }}</span>
                                    </a>
                                </li>
                                @empty
                                <li>
                                    <span class="text-sm text-slate-400 p-2">Kategori belum tersedia.</span>
                                </li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Banner Donasi -->
                        <div class="relative rounded-2xl overflow-hidden shadow-sm group">
                            <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb0?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-green-900 via-green-900/80 to-transparent flex flex-col justify-end p-6">
                                <h4 class="text-white font-black text-xl mb-2">Mari Berbagi Kebaikan</h4>
                                <p class="text-green-100 text-xs mb-4">Setiap donasi Anda adalah senyuman bagi mereka.</p>
                                <a href="{{ route('login') }}" class="w-full bg-amber-400 hover:bg-amber-300 text-slate-900 text-center py-2.5 rounded-lg font-bold text-sm transition shadow-lg shadow-amber-400/20">
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </section>

    </main>

    <x-site-footer />

    <script>
        lucide.createIcons();
    </script>
</body>
</html>