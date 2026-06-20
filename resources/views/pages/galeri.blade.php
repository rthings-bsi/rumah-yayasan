<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri Kegiatan - {{ $settings['site_name'] ?? 'Rumah Harapan' }}</title>

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
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&w=1600&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white mt-10">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 tracking-tight">
                    Galeri <span class="text-amber-400">Kegiatan</span>
                </h1>
                <p class="text-lg text-green-50 mb-0 max-w-2xl mx-auto leading-relaxed">
                    Setiap momen kebaikan dan senyuman mereka terekam di sini. Bukti nyata jejak langkah kepedulian Anda.
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

        <!-- KATEGORI FILTER (Visual Only, can be wired to backend later) -->
        <section class="bg-white py-8 border-b border-slate-100 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center gap-3 flex-wrap">
                    <button class="px-5 py-2 rounded-full bg-green-600 text-white font-bold text-sm shadow-sm shadow-green-600/20">Semua Foto</button>
                    <button class="px-5 py-2 rounded-full bg-slate-50 text-slate-600 hover:bg-slate-100 font-bold text-sm border border-slate-200 transition">Penyaluran Bantuan</button>
                    <button class="px-5 py-2 rounded-full bg-slate-50 text-slate-600 hover:bg-slate-100 font-bold text-sm border border-slate-200 transition">Pendidikan</button>
                    <button class="px-5 py-2 rounded-full bg-slate-50 text-slate-600 hover:bg-slate-100 font-bold text-sm border border-slate-200 transition">Kesehatan</button>
                    <button class="px-5 py-2 rounded-full bg-slate-50 text-slate-600 hover:bg-slate-100 font-bold text-sm border border-slate-200 transition">Kegiatan Yayasan</button>
                </div>
            </div>
        </section>

        <!-- GALLERY GRID -->
        <section class="py-16 lg:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @forelse($galleries as $gallery)
                        <!-- Photo Item -->
                        <div class="group relative bg-white rounded-2xl overflow-hidden aspect-square border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 cursor-pointer">
                            <!-- Image -->
                            <img src="{{ $gallery->image_url ?? 'https://images.unsplash.com/photo-1593113580332-ceb4b1a45741?q=80&w=600&auto=format&fit=crop' }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <!-- Overlay Hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                                
                                <!-- Zoom Icon -->
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300 delay-100 border border-white/30">
                                    <i data-lucide="zoom-in" class="w-5 h-5 text-white"></i>
                                </div>
                                
                                <!-- Caption -->
                                <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <div class="text-green-400 text-xs font-bold uppercase tracking-widest mb-1">{{ $gallery->category ?? 'Dokumentasi' }}</div>
                                    <h4 class="text-white font-bold text-lg leading-tight line-clamp-2">
                                        {{ $gallery->title ?? 'Kegiatan Penyaluran Bantuan Yayasan Rumah Harapan' }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 text-center py-24 bg-white rounded-2xl border border-slate-100 border-dashed">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="image" class="w-10 h-10 text-slate-300"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Foto</h3>
                            <p class="text-slate-500 text-sm">Dokumentasi galeri sedang dalam proses upload.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if(method_exists($galleries, 'links'))
                    <div class="mt-12">
                        {{ $galleries->links() }}
                    </div>
                @endif
                
            </div>
        </section>

        <!-- CTA GABUNG -->
        <section class="py-20 lg:py-24 bg-green-900 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl lg:text-5xl font-black text-white mb-6">
                    Ambil Bagian Dalam Kebaikan
                </h2>
                <p class="text-green-100 text-lg mb-10 max-w-2xl mx-auto">
                    Foto-foto di atas adalah bukti bahwa kebaikan Anda benar-benar sampai. Mari ciptakan lebih banyak senyuman bersama kami.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="bg-amber-400 hover:bg-amber-300 text-slate-900 px-8 py-4 rounded-xl font-bold transition flex items-center justify-center gap-2 shadow-xl shadow-amber-400/20">
                        Berdonasi Sekarang
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