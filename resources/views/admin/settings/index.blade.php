<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">Pengaturan Website</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-3 bg-gradient-to-br from-slate-600 to-slate-700 rounded-2xl shadow-lg shadow-slate-500/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Pengaturan Website</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Kelola konten statis website yayasan.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 px-6 py-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-2xl text-emerald-700 dark:text-emerald-400 text-sm font-bold flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf @method('PUT')

            @foreach($settings as $group => $groupSettings)
            <div class="glass-card p-6 md:p-8 mb-6">
                <h2 class="text-xl font-black text-slate-800 dark:text-white tracking-tight mb-1">{{ $group }}</h2>
                <div class="h-px bg-slate-100 dark:bg-slate-700/50 my-4"></div>
                <div class="space-y-5">
                    @foreach($groupSettings as $setting)
                        @php
                            $isLongText = in_array($setting->key, ['about_content', 'about_mission', 'about_vision', 'hero_description', 'site_description', 'footer_text']);
                            $isImage = str_contains($setting->key, 'image');
                        @endphp

                        <div>
                            <label for="{{ $setting->key }}" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                {{ ucwords(str_replace('_', ' ', Str::after($setting->key, $setting->group == 'Umum' ? '' : ($setting->group == 'Kontak' ? 'contact_' : ($setting->group == 'Hero' ? 'hero_' : ($setting->group == 'Sosial Media' ? 'social_' : ($setting->group == 'Tentang' ? 'about_' : ''))))))) }}
                                @if($isImage)
                                    <span class="text-xs text-slate-400 font-normal">(URL gambar)</span>
                                @endif
                            </label>

                            @if($isLongText)
                                <textarea name="{{ $setting->key }}" rows="4"
                                    class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">{{ old($setting->key, $setting->value) }}</textarea>
                            @else
                                <input type="{{ $isImage ? 'url' : 'text' }}" name="{{ $setting->key }}"
                                    value="{{ old($setting->key, $setting->value) }}"
                                    class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="flex justify-end">
                <button type="submit" class="px-10 py-3.5 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <svg class="w-4 h-4 inline-block -mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Semua Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
