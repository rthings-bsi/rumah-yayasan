<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('asramas.index') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Data Asrama') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Edit') }}</span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ __('Edit Asrama') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $asrama->nama_asrama }}</p>
        </div>

        <div class="content-card">
            @if ($errors->any())
                <div class="m-6 flex items-start gap-3 text-rose-700 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 p-4 rounded-xl">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm font-semibold mb-1">{{ __('Harap perbaiki kesalahan berikut:') }}</p>
                        <ul class="list-disc pl-5 text-sm space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('asramas.update', $asrama) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="content-card-header">
                    <div class="icon-box amber">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="section-title">{{ __('Edit Data Asrama') }}</h3>
                </div>
                <div class="content-card-body border-b border-slate-100 dark:border-slate-700">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label-modern">{{ __('Kode Asrama') }} <span class="text-rose-500">*</span></label>
                            <input type="text" name="kode_asrama" value="{{ old('kode_asrama', $asrama->kode_asrama) }}" 
                                   class="form-input-modern" required placeholder="Contoh: RH01">
                            <p class="text-xs text-slate-400 mt-1">Kode unik singkat, misal: RH01, RH02</p>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Nama Asrama') }} <span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_asrama" value="{{ old('nama_asrama', $asrama->nama_asrama) }}" 
                                   class="form-input-modern" required placeholder="Contoh: Rumah Harapan 01">
                        </div>
                    </div>
                </div>

                <div class="content-card-body flex justify-end gap-3">
                    <a href="{{ route('asramas.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ __('Perbarui Asrama') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
