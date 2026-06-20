<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - {{ $settings['site_name'] ?? 'Rumah Harapan' }}</title>

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
        <section class="relative bg-green-900 w-full min-h-[400px] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop')] bg-cover bg-center opacity-30 mix-blend-overlay"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white mt-10">
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-amber-400 text-xs font-bold uppercase tracking-widest mb-4 border border-white/20 backdrop-blur-md">
                    Kenali Kami Lebih Dekat
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 tracking-tight">
                    Tentang <span class="text-amber-400">Rumah Harapan</span>
                </h1>
                <p class="text-lg text-green-50 mb-0 max-w-2xl mx-auto leading-relaxed">
                    Lebih dari sekadar menyalurkan dana, kami hadir untuk menjembatani kepedulian Anda menjadi aksi nyata yang mengubah kehidupan.
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

        <!-- SEJARAH & PROFIL -->
        <section class="py-20 lg:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="order-2 lg:order-1 relative">
                        <div class="relative w-full aspect-[4/5] lg:aspect-square rounded-[2rem] overflow-hidden group shadow-2xl shadow-slate-200">
                            <img src="https://images.unsplash.com/photo-1593113580332-ceb4b1a45741?q=80&w=1000&auto=format&fit=crop" alt="Kegiatan Sosial" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Floating Stats -->
                        <div class="absolute -bottom-8 -right-8 bg-green-600 text-white p-8 rounded-3xl shadow-xl shadow-green-600/20 hidden md:block">
                            <div class="flex items-center gap-4">
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <i data-lucide="shield-check" class="w-8 h-8"></i>
                                </div>
                                <div>
                                    <div class="text-3xl font-black mb-1">LAZ</div>
                                    <div class="text-xs font-bold uppercase tracking-widest text-green-100">Resmi Terdaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2">
                        <h2 class="text-sm font-bold text-green-600 uppercase tracking-widest mb-2">Sejarah Kami</h2>
                        <h3 class="text-3xl lg:text-4xl font-black text-slate-900 mb-6 leading-tight">
                            Lahir dari Empati, <br>Bergerak untuk Negeri
                        </h3>
                        
                        <div class="space-y-6 text-slate-600 leading-relaxed">
                            <p class="text-lg font-medium text-slate-700">
                                Berdiri sejak tahun 2015, Yayasan Rumah Harapan bermula dari gerakan sosial sekelompok pemuda di Jakarta yang peduli terhadap tingginya angka anak putus sekolah.
                            </p>
                            <p>
                                Seiring berjalannya waktu, kepercayaan para donatur membuat kami berkembang menjadi Lembaga Amil Zakat (LAZ) resmi yang tidak hanya fokus pada pendidikan, tapi juga merambah ke sektor kesehatan, ekonomi, dan tanggap bencana.
                            </p>
                            <p>
                                Prinsip kami sederhana: <strong>Amanah, Transparan, dan Berdampak</strong>. Setiap donasi yang dititipkan melalui Rumah Harapan diaudit secara berkala dan dilaporkan secara terbuka agar manfaatnya bisa dirasakan langsung oleh mereka yang berhak.
                            </p>
                        </div>
                        
                        <div class="mt-10 flex gap-4">
                            <a href="{{ route('program') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-8 py-4 rounded-xl font-bold transition flex items-center gap-2">
                                Lihat Program
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- VISI MISI -->
        <section class="py-20 lg:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-sm font-bold text-green-600 uppercase tracking-widest mb-2">Tujuan Kami</h2>
                    <h3 class="text-3xl lg:text-4xl font-black text-slate-900">Visi & Misi Yayasan</h3>
                </div>

                <div class="grid md:grid-cols-2 gap-8 lg:gap-12 max-w-5xl mx-auto">
                    <!-- Visi -->
                    <div class="bg-white p-10 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:scale-110 transition-transform duration-500">
                            <i data-lucide="eye" class="w-32 h-32 text-green-600"></i>
                        </div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6">
                                <i data-lucide="eye" class="w-7 h-7"></i>
                            </div>
                            <h4 class="text-2xl font-black text-slate-900 mb-4">Visi</h4>
                            <p class="text-slate-600 leading-relaxed text-lg font-medium">
                                "Menjadi lembaga filantropi Islam terpercaya yang profesional dalam memberdayakan umat dan mengentaskan kemiskinan."
                            </p>
                        </div>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white p-10 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:scale-110 transition-transform duration-500">
                            <i data-lucide="target" class="w-32 h-32 text-amber-500"></i>
                        </div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6">
                                <i data-lucide="target" class="w-7 h-7"></i>
                            </div>
                            <h4 class="text-2xl font-black text-slate-900 mb-4">Misi</h4>
                            <ul class="space-y-4 text-slate-600">
                                <li class="flex gap-3">
                                    <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 shrink-0"></i>
                                    <span>Mengelola dana ZISWAF secara transparan dan akuntabel.</span>
                                </li>
                                <li class="flex gap-3">
                                    <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 shrink-0"></i>
                                    <span>Menciptakan program pemberdayaan mandiri dan berkelanjutan.</span>
                                </li>
                                <li class="flex gap-3">
                                    <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 shrink-0"></i>
                                    <span>Merespon cepat isu kemanusiaan dan tanggap darurat bencana.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA GABUNG -->
        <section class="py-20 lg:py-24 bg-green-700 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1600&auto=format&fit=crop')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl lg:text-5xl font-black text-white mb-6">
                    Ingin Berkontribusi Bersama Kami?
                </h2>
                <p class="text-green-100 text-lg mb-10 max-w-2xl mx-auto">
                    Kami membuka pintu selebar-lebarnya bagi Anda yang ingin menjadi donatur tetap, relawan, maupun mitra CSR perusahaan.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="bg-amber-400 hover:bg-amber-300 text-slate-900 px-8 py-4 rounded-xl font-bold transition flex items-center justify-center gap-2">
                        Berdonasi Sekarang
                    </a>
                    <a href="{{ route('kontak') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 backdrop-blur px-8 py-4 rounded-xl font-bold transition flex items-center justify-center gap-2">
                        Hubungi Kami
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