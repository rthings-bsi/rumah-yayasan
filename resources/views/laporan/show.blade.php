<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm animate-fade-in">
            <a href="{{ route('laporan.index') }}" class="text-slate-500 hover:text-green-600 transition-colors font-medium">{{ __('Laporan Keuangan') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-bold text-slate-800 dark:text-slate-100">{{ $laporan->asrama->kode_asrama }} - {{ \Carbon\Carbon::create()->month($laporan->bulan)->locale('id')->isoFormat('MMMM') }} {{ $laporan->tahun }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        {{-- Header Card --}}
        <div class="glass-card overflow-hidden mb-6 animate-fade-in-up">
            <div class="h-28 bg-gradient-to-r from-green-600 via-green-500 to-emerald-600 relative">
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_1px_1px,#fff_1px,transparent_0)] [background-size:20px_20px]"></div>
            </div>
            <div class="px-8 pb-8 flex flex-col md:flex-row items-end gap-6 -mt-12 relative z-10">
                <div class="w-20 h-20 rounded-2xl bg-white dark:bg-slate-800 p-2 shadow-2xl shadow-green-500/20">
                    <div class="w-full h-full rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                <div class="flex-1 mb-2">
                    <div class="flex items-center gap-3 flex-wrap">
                        <span class="px-3 py-1 bg-green-50 dark:bg-green-500/10 text-green-600 dark:text-green-400 text-xs font-black rounded-lg uppercase tracking-widest border border-green-100 dark:border-green-500/20">
                            {{ $laporan->asrama->kode_asrama }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $laporan->status_badge }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $laporan->status === 'draft' ? 'bg-slate-400' : ($laporan->status === 'pending' ? 'bg-amber-500' : ($laporan->status === 'finance_approved' ? 'bg-blue-500' : ($laporan->status === 'director_approved' ? 'bg-emerald-500' : 'bg-red-500'))) }}"></span>
                            {{ $laporan->status_label }}
                        </span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $laporan->asrama->nama_asrama }}</h1>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mt-1">
                        {{ __('Periode') }}: {{ \Carbon\Carbon::create()->month($laporan->bulan)->locale('id')->isoFormat('MMMM') }} {{ $laporan->tahun }}
                    </p>
                </div>
                <div class="flex gap-2 mb-2 flex-wrap">
                    @if($laporan->status === 'draft')
                        <a href="{{ route('laporan.edit', $laporan) }}" class="btn btn-secondary h-11 flex items-center gap-2 text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            {{ __('Edit Laporan') }}
                        </a>
                        <form method="POST" action="{{ route('laporan.submit', $laporan) }}" onsubmit="return confirm('{{ __('Yakin ingin submit laporan ini?') }}')">
                            @csrf
                            <button type="submit" class="btn btn-primary h-11 flex items-center gap-2 text-xs shadow-green-500/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                {{ __('Submit ke Finance') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 animate-fade-in-up delay-75">
            <div class="stat-card accent-green">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Total Pengeluaran') }}</p>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-3xl font-black text-slate-800 dark:text-white">Rp {{ number_format($laporan->total_pengeluaran, 0, ',', '.') }}</p>
                    <div class="w-12 h-12 rounded-2xl bg-green-500/10 flex items-center justify-center text-green-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-amber">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Total Reimbursement') }}</p>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-3xl font-black text-amber-600 dark:text-amber-400">Rp {{ number_format($laporan->total_reimbursement, 0, ',', '.') }}</p>
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="stat-card accent-blue">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('Grand Total') }}</p>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-3xl font-black text-blue-600 dark:text-blue-400">Rp {{ number_format($laporan->total_pengeluaran + $laporan->total_reimbursement, 0, ',', '.') }}</p>
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Expense Items --}}
            <div class="content-card overflow-hidden animate-fade-in-up delay-150">
                <div class="content-card-header flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 shadow-sm flex items-center justify-center text-green-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="section-title text-base">{{ __('Pengeluaran') }}</h3>
                    <span class="text-xs font-bold text-slate-400 ml-auto">{{ $laporan->expenseItems->count() }} {{ __('item') }}</span>
                </div>
                <div class="content-card-body p-0">
                    @if($laporan->expenseItems->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-slate-400 text-sm font-medium">{{ __('Belum ada item pengeluaran.') }}</p>
                        </div>
                    @else
                        <div class="divide-y divide-slate-50 dark:divide-white/5">
                            @foreach($laporan->expenseItems as $item)
                                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                                    <div class="flex items-center gap-4">
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
                                    <span class="text-sm font-black text-slate-800 dark:text-slate-100">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
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

            {{-- Reimbursement Items --}}
            <div class="content-card overflow-hidden animate-fade-in-up delay-225">
                <div class="content-card-header flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 shadow-sm flex items-center justify-center text-amber-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="section-title text-base">{{ __('Reimbursement') }}</h3>
                    <span class="text-xs font-bold text-slate-400 ml-auto">{{ $laporan->reimbursementItems->count() }} {{ __('item') }}</span>
                </div>
                <div class="content-card-body p-0">
                    @if($laporan->reimbursementItems->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-slate-400 text-sm font-medium">{{ __('Tidak ada reimbursement.') }}</p>
                        </div>
                    @else
                        <div class="divide-y divide-slate-50 dark:divide-white/5">
                            @foreach($laporan->reimbursementItems as $item)
                                <div class="flex items-center justify-between px-6 py-4 hover:bg-slate-50/50 dark:hover:bg-white/5 transition-colors">
                                    <div>
                                        <p class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $item->deskripsi }}</p>
                                    </div>
                                    <span class="text-sm font-black text-amber-600 dark:text-amber-400">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</span>
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

        {{-- Approval Timeline --}}
        <div class="content-card mt-8 animate-fade-in-up delay-300">
            <div class="content-card-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 shadow-sm flex items-center justify-center text-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="section-title text-base">{{ __('Riwayat Approval') }}</h3>
                </div>
            </div>
            <div class="content-card-body">
                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-slate-200 dark:bg-slate-700"></div>
                    
                    {{-- Submitted --}}
                    @if($laporan->submitted_by)
                        <div class="relative flex items-start gap-6 pb-8">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-500/20 flex items-center justify-center text-amber-600 dark:text-amber-400 ring-4 ring-white dark:ring-slate-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ __('Diajukan') }} <span class="text-amber-600 dark:text-amber-400">{{ $laporan->submitter->name ?? '-' }}</span></p>
                                <p class="text-xs text-slate-500 mt-1">{{ $laporan->submitted_at ? $laporan->submitted_at->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') : '-' }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Finance Approved --}}
                    @if($laporan->finance_approved_by)
                        <div class="relative flex items-start gap-6 pb-8">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400 ring-4 ring-white dark:ring-slate-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ __('Disetujui Finance') }} <span class="text-blue-600 dark:text-blue-400">{{ $laporan->financeApprover->name ?? '-' }}</span></p>
                                <p class="text-xs text-slate-500 mt-1">{{ $laporan->finance_approved_at ? $laporan->finance_approved_at->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') : '-' }}</p>
                                @if($laporan->finance_notes)
                                    <p class="text-xs text-slate-400 mt-2 italic">"{{ $laporan->finance_notes }}"</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Director Approved --}}
                    @if($laporan->director_approved_by)
                        <div class="relative flex items-start gap-6 pb-8">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 ring-4 ring-white dark:ring-slate-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ __('Disetujui Direktur') }} <span class="text-emerald-600 dark:text-emerald-400">{{ $laporan->directorApprover->name ?? '-' }}</span></p>
                                <p class="text-xs text-slate-500 mt-1">{{ $laporan->director_approved_at ? $laporan->director_approved_at->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') : '-' }}</p>
                                @if($laporan->director_notes)
                                    <p class="text-xs text-slate-400 mt-2 italic">"{{ $laporan->director_notes }}"</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Rejected --}}
                    @if($laporan->rejected_by)
                        <div class="relative flex items-start gap-6">
                            <div class="relative z-10 w-12 h-12 rounded-full bg-red-100 dark:bg-red-500/20 flex items-center justify-center text-red-600 dark:text-red-400 ring-4 ring-white dark:ring-slate-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <div class="flex-1 pt-1">
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ __('Ditolak') }} <span class="text-red-600 dark:text-red-400">{{ $laporan->rejector->name ?? '-' }}</span></p>
                                <p class="text-xs text-slate-500 mt-1">{{ $laporan->rejected_at ? $laporan->rejected_at->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') : '-' }}</p>
                                @if($laporan->rejection_reason)
                                    <div class="mt-2 p-3 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20">
                                        <p class="text-[10px] font-black uppercase tracking-wider text-red-500 mb-1">{{ __('Alasan Penolakan') }}</p>
                                        <p class="text-sm text-red-700 dark:text-red-300">{{ $laporan->rejection_reason }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(!$laporan->submitted_by && !$laporan->rejected_by)
                        <div class="text-center py-8">
                            <p class="text-slate-400 text-sm font-medium">{{ __('Belum ada aktivitas approval.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
