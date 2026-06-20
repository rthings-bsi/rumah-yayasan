<nav id="main-navbar" class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100 dark:bg-slate-900 dark:border-slate-800 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo Area -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-rh.png') }}" alt="Rumah Harapan" class="w-10 h-10 object-contain">
                <div class="flex flex-col">
                    <span class="font-black text-lg leading-none tracking-tight text-brand-primary uppercase">Rumah Harapan</span>
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.2em] mt-0.5">YAYASAN KASIH</span>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-green-600' : 'text-slate-600' }} hover:text-green-600 font-bold text-sm uppercase tracking-widest transition">Beranda</a>
                <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'text-green-600' : 'text-slate-600' }} hover:text-green-600 font-bold text-sm uppercase tracking-widest transition">Tentang Kami</a>
                <a href="{{ route('program') }}" class="{{ request()->routeIs('program') ? 'text-green-600' : 'text-slate-600' }} hover:text-green-600 font-bold text-sm uppercase tracking-widest transition">Program</a>
                <a href="{{ route('berita') }}" class="{{ request()->routeIs('berita') ? 'text-green-600' : 'text-slate-600' }} hover:text-green-600 font-bold text-sm uppercase tracking-widest transition">Berita</a>
                <a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'text-green-600' : 'text-slate-600' }} hover:text-green-600 font-bold text-sm uppercase tracking-widest transition">Galeri</a>
                <a href="{{ route('login') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-full font-black text-xs uppercase tracking-[0.15em] transition shadow-lg shadow-green-500/20 active:scale-95">
                    Donasi
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-brand-primary p-2 focus:outline-none">
                    <svg id="icon-menu" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                    <svg id="icon-close" class="w-8 h-8 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 absolute w-full left-0 top-full shadow-lg origin-top transition-all duration-200 ease-out">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="{{ route('home') }}" class="mobile-nav-link block px-4 py-4 text-sm font-black {{ request()->routeIs('home') ? 'text-green-600' : 'text-gray-700' }} uppercase tracking-widest border-b border-gray-50">Beranda</a>
            <a href="{{ route('tentang') }}" class="mobile-nav-link block px-4 py-4 text-sm font-black {{ request()->routeIs('tentang') ? 'text-green-600' : 'text-gray-700' }} uppercase tracking-widest border-b border-gray-50">Tentang Kami</a>
            <a href="{{ route('program') }}" class="mobile-nav-link block px-4 py-4 text-sm font-black {{ request()->routeIs('program') ? 'text-green-600' : 'text-gray-700' }} uppercase tracking-widest border-b border-gray-50">Program</a>
            <a href="{{ route('berita') }}" class="mobile-nav-link block px-4 py-4 text-sm font-black {{ request()->routeIs('berita') ? 'text-green-600' : 'text-gray-700' }} uppercase tracking-widest border-b border-gray-50">Berita</a>
            <a href="{{ route('galeri') }}" class="mobile-nav-link block px-4 py-4 text-sm font-black {{ request()->routeIs('galeri') ? 'text-green-600' : 'text-gray-700' }} uppercase tracking-widest border-b border-gray-50">Galeri</a>
            <div class="px-4 pt-4">
                <a href="{{ route('login') }}" class="block w-full text-center bg-green-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-lg shadow-green-500/20 active:scale-95 transition-transform">
                    Donasi Sekarang
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');
        const links = document.querySelectorAll('.mobile-nav-link');

        function toggleMenu() {
            if (menu.classList.contains('hidden')) {
                // Buka menu
                menu.classList.remove('hidden');
                iconMenu.classList.add('hidden');
                iconClose.classList.remove('hidden');
            } else {
                // Tutup menu
                menu.classList.add('hidden');
                iconMenu.classList.remove('hidden');
                iconClose.classList.add('hidden');
            }
        }

        // Toggle pas tombol diklik
        if(btn) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                toggleMenu();
            });
        }

        // Tutup pas link diklik
        links.forEach(link => {
            link.addEventListener('click', function() {
                menu.classList.add('hidden');
                iconMenu.classList.remove('hidden');
                iconClose.classList.add('hidden');
            });
        });

        // Tutup pas klik di luar menu
        document.addEventListener('click', function(e) {
            if (!menu.classList.contains('hidden') && !menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.add('hidden');
                iconMenu.classList.remove('hidden');
                iconClose.classList.add('hidden');
            }
        });
    });
</script>