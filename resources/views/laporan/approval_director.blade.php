<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Approval Laporan - Direktur') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        {{-- Hero --}}
        <div class="relative mb-8 animate-fade-in">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div>
                    <h1 class="text-3xl md:text-5xl font-black text-slate-800 dark:text-white tracking-tight leading-tight">
                        {{ __('Approval Laporan') }}<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400">{{ __('Direktur') }}</span>
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mt-2">{{ __('Berikan persetujuan akhir untuk laporan yang sudah diverifikasi Finance') }}</p>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="glass-card mb-6 animate-fade-in-up delay-75">
            <div class="p-4">
                <form method="GET" action="{{ route('approval.director.index') }}" class="flex flex-wrap items-center gap-3">
                    <div class="relative flex-1 min-w-[200px]">
                        <select name="asrama_id" class="form-input-modern text-xs py-2.5">
                            <option value="">{{ __('Semua Asrama') }}</option>
                            @foreach($asramas as $asrama)
                                <option value="{{ $asrama->id }}" {{ request('asrama_id') == $asrama->id ? 'selected' : '' }}>{{ $asrama->kode_asrama }} - {{ $asrama->nama_asrama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-xs h-10 px-5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('approval.director.index') }}" class="text-xs font-medium text-slate-400 hover:text-slate-600 transition-colors">{{ __('Reset') }}</a>
                </form>
            </div>
        </div>

        {{-- Reports --}}
        <div class="space-y-6 animate-fade-in-up delay-150">
            @forelse($reports as $report)
                <div class="content-card overflow-hidden group hover:shadow-lg hover:shadow-emerald-500/5 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/20 flex-shrink-0">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-lg font-black text-slate-800 dark:text-white">{{ $report->asrama->nama_asrama }}</h3>
                                        <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-[10px] font-black rounded-md">{{ $report->asrama->kode_asrama }}</span>
                                    </div>
                                    <p class="text-sm font-medium text-slate-500 mt-1">
                                        {{ __('Periode') }}: <span class="font-bold">{{ \Carbon\Carbon::create()->month($report->bulan)->locale('id')->isoFormat('MMMM') }} {{ $report->tahun }}</span>
                                    </p>
                                    <div class="flex items-center gap-4 mt-2">
                                        <span class="text-xs text-slate-400">
                                            {{ __('Pengeluaran') }}: <span class="font-bold text-green-600 dark:text-green-400">Rp {{ number_format($report->total_pengeluaran, 0, ',', '.') }}</span>
                                        </span>
                                        <span class="text-xs text-slate-400">
                                            {{ __('Reimbursement') }}: <span class="font-bold text-amber-600 dark:text-amber-400">Rp {{ number_format($report->total_reimbursement, 0, ',', '.') }}</span>
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 mt-2">
                                        @if($report->submitter)
                                            <p class="text-[10px] text-slate-400">
                                                {{ __('Diajukan') }}: <span class="font-bold">{{ $report->submitter->name }}</span>
                                            </p>
                                        @endif
                                        @if($report->financeApprover)
                                            <p class="text-[10px] text-blue-500">
                                                {{ __('Diverifikasi Finance') }}: <span class="font-bold">{{ $report->financeApprover->name }}</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="{{ route('laporan.show', $report) }}" class="btn btn-secondary text-xs h-10 px-4">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    {{ __('Detail') }}
                                </a>
                                <button @click="$dispatch('open-director-modal-{{ $report->id }}')" class="btn btn-primary text-xs h-10 px-4 shadow-emerald-500/10 !bg-emerald-600 hover:!bg-emerald-700">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ __('Approval') }}
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
                    <h3 class="text-lg font-black text-slate-400">{{ __('Tidak Ada Laporan Menunggu Approval') }}</h3>
                    <p class="text-sm text-slate-400 mt-2">{{ __('Semua laporan sudah mendapat approval Direktur.') }}</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $reports->withQueryString()->links() }}
        </div>
    </div>

    {{-- Approve Modals --}}
    @foreach($reports as $report)
        <div x-data="{ open: false }" x-on:open-director-modal-{{ $report->id }}.window="open = true" x-show="open" x-cloak class="fixed inset-0 z-[100] overflow-y-auto" x-transition.opacity>
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>
                <div class="relative bg-white dark:bg-slate-800 rounded-3xl shadow-2xl max-w-lg w-full p-8" @click.outside="open = false">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 dark:text-white">{{ __('Approval Direktur') }}</h3>
                        <p class="text-sm text-slate-500 mt-2">{{ $report->asrama->nama_asrama }} — {{ \Carbon\Carbon::create()->month($report->bulan)->locale('id')->isoFormat('MMMM') }} {{ $report->tahun }}</p>
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
                        @if($report->finance_notes)
                            <div class="mt-4 p-3 rounded-xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20">
                                <p class="text-[10px] font-black uppercase tracking-wider text-blue-500 mb-1">{{ __('Catatan Finance') }}</p>
                                <p class="text-sm text-blue-700 dark:text-blue-300 italic">"{{ $report->finance_notes }}"</p>
                            </div>
                        @endif
                    </div>

                    {{-- Approve with notes --}}
                    <form method="POST" action="{{ route('approval.director.approve', $report) }}">
                        @csrf
                        <div class="mb-5">
                            <label class="form-label text-xs">{{ __('Catatan (opsional)') }}</label>
                            <textarea name="director_notes" rows="2" class="form-input-modern w-full mt-1 text-xs" placeholder="{{ __('Tambahkan catatan persetujuan...') }}"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-full h-12 shadow-emerald-500/10 !bg-emerald-600 hover:!bg-emerald-700">
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

                    <button @click="open = false" class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
