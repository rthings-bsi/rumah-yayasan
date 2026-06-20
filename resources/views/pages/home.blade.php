<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['site_name'] ?? 'Rumah Harapan' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-800 font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- Top Bar Contact & Social -->
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
        <!-- HERO CAROUSEL -->
        <section class="relative bg-slate-900 w-full min-h-[500px] lg:h-[600px] flex items-center justify-center overflow-hidden">
            <!-- Background Image -->
            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40">
            
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 tracking-tight leading-tight">
                    Bersama Wujudkan <br>
                    <span class="text-amber-400">Harapan Mereka</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-200 mb-10 max-w-2xl mx-auto">
                    {{ $settings['site_description'] ?? 'Salurkan Zakat, Infaq, Shodaqoh, dan Wakaf Anda melalui Rumah Harapan untuk membangun masa depan umat yang lebih baik.' }}
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="bg-amber-500 hover:bg-amber-400 text-slate-900 px-8 py-4 rounded-full font-bold transition flex items-center justify-center gap-2">
                        Tunaikan Donasi
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <a href="#program" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 text-white px-8 py-4 rounded-full font-bold transition flex items-center justify-center">
                        Lihat Program
                    </a>
                </div>
            </div>
        </section>

        <!-- STATISTIK -->
        <section class="relative z-20 -mt-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 md:p-8 border border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-x divide-slate-100">
                <div>
                    <div class="text-3xl font-black text-green-600 mb-1">21K+</div>
                    <div class="text-xs font-bold text-slate-500 uppercase">Donatur</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-green-600 mb-1">8.5M+</div>
                    <div class="text-xs font-bold text-slate-500 uppercase">Penerima Manfaat</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-green-600 mb-1">12</div>
                    <div class="text-xs font-bold text-slate-500 uppercase">Program Berjalan</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-green-600 mb-1">15+</div>
                    <div class="text-xs font-bold text-slate-500 uppercase">Tahun Berdiri</div>
                </div>
            </div>
        </section>

        <!-- PILIHAN DONASI CEPAT -->
        <section id="program" class="py-20 lg:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-sm font-bold text-green-600 uppercase tracking-widest mb-2">Layanan Kami</h2>
                    <h3 class="text-3xl lg:text-4xl font-black text-slate-900">Salurkan Kebaikan Anda</h3>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Zakat -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:shadow-green-100 transition border border-slate-100 text-center group cursor-pointer">
                        <div class="w-16 h-16 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition">
                            <i data-lucide="calculator" class="w-8 h-8"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Zakat</h4>
                        <p class="text-sm text-slate-500 mb-6">Sucikan harta dengan menunaikan zakat maal dan profesi.</p>
                        <span class="text-green-600 text-sm font-bold flex items-center justify-center gap-1">Tunaikan <i data-lucide="chevron-right" class="w-4 h-4"></i></span>
                    </div>

                    <!-- Infaq -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:shadow-amber-100 transition border border-slate-100 text-center group cursor-pointer">
                        <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition">
                            <i data-lucide="heart-handshake" class="w-8 h-8"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Infaq / Sedekah</h4>
                        <p class="text-sm text-slate-500 mb-6">Berbagi rezeki untuk program kemanusiaan dan umat.</p>
                        <span class="text-amber-600 text-sm font-bold flex items-center justify-center gap-1">Tunaikan <i data-lucide="chevron-right" class="w-4 h-4"></i></span>
                    </div>

                    <!-- Wakaf -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:shadow-blue-100 transition border border-slate-100 text-center group cursor-pointer">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition">
                            <i data-lucide="building-2" class="w-8 h-8"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Wakaf</h4>
                        <p class="text-sm text-slate-500 mb-6">Pahala jariyah yang mengalir abadi untuk pembangunan fasilitas.</p>
                        <span class="text-blue-600 text-sm font-bold flex items-center justify-center gap-1">Tunaikan <i data-lucide="chevron-right" class="w-4 h-4"></i></span>
                    </div>

                    <!-- Fidyah -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl hover:shadow-purple-100 transition border border-slate-100 text-center group cursor-pointer">
                        <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white transition">
                            <i data-lucide="wheat" class="w-8 h-8"></i>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 mb-2">Fidyah</h4>
                        <p class="text-sm text-slate-500 mb-6">Tunaikan kewajiban ganti puasa dengan memberi makan dhuafa.</p>
                        <span class="text-purple-600 text-sm font-bold flex items-center justify-center gap-1">Tunaikan <i data-lucide="chevron-right" class="w-4 h-4"></i></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- PROGRAM KAMI (Dinamis dari Backend) -->
        <section class="py-20 lg:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-sm font-bold text-green-600 uppercase tracking-widest mb-2">Fokus Kami</h2>
                        <h3 class="text-3xl lg:text-4xl font-black text-slate-900">Program Unggulan</h3>
                    </div>
                    <a href="{{ route('program') }}" class="hidden sm:flex text-green-600 font-bold hover:text-green-700 items-center gap-1">
                        Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @forelse($programs as $program)
                        <div class="bg-slate-50 rounded-2xl overflow-hidden border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                            <img src="{{ $program->image_url ?? 'https://images.unsplash.com/photo-1593113580332-ceb4b1a45741?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $program->name }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h4 class="text-xl font-bold text-slate-900 mb-2">{{ $program->name }}</h4>
                                <p class="text-slate-600 text-sm mb-6 line-clamp-3">
                                    {{ Str::limit(strip_tags($program->description), 120) }}
                                </p>
                                <a href="#" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold transition">
                                    Dukung Program Ini
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-10 text-slate-500">
                            Belum ada data program.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- BERITA TERBARU (Dinamis) -->
        <section id="berita" class="py-20 lg:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-sm font-bold text-green-600 uppercase tracking-widest mb-2">Kabar Terbaru</h2>
                    <h3 class="text-3xl lg:text-4xl font-black text-slate-900">Artikel & Laporan Kegiatan</h3>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @forelse($latestBerita->take(3) as $berita)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 group hover:shadow-xl transition duration-300">
                            <div class="aspect-[16/10] overflow-hidden relative">
                                <img src="{{ $berita->image_url ?? 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $berita->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-md text-xs font-bold text-green-700">
                                    {{ $berita->category ?? 'Berita' }}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 text-xs text-slate-500 mb-3">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                    {{ $berita->published_at ? $berita->published_at->format('d M Y') : $berita->created_at->format('d M Y') }}
                                </div>
                                <h4 class="text-lg font-bold text-slate-900 mb-3 group-hover:text-green-600 transition line-clamp-2">
                                    <a href="{{ route('berita.detail', $berita->slug) }}">{{ $berita->title }}</a>
                                </h4>
                                <p class="text-sm text-slate-600 mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($berita->content), 100) }}
                                </p>
                                <a href="{{ route('berita.detail', $berita->slug) }}" class="text-green-600 font-bold text-sm flex items-center gap-1 hover:text-green-700">
                                    Baca Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-10 text-slate-500">
                            Belum ada artikel berita.
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('berita') }}" class="inline-flex items-center justify-center bg-white border border-slate-300 text-slate-700 px-8 py-3 rounded-full font-bold hover:bg-slate-50 transition gap-2">
                        Lihat Semua Berita
                    </a>
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
