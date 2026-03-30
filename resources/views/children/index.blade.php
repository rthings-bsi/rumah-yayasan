<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 dark:text-slate-100 leading-tight">
            {{ __('Children Data') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ __('Children Management') }}</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ __('Manage and track all children data records.') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('children.export', ['search' => request('search')]) }}" class="btn btn-success">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Export Excel') }}
                </a>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('children.create') }}" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Add Data') }}
                </a>
                @endif
            </div>
        </div>

        {{-- Content Card --}}
        <div class="content-card">
            {{-- Search --}}
            <div class="content-card-body border-b border-slate-100 dark:border-slate-700">
                <form method="GET" action="{{ route('children.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search by name or reg number...') }}" 
                               class="form-input-modern pl-10 py-2.5">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary py-2.5">
                            {{ __('Search') }}
                        </button>
                        @if(request('search'))
                            <a href="{{ route('children.index') }}" class="btn btn-secondary py-2.5">
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mx-6 mt-4 flex items-center gap-3 text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 p-4 rounded-xl">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Table --}}
            <div class="p-6">
                <div class="overflow-x-auto rounded-xl border border-slate-100 dark:border-slate-700">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>{{ __('Reg. Number') }}</th>
                                <th>{{ __('Full Name') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th class="text-right">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($children as $child)
                                <tr>
                                    <td>
                                        <span class="font-mono text-xs bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-1 rounded-lg">{{ $child->registration_number }}</span>
                                    </td>
                                    <td>
                                        <span class="font-semibold text-slate-800 dark:text-slate-100">{{ $child->full_name }}</span>
                                    </td>
                                    <td>
                                        <span class="capitalize text-sm">{{ $child->category }}</span>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            {{ $child->enrollment_status == 'active' ? 'badge-active' : '' }}
                                            {{ $child->enrollment_status == 'graduated' ? 'badge-graduated' : '' }}
                                            {{ $child->enrollment_status == 'withdrawn' ? 'badge-withdrawn' : '' }}">
                                            <span class="dot"></span>
                                            {{ ucfirst($child->enrollment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('children.show', $child) }}" class="p-2 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-lg transition-all duration-200" title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            @if(auth()->user()->role === 'admin')
                                                <a href="{{ route('children.edit', $child) }}" class="p-2 text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-lg transition-all duration-200" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('children.destroy', $child) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-lg transition-all duration-200" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            </div>
                                            <p class="text-sm font-medium text-slate-400">{{ __('No children found.') }}</p>
                                            <p class="text-xs text-slate-400">{{ __('Try adjusting your search or add new data.') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-5">
                    {{ $children->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
