<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Program Kami - {{ $settings['site_name'] ?? 'Rumah Harapan' }}</title>

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
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1593113580332-ceb4b1a45741?q=80&w=1600&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white mt-10">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 tracking-tight">
                    Program <span class="text-amber-400">Kebaikan</span>
                </h1>
                <p class="text-lg text-green-50 mb-0 max-w-2xl mx-auto leading-relaxed">
                    Pilih jalan kebaikan Anda. Dari pendidikan hingga kesehatan, setiap donasi Anda adalah harapan baru bagi mereka.
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

        <!-- KATEGORI CEPAT -->
        <section class="bg-white py-12 border-b border-slate-100 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center gap-4 flex-wrap">
                    <button class="px-6 py-2.5 rounded-full bg-green-600 text-white font-bold text-sm shadow-md shadow-green-600/20">Semua Program</button>
                    <button class="px-6 py-2.5 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 font-bold text-sm transition">Pendidikan</button>
                    <button class="px-6 py-2.5 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 font-bold text-sm transition">Kesehatan</button>
                    <button class="px-6 py-2.5 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 font-bold text-sm transition">Pemberdayaan</button>
                    <button class="px-6 py-2.5 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 font-bold text-sm transition">Sosial Kemanusiaan</button>
                </div>
            </div>
        </section>

        <!-- LIST PROGRAM DINAMIS -->
        <section class="py-16 lg:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($programs as $program)
                        <!-- Program Card -->
                        <div class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col group">
                            <!-- Image -->
                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                                <img src="{{ $program->image_url ?? 'https://images.unsplash.com/photo-1593113580332-ceb4b1a45741?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $program->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                
                                <!-- Floating category (kalau ada kategori di model Program, bisa diganti) -->
                                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-md text-xs font-bold text-green-700">
                                    Unggulan
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-black text-slate-900 mb-3 group-hover:text-green-600 transition">{{ $program->name }}</h3>
                                
                                <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                    {{ Str::limit(strip_tags($program->description), 120) }}
                                </p>
                                
                                <!-- Progress Bar (Contoh UI jika butuh target) -->
                                <div class="mt-auto mb-6">
                                    <div class="flex justify-between text-xs font-bold mb-2">
                                        <span class="text-slate-500">Terkumpul: <span class="text-green-600">Rp 12.5M</span></span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2">
                                        <div class="bg-amber-500 h-2 rounded-full w-[70%]"></div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="grid grid-cols-2 gap-3 mt-auto">
                                    <a href="#" class="col-span-1 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-center py-3 rounded-xl font-bold text-sm transition">
                                        Detail
                                    </a>
                                    <a href="{{ route('login') }}" class="col-span-1 bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-xl font-bold text-sm shadow-md shadow-green-600/20 transition flex items-center justify-center gap-1">
                                        Donasi
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white rounded-2xl border border-slate-100 border-dashed">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="package-open" class="w-10 h-10 text-slate-300"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Belum Ada Program</h3>
                            <p class="text-slate-500 text-sm">Program donasi saat ini sedang dalam persiapan. Silakan kembali nanti.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Placeholder (Kalau Paginasi Aktif) -->
                @if(method_exists($programs, 'links'))
                    <div class="mt-12">
                        {{ $programs->links() }}
                    </div>
                @endif
            </div>
        </section>

        <!-- CTA ZAKAT WAKAF -->
        <section class="py-20 lg:py-24 bg-green-900 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 20px 20px, white 1.5px, transparent 1.5px); background-size: 40px 40px;"></div>
            
            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-green-800/50 backdrop-blur border border-green-700 rounded-3xl p-8 lg:p-12 text-center lg:text-left flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="max-w-xl">
                        <h2 class="text-3xl font-black text-white mb-4">Tunaikan Kewajiban Anda</h2>
                        <p class="text-green-100 text-lg">
                            Selain program donasi umum, Rumah Harapan melayani penerimaan Zakat Maal, Zakat Profesi, Fidyah, dan Wakaf produktif.
                        </p>
                    </div>
                    <div class="flex-shrink-0 flex flex-col sm:flex-row gap-4 w-full lg:w-auto">
                        <a href="{{ route('login') }}" class="bg-amber-400 hover:bg-amber-300 text-slate-900 px-8 py-4 rounded-xl font-bold transition text-center">
                            Kalkulator Zakat
                        </a>
                        <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 py-4 rounded-xl font-bold transition text-center">
                            Konsultasi
                        </a>
                    </div>
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