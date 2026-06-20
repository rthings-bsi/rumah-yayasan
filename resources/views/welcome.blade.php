<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rumah Harapan | Yayasan Kasih Sesama</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- Alpine CDN fallback via script (gak dipakai untuk navbar lagi tapi disisain buat yang lain) --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    </head>
    <body class="antialiased bg-white text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">

        <x-site-navbar />

        <main>
            <!-- ============================================================ -->
            <!-- HERO                                                            -->
            <!-- ============================================================ -->
            <section class="relative overflow-hidden bg-slate-50 min-h-[85vh] flex items-center">
                {{-- decorative elements --}}
                <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle at 20px 20px, black 1.5px, transparent 1.5px); background-size: 40px 40px;"></div>
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-green-400/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        {{-- text --}}
                        <div class="max-w-2xl">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-50 text-green-700 text-xs font-bold uppercase tracking-widest mb-6 border border-green-200">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                Yayasan Sosial Terdaftar
                            </span>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.1] mb-6 text-slate-900 tracking-tight">
                                Bersama Membangun <span class="text-green-600 relative inline-block">Harapan<svg class="absolute -bottom-2 left-0 w-full h-3 text-amber-400" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="4" fill="none"/></svg></span><br>
                                Untuk Masa Depan.
                            </h1>
                            <p class="text-lg text-slate-600 mb-10 leading-relaxed max-w-xl">
                                Rumah Harapan hadir untuk menjembatani kebaikan Anda. Kami menyalurkan donasi untuk pendidikan, kesehatan, dan pemberdayaan keluarga prasejahtera dengan transparan.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center justify-center gap-3 bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold text-sm transition-all active:scale-95 shadow-lg shadow-green-600/20">
                                    Mulai Berdonasi
                                </a>
                                <a href="#program"
                                   class="inline-flex items-center justify-center gap-3 bg-white hover:bg-slate-50 text-slate-700 px-8 py-4 rounded-xl font-bold text-sm border border-slate-200 transition-all active:scale-95">
                                    Lihat Program Kami
                                </a>
                            </div>
                        </div>
                        {{-- visual --}}
                        <div class="relative hidden lg:flex items-center justify-center">
                            <div class="absolute inset-0 bg-green-600/5 rounded-[3rem] blur-3xl"></div>
                            <div class="relative w-full max-w-md aspect-[4/5] bg-white rounded-[2rem] border border-slate-100 shadow-2xl shadow-slate-200/50 flex flex-col p-8 overflow-hidden group">
                                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1000&auto=format&fit=crop" alt="Kegiatan Yayasan" class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                                <div class="relative mt-auto">
                                    <div class="bg-white/90 backdrop-blur px-4 py-2 rounded-xl inline-block mb-4">
                                        <div class="flex items-center gap-2">
                                            <div class="flex -space-x-2">
                                                <div class="w-6 h-6 rounded-full border-2 border-white bg-green-100"></div>
                                                <div class="w-6 h-6 rounded-full border-2 border-white bg-amber-100"></div>
                                                <div class="w-6 h-6 rounded-full border-2 border-white bg-blue-100"></div>
                                            </div>
                                            <span class="text-xs font-bold text-slate-700">1.250+ Terbantu</span>
                                        </div>
                                    </div>
                                    <h3 class="text-white text-2xl font-black mb-1">Aksi Nyata Kita</h3>
                                    <p class="text-slate-300 text-sm font-medium">Berdampak untuk sesama</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- STATS                                                          -->
            <!-- ============================================================ -->
            <section class="relative -mt-16 z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6 text-center hover:-translate-y-1 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-black text-green-600 mb-1">2015</div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-[0.1em]">Tahun Berdiri</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6 text-center hover:-translate-y-1 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-black text-green-600 mb-1">1.250+</div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-[0.1em]">Anak Terbantu</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6 text-center hover:-translate-y-1 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-black text-green-600 mb-1">48</div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-[0.1em]">Relawan Aktif</div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-lg shadow-slate-200/50 p-6 text-center hover:-translate-y-1 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-black text-amber-500 mb-1">12</div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-[0.1em]">Program Aktif</div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- TENTANG KAMI                                                    -->
            <!-- ============================================================ -->
            <section class="py-24 lg:py-32 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
                        {{-- image side --}}
                        <div class="relative">
                            <div class="relative w-full aspect-[4/3] rounded-[2rem] overflow-hidden group border border-slate-100 shadow-xl shadow-slate-200/50">
                                <img src="https://images.unsplash.com/photo-1593113580332-ceb4b1a45741?q=80&w=1000&auto=format&fit=crop" alt="Tim Relawan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-green-900/10 mix-blend-multiply"></div>
                            </div>
                            {{-- floating badge --}}
                            <div class="absolute -bottom-6 -right-6 bg-white p-2 rounded-3xl shadow-xl shadow-slate-200/50 hidden lg:block border border-slate-50">
                                <div class="bg-green-600 text-white px-8 py-6 rounded-2xl">
                                    <div class="text-3xl font-black mb-1">10+</div>
                                    <div class="text-[10px] font-bold uppercase tracking-[0.15em] text-green-100">Tahun<br>Berdedikasi</div>
                                </div>
                            </div>
                        </div>
                        {{-- text side --}}
                        <div>
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 text-green-600 text-xs font-black uppercase tracking-[0.15em] mb-6">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                Tentang Kami
                            </span>
                            <h2 class="text-3xl lg:text-5xl font-black text-slate-900 leading-[1.15] mb-6 tracking-tight">
                                Berawal dari <span class="text-green-600">Kepedulian</span>, Tumbuh menjadi <span class="text-green-600">Harapan</span>
                            </h2>
                            <p class="text-slate-500 leading-relaxed text-base lg:text-lg mb-8">
                                Rumah Harapan adalah lembaga amil zakat, infaq, dan shadaqah yang berdedikasi untuk pemberdayaan ummat dan kemanusiaan. Sejak 2015, kami hadir untuk memberikan harapan baru bagi anak-anak dan keluarga kurang mampu.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="#" class="inline-flex items-center gap-3 text-green-600 hover:text-green-700 font-bold text-sm uppercase tracking-[0.1em] group">
                                    Pelajari Selengkapnya
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- PROGRAM                                                         -->
            <!-- ============================================================ -->
            <section id="program" class="py-24 lg:py-32 bg-slate-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{-- header --}}
                    <div class="text-center max-w-2xl mx-auto mb-16">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 text-green-600 text-xs font-black uppercase tracking-[0.15em] mb-6">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Program Kami
                        </span>
                        <h2 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tight mb-4">
                            Fokus <span class="text-green-600">Kami</span>
                        </h2>
                        <p class="text-slate-500 text-base lg:text-lg leading-relaxed">
                            Tiga pilar utama yang menjadi fondasi setiap langkah kami dalam melayani sesama.
                        </p>
                    </div>

                    {{-- program cards --}}
                    <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                        {{-- Pendidikan --}}
                        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-green-500/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-green-500 to-emerald-400"></div>
                            <div class="p-8 lg:p-10">
                                <div class="w-16 h-16 rounded-2xl bg-green-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 mb-3">Pendidikan</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                                    Memberikan akses pendidikan berkualitas bagi anak-anak kurang mampu melalui beasiswa, bimbingan belajar, dan dukungan sekolah.
                                </p>
                                <a href="#pendidikan" class="inline-flex items-center gap-2 text-green-600 font-bold text-xs uppercase tracking-[0.1em] group/link">
                                    Selengkapnya
                                    <svg class="w-3.5 h-3.5 group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>

                        {{-- Kesehatan --}}
                        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-amber-500/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-amber-400 to-amber-300"></div>
                            <div class="p-8 lg:p-10">
                                <div class="w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 mb-3">Kesehatan</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                                    Layanan kesehatan gratis, pemeriksaan rutin, dan penyuluhan kesehatan bagi masyarakat yang membutuhkan.
                                </p>
                                <a href="#kesehatan" class="inline-flex items-center gap-2 text-amber-600 font-bold text-xs uppercase tracking-[0.1em] group/link">
                                    Selengkapnya
                                    <svg class="w-3.5 h-3.5 group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>

                        {{-- Bantuan Sosial --}}
                        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-400"></div>
                            <div class="p-8 lg:p-10">
                                <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 mb-3">Bantuan Sosial</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                                    Bantuan sembako, santunan, dan pemberdayaan ekonomi untuk keluarga prasejahtera agar mandiri.
                                </p>
                                <a href="#bantuan-sosial" class="inline-flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-[0.1em] group/link">
                                    Selengkapnya
                                    <svg class="w-3.5 h-3.5 group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- BLOG / BERITA                                                   -->
            <!-- ============================================================ -->
            <section class="py-24 lg:py-32 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-2xl mx-auto mb-16">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 text-green-600 text-xs font-black uppercase tracking-[0.15em] mb-6">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Berita Terbaru
                        </span>
                        <h2 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tight mb-4">
                            Kabar <span class="text-green-600">Terbaru</span>
                        </h2>
                        <p class="text-slate-500 text-base lg:text-lg leading-relaxed">
                            Update kegiatan dan program terbaru dari Rumah Harapan.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                        {{-- card 1 --}}
                        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">
                            <div class="aspect-[16/10] bg-gradient-to-br from-green-100 to-green-50 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-full text-[10px] font-black text-green-600 uppercase tracking-[0.1em]">Pendidikan</span>
                                </div>
                                <div class="absolute bottom-4 left-4 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-white text-xs font-bold">12 Mar 2026</span>
                                </div>
                            </div>
                            <div class="p-6 lg:p-8">
                                <h3 class="font-black text-slate-900 mb-3 group-hover:text-green-600 transition-colors">
                                    Beasiswa Pendidikan untuk 50 Anak Kurang Mampu
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    Rumah Harapan kembali menyalurkan beasiswa pendidikan bagi anak-anak kurang mampu di wilayah Jakarta dan sekitarnya.
                                </p>
                                <a href="#" class="inline-flex items-center gap-2 text-green-600 font-bold text-xs uppercase tracking-[0.1em] group/link">
                                    Baca Selengkapnya
                                    <svg class="w-3.5 h-3.5 group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>

                        {{-- card 2 --}}
                        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">
                            <div class="aspect-[16/10] bg-gradient-to-br from-amber-100 to-amber-50 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-full text-[10px] font-black text-amber-600 uppercase tracking-[0.1em]">Kesehatan</span>
                                </div>
                                <div class="absolute bottom-4 left-4 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-white text-xs font-bold">5 Mar 2026</span>
                                </div>
                            </div>
                            <div class="p-6 lg:p-8">
                                <h3 class="font-black text-slate-900 mb-3 group-hover:text-amber-600 transition-colors">
                                    Bakti Kesehatan Gratis untuk 300 Warga
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    Layanan pemeriksaan kesehatan gratis bekerja sama dengan tenaga medis relawan menjangkau warga di 3 kelurahan.
                                </p>
                                <a href="#" class="inline-flex items-center gap-2 text-amber-600 font-bold text-xs uppercase tracking-[0.1em] group/link">
                                    Baca Selengkapnya
                                    <svg class="w-3.5 h-3.5 group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>

                        {{-- card 3 --}}
                        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden">
                            <div class="aspect-[16/10] bg-gradient-to-br from-blue-100 to-blue-50 relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-full text-[10px] font-black text-blue-600 uppercase tracking-[0.1em]">Sosial</span>
                                </div>
                                <div class="absolute bottom-4 left-4 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-white text-xs font-bold">28 Feb 2026</span>
                                </div>
                            </div>
                            <div class="p-6 lg:p-8">
                                <h3 class="font-black text-slate-900 mb-3 group-hover:text-blue-600 transition-colors">
                                    Paket Sembako untuk 200 Keluarga Prasejahtera
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    Distribusi paket sembako dan kebutuhan pokok menyasar keluarga prasejahtera di sekitar area binaan Rumah Harapan.
                                </p>
                                <a href="#" class="inline-flex items-center gap-2 text-blue-600 font-bold text-xs uppercase tracking-[0.1em] group/link">
                                    Baca Selengkapnya
                                    <svg class="w-3.5 h-3.5 group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-12">
                        <a href="#" class="inline-flex items-center gap-3 bg-white hover:bg-slate-50 text-slate-700 px-8 py-4 rounded-2xl font-bold text-sm uppercase tracking-[0.1em] border border-slate-200 shadow-sm hover:shadow-md transition-all active:scale-95">
                            Lihat Semua Berita
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- CTA DONASI                                                      -->
            <!-- ============================================================ -->
            <section class="py-24 lg:py-32 bg-gradient-to-br from-green-900 via-green-800 to-green-700 relative overflow-hidden">
                {{-- decorative dots --}}
                <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 20px 20px, white 1.5px, transparent 1.5px); background-size: 40px 40px;"></div>
                <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-amber-400/5 rounded-full blur-3xl"></div>

                <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-amber-300 text-xs font-black uppercase tracking-[0.15em] mb-6 border border-white/10">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                        Ayo Bergabung
                    </span>
                    <h2 class="text-3xl lg:text-5xl font-black text-white tracking-tight mb-6">
                        Setiap <span class="text-amber-400">Rupiah</span> Anda<br>
                        Adalah <span class="text-amber-400">Harapan</span> Mereka
                    </h2>
                    <p class="text-green-100/70 text-lg leading-relaxed max-w-2xl mx-auto mb-10">
                        Dengan berdonasi, Anda turut serta dalam misi kemanusiaan memberikan pendidikan, kesehatan, dan harapan bagi mereka yang membutuhkan.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center justify-center gap-3 bg-amber-400 hover:bg-amber-300 text-green-900 px-12 py-5 rounded-2xl font-black text-sm uppercase tracking-[0.15em] shadow-2xl shadow-amber-400/30 transition-all active:scale-95 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            Donasi Sekarang
                        </a>
                        <a href="#"
                           class="inline-flex items-center justify-center gap-3 bg-white/10 hover:bg-white/20 text-white px-12 py-5 rounded-2xl font-black text-sm uppercase tracking-[0.15em] border border-white/20 backdrop-blur-sm transition-all active:scale-95 hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <x-site-footer />

    </body>
</html>
