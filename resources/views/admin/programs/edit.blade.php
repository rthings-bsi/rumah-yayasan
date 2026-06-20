<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('admin.programs.index') }}" class="hover:text-green-600 transition-colors">Program</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">Edit Program</span>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-3 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-lg shadow-amber-500/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Edit Program</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Perbarui informasi program.</p>
            </div>
        </div>

        <div class="glass-card p-6 md:p-8">
            <form method="POST" action="{{ route('admin.programs.update', $program) }}" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Program <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $program->name) }}" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('name') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">
                        @error('name') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi <span class="text-rose-500">*</span></label>
                        <textarea name="description" rows="5" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('description') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">{{ old('description', $program->description) }}</textarea>
                        @error('description') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Icon (CSS Class)</label>
                        <input type="text" name="icon" value="{{ old('icon', $program->icon) }}" placeholder="ex: fas fa-heart"
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('icon') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">
                        @error('icon') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Warna (Hex)</label>
                        <div class="flex gap-2">
                            <input type="color" name="color" value="{{ old('color', $program->color ?? '#16a34a') }}"
                                class="w-12 h-12 rounded-xl cursor-pointer border-slate-300 dark:border-slate-700">
                            <input type="text" name="color_text" value="{{ old('color', $program->color ?? '#16a34a') }}"
                                class="flex-1 w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">
                        </div>
                        @error('color') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                        <input type="number" name="order" value="{{ old('order', $program->order) }}" min="0"
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">
                        @error('order') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="status" value="1" {{ old('status', $program->status) ? 'checked' : '' }}
                                class="w-5 h-5 rounded-lg border-slate-300 dark:border-slate-600 text-green-600 focus:ring-green-500">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('admin.programs.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                        <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <button type="submit" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        Update Program
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
