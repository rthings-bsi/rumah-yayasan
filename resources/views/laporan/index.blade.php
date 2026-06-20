<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Laporan Keuangan Asrama') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto" x-data="{ filterOpen: false }">
        {{-- Hero --}}
        <div class="relative mb-8 animate-fade-in">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div>
                    <h1 class="text-3xl md:text-5xl font-black text-slate-800 dark:text-white tracking-tight leading-tight">
                        {{ __('Laporan Keuangan') }}<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400">{{ __('Asrama') }}</span>
                    </h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium mt-2">{{ __('Kelola laporan pengeluaran dan reimbursement bulanan asrama') }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('laporan.create') }}" class="btn btn-primary shadow-green-500/10 h-12">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        {{ __('Buat Laporan Baru') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="glass-card mb-6 animate-fade-in-up delay-75">
            <div class="p-4 flex flex-wrap items-center gap-4">
                <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-center gap-3 w-full">
                    <div class="relative flex-1 min-w-[200px]">
                        <select name="asrama_id" class="form-input-modern text-xs py-2.5">
                            <option value="">{{ __('Semua Asrama') }}</option>
                            @foreach($asramas as $asrama)
                                <option value="{{ $asrama->id }}" {{ request('asrama_id') == $asrama->id ? 'selected' : '' }}>{{ $asrama->kode_asrama }} - {{ $asrama->nama_asrama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative w-32">
                        <select name="bulan" class="form-input-modern text-xs py-2.5">
                            <option value="">{{ __('Bulan') }}</option>
                            @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $nama)
                                <option value="{{ $i + 1 }}" {{ request('bulan') == $i + 1 ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative w-28">
                        <select name="tahun" class="form-input-modern text-xs py-2.5">
                            <option value="">{{ __('Tahun') }}</option>
                            @for($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="relative w-44">
                        <select name="status" class="form-input-modern text-xs py-2.5">
                            <option value="">{{ __('Semua Status') }}</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Finance</option>
                            <option value="finance_approved" {{ request('status') == 'finance_approved' ? 'selected' : '' }}>Disetujui Finance</option>
                            <option value="director_approved" {{ request('status') == 'director_approved' ? 'selected' : '' }}>Disetujui Direktur</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary text-xs h-10 px-5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('laporan.index') }}" class="text-xs font-medium text-slate-400 hover:text-slate-600 transition-colors">{{ __('Reset') }}</a>
                </form>
            </div>
        </div>

        {{-- Reports Table --}}
        <div class="content-card overflow-hidden animate-fade-in-up delay-150">
            <div class="content-card-header flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-700 shadow-sm flex items-center justify-center text-green-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="section-title text-base">{{ __('Daftar Laporan') }}</h3>
                </div>
                <span class="text-xs font-bold text-slate-400">{{ $reports->total() }} {{ __('laporan') }}</span>
            </div>

            <div class="content-card-body p-0">
                @if($reports->isEmpty())
                    <div class="text-center py-20">
                        <div class="w-16 h-16 rounded-2xl bg-slate-50 dark:bg-slate-700/50 flex items-center justify-center mx-auto mb-4 border border-slate-100 dark:border-slate-700">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-medium">{{ __('Belum ada laporan keuangan.') }}</p>
                        <a href="{{ route('laporan.create') }}" class="text-sm text-green-600 hover:text-green-700 font-semibold mt-2 inline-block">{{ __('Buat laporan baru') }}</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th class="pl-8">{{ __('Asrama') }}</th>
                                    <th>{{ __('Periode') }}</th>
                                    <th>{{ __('Total Pengeluaran') }}</th>
                                    <th>{{ __('Total Reimbursement') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Dibuat') }}</th>
                                    <th class="pr-8 text-right">{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)
                                    <tr class="hover:bg-green-50/30 dark:hover:bg-green-500/5 transition-colors group">
                                        <td class="pl-8">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white text-xs font-black">
                                                    {{ substr($report->asrama->kode_asrama, 0, 2) }}
                                                </div>
                                                <div>
                                                    <span class="font-bold text-slate-700 dark:text-slate-200 group-hover:text-green-600 transition-colors text-xs">{{ $report->asrama->nama_asrama }}</span>
                                                    <span class="text-[10px] font-medium text-slate-400 block">{{ $report->asrama->kode_asrama }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="font-bold text-slate-700 dark:text-slate-200 text-xs">
                                                {{ \Carbon\Carbon::create()->month($report->bulan)->locale('id')->isoFormat('MMMM') }} {{ $report->tahun }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="font-bold text-slate-800 dark:text-slate-100 text-xs">Rp {{ number_format($report->total_pengeluaran, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <span class="font-bold text-amber-600 dark:text-amber-400 text-xs">Rp {{ number_format($report->total_reimbursement, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $report->status_badge }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $report->status === 'draft' ? 'bg-slate-400' : ($report->status === 'pending' ? 'bg-amber-500' : ($report->status === 'finance_approved' ? 'bg-blue-500' : ($report->status === 'director_approved' ? 'bg-emerald-500' : 'bg-red-500'))) }}"></span>
                                                {{ $report->status_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-[10px] font-medium text-slate-400">{{ $report->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="pr-8 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('laporan.show', $report) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-green-500 hover:text-green-700 transition-colors px-3 py-1.5 rounded-lg hover:bg-green-50 dark:hover:bg-green-500/10">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    <span>{{ __('Detail') }}</span>
                                                </a>
                                                @if($report->status === 'draft')
                                                    <a href="{{ route('laporan.edit', $report) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-500 hover:text-amber-700 transition-colors px-3 py-1.5 rounded-lg hover:bg-amber-50 dark:hover:bg-amber-500/10">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                        <span>{{ __('Edit') }}</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 border-t border-slate-50 dark:border-white/5">
                        {{ $reports->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
