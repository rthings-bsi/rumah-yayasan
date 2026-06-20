<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-green-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('admin.berita.index') }}" class="hover:text-green-600 transition-colors">Berita</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">Edit Berita</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-3 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl shadow-lg shadow-amber-500/20">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Edit Berita</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Perbarui informasi berita.</p>
            </div>
        </div>

        <div class="glass-card p-6 md:p-8">
            <form method="POST" action="{{ route('admin.berita.update', $beritum) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Judul Berita <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $beritum->title) }}" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('title') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">
                        @error('title') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">
                            <option value="">Pilih Kategori</option>
                            <option value="Pendidikan" {{ old('category', $beritum->category) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Kesehatan" {{ old('category', $beritum->category) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Sosial" {{ old('category', $beritum->category) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Acara" {{ old('category', $beritum->category) == 'Acara' ? 'selected' : '' }}>Acara</option>
                            <option value="Umum" {{ old('category', $beritum->category) == 'Umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                        @error('category') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Status</label>
                        <select name="status" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">
                            <option value="draft" {{ old('status', $beritum->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $beritum->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Penulis <span class="text-rose-500">*</span></label>
                        <input type="text" name="author" value="{{ old('author', $beritum->author) }}" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200 @error('author') border-rose-400 focus:border-rose-400 focus:ring-rose-200 @enderror">
                        @error('author') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', $beritum->published_at ? $beritum->published_at->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">
                        @error('published_at') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Ringkasan (Excerpt)</label>
                        <textarea name="excerpt" rows="2"
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">{{ old('excerpt', $beritum->excerpt) }}</textarea>
                        @error('excerpt') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Konten <span class="text-rose-500">*</span></label>
                        <textarea name="content" id="editor" rows="12" required
                            class="w-full px-4 py-3 rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition-all text-slate-800 dark:text-slate-200">{{ old('content', $beritum->content) }}</textarea>
                        @error('content') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Gambar</label>
                        @if($beritum->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $beritum->image) }}" class="w-32 h-24 object-cover rounded-xl">
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-green-500/10 dark:file:text-green-400">
                        <p class="mt-1 text-xs text-slate-400">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        @error('image') <p class="mt-1 text-xs text-rose-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $beritum->featured) ? 'checked' : '' }}
                                class="w-5 h-5 rounded-lg border-slate-300 dark:border-slate-600 text-green-600 focus:ring-green-500">
                            <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Jadikan Featured</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('admin.berita.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                        <svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                    <button type="submit" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg shadow-green-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        Update Berita
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor',
            height: 400,
            menubar: false,
            plugins: 'lists link image paste code',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
            content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; }',
            skin: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide',
            content_css: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default',
        });
    </script>
    @endpush
</x-app-layout>
