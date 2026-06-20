<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden" style="display: none;">
</div>

<aside :class="{
        'translate-x-0': sidebarOpen, 
        '-translate-x-full': !sidebarOpen,
        'lg:w-[270px]': !sidebarCollapsed,
        'lg:w-[88px]': sidebarCollapsed,
        'transition-all duration-300 ease-in-out': sidebarReady
    }"
    class="fixed inset-y-0 left-0 z-50 w-[280px] overflow-y-auto overflow-x-hidden transform lg:translate-x-0 lg:static lg:inset-0 lg:z-auto flex flex-col shadow-2xl lg:shadow-none bg-white/80 dark:bg-slate-900/80 backdrop-blur-3xl border-r border-slate-200/50 dark:border-slate-700/50">

    <div class="flex items-center justify-between border-b border-slate-200/50 dark:border-slate-700/50 transition-all duration-300"
        :class="sidebarCollapsed && !isMobile ? 'px-4 py-6 justify-center' : 'px-5 py-6'">
        <div class="flex items-center gap-3">
            <div
                class="p-2 bg-gradient-to-br from-[#16a34a] to-[#15803d] rounded-2xl shadow-lg shadow-green-600/20 flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                <x-application-logo class="w-8 h-8 text-white" />
            </div>
            <div x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-opacity duration-300 delay-100"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="min-w-0 flex flex-col justify-center">
                <span
                    class="text-slate-800 dark:text-white text-lg font-bold tracking-tight whitespace-nowrap leading-tight">Rumah
                    Harapan</span>
                <span
                    class="text-[10px] font-bold text-[#16a34a] dark:text-green-400 uppercase tracking-widest whitespace-nowrap">Management
                    System</span>
            </div>
        </div>
        <button @click="sidebarOpen = false"
            class="lg:hidden p-2 -mr-2 text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 active:scale-95 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="flex-1 py-6 space-y-2 transition-all duration-300"
        :class="sidebarCollapsed && !isMobile ? 'px-3' : 'px-4'">
        <p x-show="!sidebarCollapsed || isMobile"
            class="px-3 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mb-4 whitespace-nowrap">
            Menu Utama</p>
        <div x-show="sidebarCollapsed && !isMobile" class="w-6 h-px bg-slate-200 dark:bg-slate-700 mx-auto mb-4"></div>

        <a href="{{ route('dashboard') }}" @click="if(isMobile) sidebarOpen = false"
            class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
           {{ request()->routeIs('dashboard')
    ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
    : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
            :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
            :title="sidebarCollapsed && !isMobile ? 'Dasbor' : ''">

            @if(request()->routeIs('dashboard'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
            @endif

            <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                {{ request()->routeIs('dashboard')
    ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
    : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="9" x="3" y="3" rx="1" />
                    <rect width="7" height="5" x="14" y="3" rx="1" />
                    <rect width="7" height="9" x="14" y="12" rx="1" />
                    <rect width="7" height="5" x="3" y="16" rx="1" />
                </svg>
            </div>

            <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                Dasbor
            </span>
        </a>

        <p x-show="!sidebarCollapsed || isMobile"
            class="px-3 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mt-6 mb-2 whitespace-nowrap">
            Data Master</p>
        <div x-show="sidebarCollapsed && !isMobile" class="w-6 h-px bg-slate-200 dark:bg-slate-700 mx-auto mt-6 mb-2"></div>

        <a href="{{ route('children.index') }}" @click="if(isMobile) sidebarOpen = false"
            class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
           {{ request()->routeIs('children.*')
    ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
    : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
            :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
            :title="sidebarCollapsed && !isMobile ? 'Data Anak' : ''">

            @if(request()->routeIs('children.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
            @endif

            <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                {{ request()->routeIs('children.*')
    ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
    : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
            </div>

            <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                Data Anak
            </span>
        </a>

        <a href="{{ route('asramas.index') }}" @click="if(isMobile) sidebarOpen = false"
            class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
           {{ request()->routeIs('asramas.*')
    ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
    : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
            :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
            :title="sidebarCollapsed && !isMobile ? 'Data Asrama' : ''">

            @if(request()->routeIs('asramas.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
            @endif

            <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                {{ request()->routeIs('asramas.*')
    ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
    : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </div>

            <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                Data Asrama
            </span>
        </a>

        <p x-show="!sidebarCollapsed || isMobile"
            class="px-3 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mt-6 mb-2 whitespace-nowrap">
            Keuangan</p>
        <div x-show="sidebarCollapsed && !isMobile" class="w-6 h-px bg-slate-200 dark:bg-slate-700 mx-auto mt-6 mb-2"></div>

        {{-- Laporan Keuangan --}}
        <a href="{{ route('laporan.index') }}" @click="if(isMobile) sidebarOpen = false"
            class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
           {{ request()->routeIs('laporan.*')
    ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
    : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
            :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
            :title="sidebarCollapsed && !isMobile ? 'Laporan Keuangan' : ''">

            @if(request()->routeIs('laporan.*'))
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
            @endif

            <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                {{ request()->routeIs('laporan.*')
    ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
    : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>

            <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                Laporan Keuangan
            </span>
        </a>

        {{-- Approval Links (Finance & Director) --}}
        @if(in_array(auth()->user()->role, ['finance', 'admin']))
            <a href="{{ route('approval.finance.index') }}" @click="if(isMobile) sidebarOpen = false"
                class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
               {{ request()->routeIs('approval.finance.*')
        ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
        : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
                :title="sidebarCollapsed && !isMobile ? 'Verifikasi Finance' : ''">

                @if(request()->routeIs('approval.finance.*'))
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
                @endif

                <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                    {{ request()->routeIs('approval.finance.*')
            ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
            : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                    :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                    Verifikasi Finance
                </span>
            </a>
        @endif

        @if(in_array(auth()->user()->role, ['director', 'admin']))
            <a href="{{ route('approval.director.index') }}" @click="if(isMobile) sidebarOpen = false"
                class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
               {{ request()->routeIs('approval.director.*')
        ? 'bg-gradient-to-r from-emerald-50 to-transparent dark:from-emerald-500/10 dark:to-transparent text-emerald-700 dark:text-emerald-400'
        : 'text-slate-600 hover:bg-slate-100/50 hover:text-emerald-500 dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-emerald-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
                :title="sidebarCollapsed && !isMobile ? 'Approval Direktur' : ''">

                @if(request()->routeIs('approval.director.*'))
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500 rounded-r-md"></div>
                @endif

                <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                    {{ request()->routeIs('approval.director.*')
            ? 'bg-white text-emerald-600 shadow-sm dark:bg-emerald-500/20 dark:text-emerald-400'
            : 'text-slate-400 group-hover:text-emerald-500 dark:text-slate-500 dark:group-hover:text-emerald-400' }}"
                    :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                    Approval Direktur
                </span>
            </a>
        @endif

        @if(auth()->user()->role === 'admin')
            <p x-show="!sidebarCollapsed || isMobile"
                class="px-3 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mt-6 mb-2 whitespace-nowrap">
                Pengaturan</p>
            <div x-show="sidebarCollapsed && !isMobile" class="w-6 h-px bg-slate-200 dark:bg-slate-700 mx-auto mt-6 mb-2"></div>

            <a href="{{ route('users.index') }}" @click="if(isMobile) sidebarOpen = false"
                class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden mt-2
                   {{ request()->routeIs('users.*')
            ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
            : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
                :title="sidebarCollapsed && !isMobile ? 'Kelola Pengguna' : ''">

                @if(request()->routeIs('users.*'))
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
                @endif

                <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                        {{ request()->routeIs('users.*')
            ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
            : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                    :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M19 8v6" />
                        <path d="M22 11h-6" />
                    </svg>
                </div>

                <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                    Kelola Pengguna
                </span>
            </a>

            {{-- Konten Website Section --}}
            <p x-show="!sidebarCollapsed || isMobile"
                class="px-3 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mt-6 mb-2 whitespace-nowrap">
                Konten Website</p>
            <div x-show="sidebarCollapsed && !isMobile" class="w-6 h-px bg-slate-200 dark:bg-slate-700 mx-auto mt-6 mb-2"></div>

            <a href="{{ route('admin.berita.index') }}" @click="if(isMobile) sidebarOpen = false"
                class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden mt-2
                   {{ request()->routeIs('admin.berita.*')
            ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
            : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
                :title="sidebarCollapsed && !isMobile ? 'Berita / Artikel' : ''">

                @if(request()->routeIs('admin.berita.*'))
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
                @endif

                <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                        {{ request()->routeIs('admin.berita.*')
            ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
            : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                    :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>

                <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                    Berita / Artikel
                </span>
            </a>

            <a href="{{ route('admin.programs.index') }}" @click="if(isMobile) sidebarOpen = false"
                class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
                   {{ request()->routeIs('admin.programs.*')
            ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
            : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
                :title="sidebarCollapsed && !isMobile ? 'Program' : ''">

                @if(request()->routeIs('admin.programs.*'))
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
                @endif

                <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                        {{ request()->routeIs('admin.programs.*')
            ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
            : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                    :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>

                <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                    Program
                </span>
            </a>

            <a href="{{ route('admin.galleries.index') }}" @click="if(isMobile) sidebarOpen = false"
                class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
                   {{ request()->routeIs('admin.galleries.*')
            ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
            : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
                :title="sidebarCollapsed && !isMobile ? 'Galeri' : ''">

                @if(request()->routeIs('admin.galleries.*'))
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
                @endif

                <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                        {{ request()->routeIs('admin.galleries.*')
            ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
            : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                    :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                    Galeri
                </span>
            </a>

            <a href="{{ route('admin.settings.index') }}" @click="if(isMobile) sidebarOpen = false"
                class="flex items-center rounded-xl transition-all duration-300 group relative overflow-hidden
                   {{ request()->routeIs('admin.settings.*')
            ? 'bg-gradient-to-r from-green-50 to-transparent dark:from-green-500/10 dark:to-transparent text-green-700 dark:text-green-400'
            : 'text-slate-600 hover:bg-slate-100/50 hover:text-[#16a34a] dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400' }}"
                :class="sidebarCollapsed && !isMobile ? 'px-0 py-3 justify-center' : 'px-3 py-3'"
                :title="sidebarCollapsed && !isMobile ? 'Pengaturan Website' : ''">

                @if(request()->routeIs('admin.settings.*'))
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#16a34a] rounded-r-md"></div>
                @endif

                <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110
                        {{ request()->routeIs('admin.settings.*')
            ? 'bg-white text-[#16a34a] shadow-sm dark:bg-green-500/20 dark:text-green-400'
            : 'text-slate-400 group-hover:text-[#16a34a] dark:text-slate-500 dark:group-hover:text-green-400' }}"
                    :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>

                <span x-show="!sidebarCollapsed || isMobile" x-transition:enter="transition-all duration-300 delay-100"
                    x-transition:enter-start="opacity-0 -translate-x-2" x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-semibold text-sm whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">
                    Pengaturan Website
                </span>
            </a>
        @endif
    </nav>

    <div class="border-t border-slate-200/50 dark:border-slate-700/50 p-3 space-y-1 transition-all duration-300">
        <div class="flex items-center gap-3 py-2 mb-2 transition-all duration-300"
            :class="sidebarCollapsed && !isMobile ? 'justify-center px-0' : 'px-2'">
            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-[#16a34a] to-[#15803d] flex items-center justify-center font-bold text-white text-sm shadow-md shadow-green-600/20 ring-2 ring-white dark:ring-slate-800"
                :title="sidebarCollapsed && !isMobile ? '{{ Auth::user()->name }}' : ''">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>

            <div x-show="!sidebarCollapsed || isMobile" x-transition.opacity.duration.200ms class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800 dark:text-slate-100 truncate">{{ Auth::user()->name }}</p>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <div class="w-1.5 h-1.5 rounded-full bg-[#16a34a] shadow-[0_0_5px_rgba(22,163,74,0.6)]"></div>
                    <p class="text-[11px] font-medium text-slate-500 dark:text-slate-400 truncate capitalize">
                        {{ __(ucfirst(Auth::user()->role)) }} Akun</p>
                </div>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" @click="if(isMobile) sidebarOpen = false"
            class="flex items-center gap-3 rounded-xl text-slate-500 hover:bg-slate-100/50 hover:text-[#16a34a] active:bg-slate-200/50 dark:text-slate-400 dark:hover:bg-slate-800/50 dark:hover:text-green-400 transition-all duration-200 text-sm font-medium group"
            :class="sidebarCollapsed && !isMobile ? 'justify-center py-2.5 px-0' : 'px-3 py-2.5'"
            :title="sidebarCollapsed && !isMobile ? 'Profil' : ''">
            <svg class="w-4 h-4 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            <span x-show="!sidebarCollapsed || isMobile"
                class="whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">Profil</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 w-full rounded-xl text-slate-500 hover:bg-rose-50 hover:text-rose-600 active:bg-rose-100 dark:text-slate-400 dark:hover:bg-rose-500/10 dark:hover:text-rose-400 transition-all duration-200 text-sm font-medium group"
                :class="sidebarCollapsed && !isMobile ? 'justify-center py-2.5 px-0' : 'px-3 py-2.5'"
                :title="sidebarCollapsed && !isMobile ? 'Keluar' : ''">
                <svg class="w-4 h-4 flex-shrink-0 transition-transform group-hover:scale-110" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" x2="9" y1="12" y2="12" />
                </svg>
                <span x-show="!sidebarCollapsed || isMobile"
                    class="whitespace-nowrap transition-transform duration-300 group-hover:translate-x-1">Keluar</span>
            </button>
        </form>
    </div>
</aside>