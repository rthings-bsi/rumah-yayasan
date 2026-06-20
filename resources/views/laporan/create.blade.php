<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('laporan.index') }}" class="text-slate-500 hover:text-green-600 transition-colors font-medium">{{ __('Laporan Keuangan') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-bold text-slate-800 dark:text-slate-100">{{ __('Buat Laporan Baru') }}</span>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="animate-fade-in-up">
            <div class="glass-card overflow-hidden">
                <div class="h-24 bg-gradient-to-r from-green-600 via-green-500 to-emerald-600 relative">
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_1px_1px,#fff_1px,transparent_0)] [background-size:20px_20px]"></div>
                </div>
                <div class="px-8 pb-8 -mt-8 relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-white dark:bg-slate-800 p-2 shadow-xl shadow-green-500/20 mb-6">
                        <div class="w-full h-full rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('laporan.store') }}" class="mt-8 space-y-8">
                @csrf

                <div class="content-card">
                    <div class="content-card-body">
                        <h3 class="text-lg font-black text-slate-800 dark:text-white mb-6">{{ __('Informasi Laporan') }}</h3>

                        {{-- Asrama --}}
                        <div class="mb-6">
                            <label class="form-label">{{ __('Asrama') }}</label>
                            <select name="asrama_id" class="form-input-modern w-full mt-1.5 @error('asrama_id') border-red-300 @enderror" required>
                                <option value="">{{ __('Pilih Asrama') }}</option>
                                @foreach($asramas as $asrama)
                                    <option value="{{ $asrama->id }}" {{ old('asrama_id') == $asrama->id ? 'selected' : '' }}>
                                        {{ $asrama->kode_asrama }} - {{ $asrama->nama_asrama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('asrama_id')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Periode --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">{{ __('Bulan') }}</label>
                                <select name="bulan" class="form-input-modern w-full mt-1.5 @error('bulan') border-red-300 @enderror" required>
                                    <option value="">{{ __('Pilih Bulan') }}</option>
                                    @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $nama)
                                        <option value="{{ $i + 1 }}" {{ old('bulan') == $i + 1 ? 'selected' : '' }}>{{ $nama }}</option>
                                    @endforeach
                                </select>
                                @error('bulan')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="form-label">{{ __('Tahun') }}</label>
                                <select name="tahun" class="form-input-modern w-full mt-1.5 @error('tahun') border-red-300 @enderror" required>
                                    <option value="">{{ __('Pilih Tahun') }}</option>
                                    @for($y = date('Y'); $y >= 2020; $y--)
                                        <option value="{{ $y }}" {{ old('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('laporan.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">
                        {{ __('Batal') }}
                    </a>
                    <button type="submit" class="btn btn-primary shadow-green-500/10 h-12 px-8">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        {{ __('Buat Laporan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
