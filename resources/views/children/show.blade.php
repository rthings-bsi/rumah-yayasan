<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('children.index') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Children Data') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Detail') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ $child->full_name }}</h1>
                <div class="flex items-center gap-3 mt-2">
                    <span class="font-mono text-xs bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2.5 py-1 rounded-lg">{{ $child->registration_number }}</span>
                    <span class="badge 
                        {{ $child->enrollment_status == 'active' ? 'badge-active' : '' }}
                        {{ $child->enrollment_status == 'graduated' ? 'badge-graduated' : '' }}
                        {{ $child->enrollment_status == 'withdrawn' ? 'badge-withdrawn' : '' }}">
                        <span class="dot"></span>
                        {{ ucfirst($child->enrollment_status) }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('children.pdf', $child) }}" target="_blank" class="btn btn-danger">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    {{ __('Export PDF') }}
                </a>
                <a href="{{ route('children.index') }}" class="btn btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    {{ __('Back') }}
                </a>
            </div>
        </div>

        {{-- General Information --}}
        <div class="content-card mb-6">
            <div class="content-card-header">
                <div class="icon-box indigo">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h3 class="section-title">{{ __('General Information') }}</h3>
            </div>
            <div class="content-card-body">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Registration Number') }}</span>
                        <span class="info-item-value font-mono">{{ $child->registration_number }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Full Name') }}</span>
                        <span class="info-item-value">{{ $child->full_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Place of Birth') }}</span>
                        <span class="info-item-value">{{ $child->place_of_birth }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Date of Birth') }}</span>
                        <span class="info-item-value">{{ $child->date_of_birth }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Gender') }}</span>
                        <span class="info-item-value capitalize">{{ $child->gender }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Category') }}</span>
                        <span class="info-item-value capitalize">{{ $child->category }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Status') }}</span>
                        <span class="info-item-value capitalize">{{ $child->enrollment_status }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-item-label">{{ __('Admission Date') }}</span>
                        <span class="info-item-value">{{ $child->admission_date }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Attached Documents --}}
        <div class="content-card">
            <div class="content-card-header">
                <div class="icon-box amber">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                </div>
                <h3 class="section-title">{{ __('Attached Documents') }}</h3>
            </div>
            <div class="content-card-body">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($child->documents as $doc)
                        <div class="group relative rounded-xl border border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 overflow-hidden hover:border-slate-200 dark:hover:border-slate-600 hover:shadow-md transition-all duration-300">
                            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700 bg-white dark:bg-slate-800">
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200 capitalize">{{ str_replace('_', ' ', $doc->document_type) }}</span>
                            </div>
                            <div class="p-4 flex justify-center items-center min-h-[140px]">
                                @if(in_array(pathinfo($doc->file_path, PATHINFO_EXTENSION), ['jpg','jpeg','png']))
                                    <img src="{{ asset('storage/'.$doc->file_path) }}" alt="{{ $doc->document_type }}" 
                                         class="max-w-full h-auto rounded-lg max-h-40 object-cover shadow-sm group-hover:scale-[1.02] transition-transform duration-300">
                                @elseif(pathinfo($doc->file_path, PATHINFO_EXTENSION) === 'pdf')
                                    <div class="flex flex-col items-center gap-2 py-4">
                                        <div class="w-14 h-14 rounded-xl bg-rose-50 dark:bg-rose-500/10 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"></path></svg>
                                        </div>
                                        <span class="text-xs text-slate-400">{{ __('PDF Document') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="px-4 pb-4">
                                <a href="{{ asset('storage/'.$doc->file_path) }}" target="_blank" 
                                   class="btn btn-secondary w-full justify-center text-xs py-2">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    {{ __('View File') }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="flex flex-col items-center gap-3 py-12">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                </div>
                                <p class="text-sm font-medium text-slate-400">{{ __('No documents have been attached.') }}</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
