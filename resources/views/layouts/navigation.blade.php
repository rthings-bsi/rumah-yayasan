<!-- Mobile overlay -->
<div 
    x-show="sidebarOpen" 
    x-transition:enter="transition-opacity ease-out duration-300" 
    x-transition:enter-start="opacity-0" 
    x-transition:enter-end="opacity-100" 
    x-transition:leave="transition-opacity ease-in duration-200" 
    x-transition:leave-start="opacity-100" 
    x-transition:leave-end="opacity-0" 
    @click="sidebarOpen = false" 
    class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"
    style="display: none;">
</div>

<!-- Sidebar -->
<aside 
    :class="{
        'translate-x-0': sidebarOpen, 
        '-translate-x-full': !sidebarOpen,
        'lg:w-[270px]': !sidebarCollapsed,
        'lg:w-[78px]': sidebarCollapsed,
        'transition-all duration-300 ease-in-out': sidebarReady
    }" 
    class="fixed inset-y-0 left-0 z-50 w-[280px] overflow-y-auto overflow-x-hidden transform lg:translate-x-0 lg:static lg:inset-0 lg:z-auto flex flex-col"
    style="background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);">
    
    <!-- Branding -->
    <div class="flex items-center justify-between border-b border-white/[0.06] transition-all duration-300"
         :class="sidebarCollapsed && !isMobile ? 'px-4 py-6' : 'px-5 py-6'">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg shadow-indigo-500/25 flex-shrink-0">
                <x-application-logo class="w-7 h-7 fill-current text-white" />
            </div>
            <div x-show="!sidebarCollapsed || isMobile" 
                 x-transition:enter="transition-opacity duration-200 delay-100" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="transition-opacity duration-100" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0"
                 class="min-w-0">
                <span class="text-white text-lg font-bold tracking-tight whitespace-nowrap">Rumah Harapan</span>
                <span class="block text-[10px] font-medium text-indigo-300/60 uppercase tracking-widest whitespace-nowrap">{{ __('Management System') }}</span>
            </div>
        </div>
        <!-- Mobile close button -->
        <button @click="sidebarOpen = false" class="lg:hidden p-2 -mr-1 text-slate-400 hover:text-white rounded-xl hover:bg-white/10 active:bg-white/20 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 py-6 space-y-1 transition-all duration-300" :class="sidebarCollapsed && !isMobile ? 'px-2' : 'px-4'">
        <p x-show="!sidebarCollapsed || isMobile" class="px-3 text-[10px] font-bold text-slate-500/80 uppercase tracking-[0.15em] mb-3 whitespace-nowrap">{{ __('Main Menu') }}</p>
        <div x-show="sidebarCollapsed && !isMobile" class="w-8 h-px bg-white/10 mx-auto mb-3"></div>
        
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           @click="if(isMobile) sidebarOpen = false"
           class="flex items-center rounded-xl transition-all duration-200 group relative
           {{ request()->routeIs('dashboard') 
              ? 'bg-indigo-500/10 text-white' 
              : 'text-slate-400 hover:bg-white/[0.06] hover:text-slate-200 active:bg-white/[0.08]' }}"
           :class="sidebarCollapsed && !isMobile ? 'px-0 py-2.5 justify-center' : 'px-3.5 py-3'"
           :title="sidebarCollapsed && !isMobile ? '{{ __('Dashboard') }}' : ''">
            <div class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200
                {{ request()->routeIs('dashboard') 
                   ? 'bg-indigo-500/20 text-indigo-400' 
                   : 'text-slate-500 group-hover:text-slate-300' }}"
                :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </div>
            <span x-show="!sidebarCollapsed || isMobile" 
                  x-transition:enter="transition-opacity duration-200 delay-100" 
                  x-transition:enter-start="opacity-0" 
                  x-transition:enter-end="opacity-100" 
                  x-transition:leave="transition-opacity duration-100" 
                  x-transition:leave-start="opacity-100" 
                  x-transition:leave-end="opacity-0" 
                  class="font-medium text-sm whitespace-nowrap">{{ __('Dashboard') }}</span>
            @if(request()->routeIs('dashboard'))
                <div x-show="!sidebarCollapsed || isMobile" class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
                <div x-show="sidebarCollapsed && !isMobile" class="absolute top-1 right-1 w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
            @endif
        </a>

        <!-- Children Data -->
        <a href="{{ route('children.index') }}" 
           @click="if(isMobile) sidebarOpen = false"
           class="flex items-center rounded-xl transition-all duration-200 group relative
           {{ request()->routeIs('children.*') 
              ? 'bg-indigo-500/10 text-white' 
              : 'text-slate-400 hover:bg-white/[0.06] hover:text-slate-200 active:bg-white/[0.08]' }}"
           :class="sidebarCollapsed && !isMobile ? 'px-0 py-2.5 justify-center' : 'px-3.5 py-3'"
           :title="sidebarCollapsed && !isMobile ? '{{ __('Children Data') }}' : ''">
            <div class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center transition-all duration-200
                {{ request()->routeIs('children.*') 
                   ? 'bg-indigo-500/20 text-indigo-400' 
                   : 'text-slate-500 group-hover:text-slate-300' }}"
                :class="sidebarCollapsed && !isMobile ? 'mr-0' : 'mr-3'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <span x-show="!sidebarCollapsed || isMobile" 
                  x-transition:enter="transition-opacity duration-200 delay-100" 
                  x-transition:enter-start="opacity-0" 
                  x-transition:enter-end="opacity-100" 
                  x-transition:leave="transition-opacity duration-100" 
                  x-transition:leave-start="opacity-100" 
                  x-transition:leave-end="opacity-0" 
                  class="font-medium text-sm whitespace-nowrap">{{ __('Children Data') }}</span>
            @if(request()->routeIs('children.*'))
                <div x-show="!sidebarCollapsed || isMobile" class="ml-auto w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
                <div x-show="sidebarCollapsed && !isMobile" class="absolute top-1 right-1 w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
            @endif
        </a>
    </nav>
    
    <!-- User Footer -->
    <div class="border-t border-white/[0.06] space-y-1 transition-all duration-300" :class="sidebarCollapsed && !isMobile ? 'p-2' : 'p-3'">
        <!-- User Info -->
        <div class="flex items-center gap-3 py-2 transition-all duration-300" :class="sidebarCollapsed && !isMobile ? 'justify-center px-0' : 'px-3'">
            <div class="flex-shrink-0 w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-white text-xs shadow-md shadow-indigo-500/20"
                 :title="sidebarCollapsed && !isMobile ? '{{ Auth::user()->name }}' : ''">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div x-show="!sidebarCollapsed || isMobile" 
                 x-transition:enter="transition-opacity duration-200 delay-100" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="transition-opacity duration-100" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-[11px] text-slate-500 truncate capitalize">{{ Auth::user()->role }} Account</p>
            </div>
            <div x-show="!sidebarCollapsed || isMobile" class="w-2 h-2 rounded-full bg-emerald-400"></div>
        </div>

        <!-- Profile Link -->
        <a href="{{ route('profile.edit') }}" 
           @click="if(isMobile) sidebarOpen = false"
           class="flex items-center gap-3 rounded-lg text-slate-400 hover:bg-white/[0.06] hover:text-white active:bg-white/[0.1] transition-all duration-200 text-sm"
           :class="sidebarCollapsed && !isMobile ? 'justify-center py-2.5 px-0' : 'px-3 py-2.5'"
           :title="sidebarCollapsed && !isMobile ? '{{ __('Profile') }}' : ''">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span x-show="!sidebarCollapsed || isMobile" class="whitespace-nowrap">{{ __('Profile') }}</span>
        </a>

        <!-- Log Out -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="flex items-center gap-3 w-full rounded-lg text-slate-400 hover:bg-rose-500/10 hover:text-rose-400 active:bg-rose-500/20 transition-all duration-200 text-sm"
                    :class="sidebarCollapsed && !isMobile ? 'justify-center py-2.5 px-0' : 'px-3 py-2.5'"
                    :title="sidebarCollapsed && !isMobile ? '{{ __('Log Out') }}' : ''">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span x-show="!sidebarCollapsed || isMobile" class="whitespace-nowrap">{{ __('Log Out') }}</span>
            </button>
        </form>
    </div>
</aside>
