<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Verifikasi Laporan - Finance') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 pt-6">
        {{-- Hero --}}
        <div class="relative mb-8 animate-fade-in">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 sm:gap-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-slate-800 dark:text-white tracking-tight leading-tight">
                        {{ __('Verifikasi Laporan') }}<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400">{{ __('Finance') }}</span>
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium mt-2">{{ __('Periksa dan verifikasi laporan pengeluaran asrama') }}</p>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="glass-card mb-6 animate-fade-in-up delay-75">
            <div class="p-3 sm:p-4">
                <form method="GET" action="{{ route('approval.finance.index') }}" class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-2 sm:gap-3">
                    <div class="relative flex-1 w-full sm:min-w-[200px]">
                        <select name="asrama_id" class="form-input-modern text-xs py-2.5">
                            <option value="">{{ __('Semua Asrama') }}</option>
                            @foreach($asramas as $asrama)
                                <option value="{{ $asrama->id }}" {{ request('asrama_id') == $asrama->id ? 'selected' : '' }}>{{ $asrama->kode_asrama }} - {{ $asrama->nama_asrama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-xs h-10 px-4 sm:px-5 w-full sm:w-auto">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('approval.finance.index') }}" class="text-xs font-medium text-slate-400 hover:text-slate-600 transition-colors text-center sm:text-left">{{ __('Reset') }}</a>
                </form>
            </div>
        </div>

        {{-- Reports --}}
        <div class="space-y-6 animate-fade-in-up delay-150">
            @forelse($reports as $report)
                <div class="content-card overflow-hidden group hover:shadow-lg hover:shadow-green-500/5 transition-all duration-300">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col lg:flex-row justify-between gap-4 sm:gap-6">
                            <div class="flex items-start gap-3 sm:gap-4">
                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-green-500/20 flex-shrink-0">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-base sm:text-lg font-black text-slate-800 dark:text-white break-words">{{ $report->asrama->nama_asrama }}</h3>
                                        <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-[10px] font-black rounded-md">{{ $report->asrama->kode_asrama }}</span>
                                    </div>
                                    <p class="text-xs sm:text-sm font-medium text-slate-500 mt-1">
                                        {{ __('Periode') }}: <span class="font-bold">{{ \Carbon\Carbon::create()->month($report->bulan)->locale('id')->isoFormat('MMMM') }} {{ $report->tahun }}</span>
                                    </p>
                                    <div class="flex flex-wrap items-center gap-2 sm:gap-4 mt-2">
                                        <span class="text-xs text-slate-400">
                                            {{ __('Pengeluaran') }}: <span class="font-bold text-green-600 dark:text-green-400">Rp {{ number_format($report->total_pengeluaran, 0, ',', '.') }}</span>
                                        </span>
                                        <span class="text-xs text-slate-400">
                                            {{ __('Reimbursement') }}: <span class="font-bold text-amber-600 dark:text-amber-400">Rp {{ number_format($report->total_reimbursement, 0, ',', '.') }}</span>
                                        </span>
                                    </div>
                                    @if($report->submitter)
                                        <p class="text-[10px] text-slate-400 mt-2">
                                            {{ __('Diajukan oleh') }}: <span class="font-bold">{{ $report->submitter->name }}</span> • {{ $report->submitted_at ? $report->submitted_at->locale('id')->isoFormat('D MMMM YYYY HH:mm') : '-' }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col xs:flex-row items-stretch xs:items-center gap-2 flex-shrink-0">
                                <a href="{{ route('laporan.show', $report) }}" class="btn btn-secondary text-xs h-10 px-3 sm:px-4 justify-center">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <span class="hidden xs:inline">{{ __('Detail') }}</span>
                                </a>
                                <button @click="$dispatch('open-finance-modal-{{ $report->id }}')" class="btn btn-primary text-xs h-10 px-3 sm:px-4 shadow-green-500/10 justify-center">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ __('Verifikasi') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <div class="w-20 h-20 mx-auto rounded-[2rem] bg-slate-50 dark:bg-slate-800/50 flex items-center justify-center text-slate-200 dark:text-slate-700 mb-4 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-black text-slate-400">{{ __('Tidak Ada Laporan Menunggu Verifikasi') }}</h3>
                    <p class="text-sm text-slate-400 mt-2">{{ __('Semua laporan sudah diverifikasi.') }}</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $reports->withQueryString()->links() }}
        </div>
    </div>

    {{-- Approve Modals --}}
    @foreach($reports as $report)
        <div x-data="{ open: false }" x-on:open-finance-modal-{{ $report->id }}.window="open = true" x-show="open" x-cloak class="fixed inset-0 z-[100] overflow-y-auto" x-transition.opacity>
            <div class="flex items-center justify-center min-h-screen px-3 sm:px-4 py-4">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>
                <div class="relative bg-white dark:bg-slate-800 rounded-2xl sm:rounded-3xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto" @click.outside="open = false">
                    <div class="p-5 sm:p-6 md:p-8">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-green-100 dark:bg-green-500/20 flex items-center justify-center text-green-600 dark:text-green-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-black text-slate-800 dark:text-white">{{ __('Verifikasi Laporan Finance') }}</h3>
                        <p class="text-xs sm:text-sm text-slate-500 mt-2 break-words">{{ $report->asrama->nama_asrama }} — {{ \Carbon\Carbon::create()->month($report->bulan)->locale('id')->isoFormat('MMMM') }} {{ $report->tahun }}</p>
                    </div>

                    <div class="bg-slate-50 dark:bg-slate-700/30 rounded-2xl p-4 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-slate-500">{{ __('Total Pengeluaran') }}</span>
                            <span class="text-sm font-black text-green-600">Rp {{ number_format($report->total_pengeluaran, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-slate-500">{{ __('Total Reimbursement') }}</span>
                            <span class="text-sm font-black text-amber-600">Rp {{ number_format($report->total_reimbursement, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-slate-200 dark:border-slate-600 pt-2 mt-2 flex justify-between items-center">
                            <span class="text-xs font-black text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('Grand Total') }}</span>
                            <span class="text-lg font-black text-slate-800 dark:text-white">Rp {{ number_format($report->total_pengeluaran + $report->total_reimbursement, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Approve with notes --}}
                    <form method="POST" action="{{ route('approval.finance.approve', $report) }}">
                        @csrf
                        <div class="mb-5">
                            <label class="form-label text-xs">{{ __('Catatan (opsional)') }}</label>
                            <textarea name="finance_notes" rows="2" class="form-input-modern w-full mt-1 text-xs" placeholder="{{ __('Tambahkan catatan verifikasi...') }}"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-full h-12 shadow-green-500/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ __('Setujui Laporan Ini') }}
                        </button>
                    </form>

                    {{-- Reject form --}}
                    <form method="POST" action="{{ route('approval.reject', $report) }}" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-xs text-red-500">{{ __('Atau tolak dengan alasan') }}</label>
                            <textarea name="rejection_reason" rows="2" class="form-input-modern w-full mt-1 text-xs border-red-200 focus:border-red-500" placeholder="{{ __('Alasan penolakan...') }}" required></textarea>
                        </div>
                        <button type="submit" class="w-full h-10 text-xs font-bold text-red-500 hover:text-white hover:bg-red-500 border border-red-200 hover:border-red-500 rounded-2xl transition-all"
                            onclick="return confirm('{{ __('Yakin ingin menolak laporan ini?') }}')">
                            {{ __('Tolak Laporan') }}
                        </button>
                    </form>

                    </div>

                    <button @click="open = false" class="absolute top-3 right-3 sm:top-4 sm:right-4 p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all z-10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
