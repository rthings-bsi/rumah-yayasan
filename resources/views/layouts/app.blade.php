<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data x-bind:class="{ 'dark': $store.darkMode.on }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Yayasan') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Anti-flash: apply dark class before paint -->
        <script>
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Prevent sidebar flash on load -->
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="font-sans antialiased text-slate-800 dark:text-slate-200 bg-slate-50 dark:bg-slate-900 selection:bg-indigo-500 selection:text-white">
        <div class="flex h-screen overflow-hidden bg-slate-50 dark:bg-slate-900" 
             x-data="{ 
                 sidebarOpen: false, 
                 sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
                 isMobile: window.innerWidth < 1024,
                 sidebarReady: false
             }"
             x-init="
                 $nextTick(() => sidebarReady = true);
                 $watch('sidebarCollapsed', val => localStorage.setItem('sidebarCollapsed', val));
                 window.addEventListener('resize', () => { 
                     isMobile = window.innerWidth < 1024;
                     if (!isMobile) sidebarOpen = false;
                 });
             "
             @keydown.escape.window="sidebarOpen = false">

            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col overflow-hidden relative min-w-0">
                <!-- Top Header -->
                <header class="flex justify-between items-center py-3.5 px-4 sm:px-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl border-b border-slate-200/60 dark:border-slate-700/60 sticky top-0 z-10">
                    <div class="flex items-center gap-3">
                        <!-- Mobile hamburger -->
                        <button @click="sidebarOpen = true" class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none lg:hidden transition-colors p-2 -ml-1 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 active:bg-slate-200 dark:active:bg-slate-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <!-- Desktop sidebar toggle -->
                        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition-colors p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                            <svg class="h-5 w-5 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                            </svg>
                        </button>
                        @isset($header)
                            <div class="hidden sm:block">
                                {{ $header }}
                            </div>
                        @endisset
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Dark Mode Toggle -->
                        <button 
                            @click="$store.darkMode.toggle()" 
                            class="p-2 rounded-xl transition-all duration-300 group relative"
                            :class="$store.darkMode.on 
                                ? 'text-amber-400 hover:bg-amber-500/10' 
                                : 'text-slate-400 hover:text-indigo-600 hover:bg-indigo-50'"
                            id="dark-mode-toggle"
                            :title="$store.darkMode.on ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                            <!-- Sun icon (visible in dark mode) -->
                            <svg x-show="$store.darkMode.on" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 rotate-[-90deg] scale-0"
                                 x-transition:enter-end="opacity-100 rotate-0 scale-100"
                                 class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <!-- Moon icon (visible in light mode) -->
                            <svg x-show="!$store.darkMode.on" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 rotate-90 scale-0"
                                 x-transition:enter-end="opacity-100 rotate-0 scale-100"
                                 class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>

                        <!-- Notification bell -->
                        <button class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </button>
                    </div>
                </header>
                
                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/80 dark:bg-slate-900/80 p-4 sm:p-6 lg:p-8"
                      x-data="{ pageLoaded: false }"
                      x-init="$nextTick(() => { setTimeout(() => pageLoaded = true, 80) })">
                    <div class="sm:hidden mb-6">
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>

                    <!-- Skeleton Placeholder -->
                    <div x-show="!pageLoaded" 
                         x-transition:leave="transition-opacity duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="space-y-6">
                        <!-- Skeleton header -->
                        <div>
                            <div class="skeleton skeleton-title" style="width: 45%"></div>
                            <div class="skeleton skeleton-text" style="width: 70%"></div>
                        </div>
                        <!-- Skeleton cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            <div class="skeleton-card">
                                <div class="flex justify-between items-center">
                                    <div class="flex-1">
                                        <div class="skeleton skeleton-text" style="width: 60%"></div>
                                        <div class="skeleton" style="height: 2rem; width: 40%; margin-top: 0.5rem; border-radius: 0.5rem;"></div>
                                    </div>
                                    <div class="skeleton skeleton-avatar"></div>
                                </div>
                            </div>
                            <div class="skeleton-card">
                                <div class="flex justify-between items-center">
                                    <div class="flex-1">
                                        <div class="skeleton skeleton-text" style="width: 50%"></div>
                                        <div class="skeleton" style="height: 2rem; width: 35%; margin-top: 0.5rem; border-radius: 0.5rem;"></div>
                                    </div>
                                    <div class="skeleton skeleton-avatar"></div>
                                </div>
                            </div>
                            <div class="skeleton-card hidden lg:block">
                                <div class="flex justify-between items-center">
                                    <div class="flex-1">
                                        <div class="skeleton skeleton-text" style="width: 55%"></div>
                                        <div class="skeleton" style="height: 2rem; width: 30%; margin-top: 0.5rem; border-radius: 0.5rem;"></div>
                                    </div>
                                    <div class="skeleton skeleton-avatar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Skeleton content block -->
                        <div class="skeleton-card">
                            <div class="skeleton skeleton-text" style="width: 30%; margin-bottom: 1rem;"></div>
                            <div class="space-y-3">
                                <div class="skeleton skeleton-text" style="width: 100%"></div>
                                <div class="skeleton skeleton-text" style="width: 90%"></div>
                                <div class="skeleton skeleton-text" style="width: 95%"></div>
                                <div class="skeleton skeleton-text" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actual Content -->
                    <div x-show="pageLoaded"
                         x-transition:enter="transition-opacity duration-300 ease-out"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         style="display: none;">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
