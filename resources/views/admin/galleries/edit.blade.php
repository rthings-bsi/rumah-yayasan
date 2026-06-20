<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('admin.galleries.index') }}" class="hover:text-green-600 transition-colors">Galeri</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">Edit Foto</span>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-3 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-lg shadow-amber-500/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Edit Foto</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Perbarui informasi foto galeri.</p>
            </div>
        </div>

        <div class="glass-card p-6 md:p-8">
            <form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Judul <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $gallery->title) }}" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('title') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">
                        @error('title') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <input type="text" name="category" value="{{ old('category', $gallery->category) }}" placeholder="ex: Kegiatan, Acara, Santunan"
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('category') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">
                        @error('category') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                        <input type="number" name="order" value="{{ old('order', $gallery->order) }}" min="0"
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">
                        @error('order') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('description') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">{{ old('description', $gallery->description) }}</textarea>
                        @error('description') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">File Gambar</label>
                        @if($gallery->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full max-h-48 object-cover rounded-xl">
                            </div>
                        @endif
                        <div class="border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl p-8 text-center hover:border-green-400 dark:hover:border-green-500 transition-colors cursor-pointer" onclick="document.getElementById('imageInput').click()">
                            <svg class="w-10 h-10 mx-auto text-slate-300 dark:text-slate-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Klik untuk ganti gambar</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Biarkan kosong jika tidak ingin mengubah.</p>
                            <input id="imageInput" type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event)">
                        </div>
                        <div id="previewContainer" class="mt-3 hidden">
                            <img id="imagePreview" class="w-full max-h-64 object-cover rounded-xl">
                        </div>
                        @error('image') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('admin.galleries.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                        <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <button type="submit" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        Update Foto
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('previewContainer').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    @endpush
</x-app-layout>
