<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('laporan.index') }}" class="text-slate-500 hover:text-green-600 transition-colors font-medium">{{ __('Laporan Keuangan') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <a href="{{ route('laporan.show', $laporan) }}" class="text-slate-500 hover:text-green-600 transition-colors font-medium">{{ $laporan->asrama->kode_asrama }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-bold text-slate-800 dark:text-slate-100">{{ __('Edit Laporan') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto" x-data="{ 
        expenseForm: false,
        reimbursementForm: false,
        kategori: '',
        deskripsi: '',
        jumlah: '',
        reimb_deskripsi: '',
        reimb_jumlah: ''
    }">
        {{-- Header Info --}}
        <div class="glass-card overflow-hidden mb-8 animate-fade-in-up">
            <div class="h-20 bg-gradient-to-r from-amber-500 via-amber-400 to-orange-500 relative">
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_1px_1px,#fff_1px,transparent_0)] [background-size:20px_20px]"></div>
            </div>
            <div class="px-8 pb-6 -mt-8 relative z-10 flex items-end gap-6">
                <div class="w-16 h-16 rounded-2xl bg-white dark:bg-slate-800 p-2 shadow-xl shadow-amber-500/20">
                    <div class="w-full h-full rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-1 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[10px] font-black rounded-lg uppercase tracking-widest border border-amber-100 dark:border-amber-500/20">
                            {{ __('Mode Edit') }}
                        </span>
                        <span class="px-2.5 py-1 bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-[10px] font-black rounded-lg uppercase tracking-widest border border-green-100 dark:border-green-500/20">
                            {{ $laporan->asrama->kode_asrama }}
                        </span>
                    </div>
                    <h1 class="text-xl font-black text-slate-900 dark:text-white mt-1">
                        {{ $laporan->asrama->nama_asrama }} — {{ \Carbon\Carbon::create()->month($laporan->bulan)->locale('id')->isoFormat('MMMM') }} {{ $laporan->tahun }}
                    </h1>
                    <p class="text-xs font-medium text-slate-400 mt-0.5">{{ __('Tambahkan item pengeluaran dan reimbursement di bawah ini') }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Expense Items --}}
            <div class="space-y-6 animate-fade-in-up delay-75">
                <div class="content-card overflow-hidden">
                    <div class="content-card-header flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 shadow-sm flex items-center justify-center text-green-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="section-title text-base">{{ __('Pengeluaran') }}</h3>
                        </div>
                        <button @click="expenseForm = !expenseForm" class="btn btn-primary text-xs h-9 px-4 shadow-green-500/10">
                            <svg class="w-3.5 h-3.5" x-show="!expenseForm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            <svg class="w-3.5 h-3.5" x-show="expenseForm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></svg>
                            <span x-text="expenseForm ? '{{ __('Batal') }}' : '{{ __('Tambah Item') }}'"></span>
                        </button>
                    </div>

                    {{-- Add Expense Form --}}
                    <div x-show="expenseForm" x-collapse class="border-b border-slate-100 dark:border-slate-700/50">
                        <form method="POST" action="{{ route('laporan.expense_item.store', $laporan) }}" class="p-6 space-y-4">
                            @csrf
                            <div>
                                <label class="form-label text-xs">{{ __('Kategori') }}</label>
                                <select name="kategori" class="form-input-modern w-full mt-1 text-xs" required>
                                    <option value="">{{ __('Pilih Kategori') }}</option>
                                    @foreach($kategoriList as $val => $label)
                                        <option value="{{ $val }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label text-xs">{{ __('Deskripsi') }}</label>
                                <input type="text" name="deskripsi" class="form-input-modern w-full mt-1 text-xs" placeholder="{{ __('Mis: Uang saku 10 anak x Rp150.000') }}" required>
                            </div>
                            <div>
                                <label class="form-label text-xs">{{ __('Jumlah (Rp)') }}</label>
                                <input type="number" name="jumlah" class="form-input-modern w-full mt-1 text-xs" placeholder="0" min="0" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary text-xs h-10 w-full">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Simpan Item Pengeluaran') }}
                            </button>
                        </form>
                    </div>

                    <div class="content-card-body p-0">
                        @if($laporan->expenseItems->isEmpty())
                            <div class="text-center py-12">
                                <p class="text-slate-400 text-sm font-medium">{{ __('Belum ada item pengeluaran.') }}</p>
                                <p class="text-xs text-slate-300 mt-1">{{ __('Klik "Tambah Item" untuk memulai') }}</p>
                            </div>
                        @else
                            <div class="divide-y divide-slate-50 dark:divide-white/5">
                                @foreach($laporan->expenseItems as $item)
                                    <div class="flex items-center justify-between px-6 py-3.5 hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors group/item">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 rounded-full 
                                                @if($item->kategori == 'uang_saku') bg-green-500
                                                @elseif($item->kategori == 'logistik') bg-orange-500
                                                @elseif($item->kategori == 'transportasi') bg-blue-500
                                                @elseif($item->kategori == 'sewa') bg-purple-500
                                                @elseif($item->kategori == 'spp') bg-pink-500
                                                @elseif($item->kategori == 'token_listrik') bg-yellow-500
                                                @else bg-slate-400
                                                @endif">
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $item->deskripsi }}</p>
                                                <span class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">{{ $item->kategori_label }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-black text-slate-800 dark:text-slate-100">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                                            <form method="POST" action="{{ route('laporan.expense_item.destroy', [$laporan, $item]) }}" onsubmit="return confirm('{{ __('Hapus item ini?') }}')" class="opacity-0 group-hover/item:opacity-100 transition-opacity">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1.5 text-slate-300 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-700/50">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-black uppercase tracking-wider text-slate-500">{{ __('Total Pengeluaran') }}</span>
                                    <span class="text-lg font-black text-green-600 dark:text-green-400">Rp {{ number_format($laporan->total_pengeluaran, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Reimbursement Items --}}
            <div class="space-y-6 animate-fade-in-up delay-150">
                <div class="content-card overflow-hidden">
                    <div class="content-card-header flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 shadow-sm flex items-center justify-center text-amber-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="section-title text-base">{{ __('Reimbursement') }}</h3>
                        </div>
                        <button @click="reimbursementForm = !reimbursementForm" class="btn btn-primary text-xs h-9 px-4 shadow-amber-500/10 !bg-amber-600 hover:!bg-amber-700">
                            <svg class="w-3.5 h-3.5" x-show="!reimbursementForm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            <svg class="w-3.5 h-3.5" x-show="reimbursementForm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></svg>
                            <span x-text="reimbursementForm ? '{{ __('Batal') }}' : '{{ __('Tambah Item') }}'"></span>
                        </button>
                    </div>

                    {{-- Add Reimbursement Form --}}
                    <div x-show="reimbursementForm" x-collapse class="border-b border-slate-100 dark:border-slate-700/50">
                        <form method="POST" action="{{ route('laporan.reimbursement_item.store', $laporan) }}" class="p-6 space-y-4">
                            @csrf
                            <div>
                                <label class="form-label text-xs">{{ __('Deskripsi') }}</label>
                                <input type="text" name="deskripsi" class="form-input-modern w-full mt-1 text-xs" placeholder="{{ __('Mis: Kelebihan pembayaran logistik') }}" required>
                            </div>
                            <div>
                                <label class="form-label text-xs">{{ __('Jumlah (Rp)') }}</label>
                                <input type="number" name="jumlah" class="form-input-modern w-full mt-1 text-xs" placeholder="0" min="0" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary text-xs h-10 w-full !bg-amber-600 hover:!bg-amber-700">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Simpan Item Reimbursement') }}
                            </button>
                        </form>
                    </div>

                    <div class="content-card-body p-0">
                        @if($laporan->reimbursementItems->isEmpty())
                            <div class="text-center py-12">
                                <p class="text-slate-400 text-sm font-medium">{{ __('Belum ada reimbursement.') }}</p>
                            </div>
                        @else
                            <div class="divide-y divide-slate-50 dark:divide-white/5">
                                @foreach($laporan->reimbursementItems as $item)
                                    <div class="flex items-center justify-between px-6 py-3.5 hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors group/item">
                                        <div>
                                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $item->deskripsi }}</p>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-black text-amber-600 dark:text-amber-400">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
                                            <form method="POST" action="{{ route('laporan.reimbursement_item.destroy', [$laporan, $item]) }}" onsubmit="return confirm('{{ __('Hapus item ini?') }}')" class="opacity-0 group-hover/item:opacity-100 transition-opacity">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1.5 text-slate-300 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-700/50">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-black uppercase tracking-wider text-slate-500">{{ __('Total Reimbursement') }}</span>
                                    <span class="text-lg font-black text-amber-600 dark:text-amber-400">Rp {{ number_format($laporan->total_reimbursement, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex items-center justify-end gap-4 mt-8 p-6 glass-card animate-fade-in-up delay-300">
            <a href="{{ route('laporan.show', $laporan) }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">
                {{ __('Lihat Detail') }}
            </a>
            <form method="POST" action="{{ route('laporan.submit', $laporan) }}" onsubmit="return confirm('{{ __('Yakin ingin submit laporan ke Finance? Setelah submit, laporan tidak bisa diedit lagi.') }}')">
                @csrf
                <button type="submit" class="btn btn-primary shadow-green-500/10 h-12 px-8">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Submit ke Finance') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
