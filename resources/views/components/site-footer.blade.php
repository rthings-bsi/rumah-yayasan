<footer class="bg-slate-50 dark:bg-slate-900 pt-20 border-t border-gray-100 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
            <!-- Branding & About -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-rh.png') }}" alt="Rumah Harapan" class="w-10 h-10 object-contain">
                    <span class="font-black text-xl tracking-tight text-brand-primary uppercase">Rumah Harapan</span>
                </div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 leading-relaxed max-w-xs">
                    Lembaga amil zakat, infaq dan shadaqah yang berdedikasi untuk pemberdayaan ummat dan kemanusiaan.
                </p>
            </div>

            <!-- Quick Links: Tentang Kami -->
            <div>
                <h3 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-primary"></span>
                    {{ __('Tentang Kami') }}
                </h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-brand-primary transition flex items-center gap-3 group">
                        <span class="w-1 h-1 bg-slate-300 rounded-full group-hover:bg-brand-primary"></span>
                        {{ __('Visi & Misi') }}
                    </a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-brand-primary transition flex items-center gap-3 group">
                        <span class="w-1 h-1 bg-slate-300 rounded-full group-hover:bg-brand-primary"></span>
                        {{ __('Sejarah') }}
                    </a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-brand-primary transition flex items-center gap-3 group">
                        <span class="w-1 h-1 bg-slate-300 rounded-full group-hover:bg-brand-primary"></span>
                        {{ __('Struktur Organisasi') }}
                    </a></li>
                </ul>
            </div>

            <!-- Quick Links: Program -->
            <div>
                <h3 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-accent"></span>
                    {{ __('Program') }}
                </h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-brand-primary transition flex items-center gap-3 group">
                        <span class="w-1 h-1 bg-slate-300 rounded-full group-hover:bg-brand-primary"></span>
                        {{ __('Pendidikan') }}
                    </a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-brand-primary transition flex items-center gap-3 group">
                        <span class="w-1 h-1 bg-slate-300 rounded-full group-hover:bg-brand-primary"></span>
                        {{ __('Kesehatan') }}
                    </a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-brand-primary transition flex items-center gap-3 group">
                        <span class="w-1 h-1 bg-slate-300 rounded-full group-hover:bg-brand-primary"></span>
                        {{ __('Bantu Sesama') }}
                    </a></li>
                </ul>
            </div>

            <!-- Call to Action: Kontak -->
            <div class="space-y-6">
                <h3 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-dark"></span>
                    {{ __('Hubungi Kami') }}
                </h3>
                <div class="flex flex-col space-y-3">
                    <a href="#" class="bg-brand-primary text-white px-6 py-4 rounded-2xl flex items-center justify-center font-black text-xs uppercase tracking-[0.15em] shadow-lg shadow-green-500/20 hover:bg-brand-dark transition active:scale-95">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ __('Office Location') }}
                    </a>
                    <a href="#" class="bg-white dark:bg-slate-800 text-slate-800 dark:text-white px-6 py-4 rounded-2xl flex items-center justify-center font-black text-xs uppercase tracking-[0.15em] border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition active:scale-95">
                        <svg class="w-4 h-4 mr-3 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        {{ __('WhatsApp Admin') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="bg-brand-dark py-6 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">
                © {{ date('Y') }} Rumah Harapan. All Rights Reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-white/60 hover:text-white transition text-[10px] font-black uppercase tracking-[0.2em]">Privacy Policy</a>
                <a href="#" class="text-white/60 hover:text-white transition text-[10px] font-black uppercase tracking-[0.2em]">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
