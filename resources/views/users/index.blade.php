<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
            <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition-colors">{{ __('Dashboard') }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Manage Users') }}</span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 animate-fade-in">
            <div>
                <h1 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('User & Role Management') }}</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium">{{ __('Control system access and assign administrative roles.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Create New User') }}
                </a>
            </div>
        </div>

        {{-- Stats Overview --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 animate-fade-in-up">
            <div class="glass-card !p-6 flex items-center gap-4">
                <div class="icon-box indigo !w-12 !h-12 !rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">{{ __('Total Accounts') }}</p>
                    <p class="text-2xl font-black text-slate-800 dark:text-white">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
            <div class="glass-card !p-6 flex items-center gap-4">
                <div class="icon-box purple !w-12 !h-12 !rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">{{ __('Administrators') }}</p>
                    <p class="text-2xl font-black text-slate-800 dark:text-white">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                </div>
            </div>
            <div class="glass-card !p-6 flex items-center gap-4">
                <div class="icon-box blue !w-12 !h-12 !rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">{{ __('Staff Members') }}</p>
                    <p class="text-2xl font-black text-slate-800 dark:text-white">{{ \App\Models\User::where('role', 'user')->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Users Table --}}
        <div class="glass-card overflow-hidden shadow-premium animate-fade-in-up delay-150">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('User Information') }}</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Role Assignment') }}</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">{{ __('Verified') }}</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                        @foreach ($users as $u)
                            <tr class="group hover:bg-slate-50/30 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-white text-sm shadow-md shadow-indigo-500/10">
                                            {{ substr($u->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-800 dark:text-white group-hover:text-indigo-600 transition-colors">{{ $u->name }}</p>
                                            <p class="text-xs text-slate-400 font-medium">{{ $u->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($u->role === 'admin')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-indigo-500/10 text-indigo-500 text-[10px] font-black uppercase tracking-widest ring-1 ring-inset ring-indigo-500/20">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                            {{ __('Administrator') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-500/10 text-slate-500 text-[10px] font-black uppercase tracking-widest ring-1 ring-inset ring-slate-500/20">
                                            {{ __('Staff Member') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($u->email_verified_at)
                                        <span class="text-emerald-500 bg-emerald-500/10 p-1.5 rounded-full inline-block">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </span>
                                    @else
                                        <span class="text-slate-300 dark:text-slate-600">
                                            <svg class="w-4 h-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                        <a href="{{ route('users.edit', $u) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 rounded-xl transition-all" title="{{ __('Edit User') }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        @if(auth()->id() !== $u->id)
                                            <form action="{{ route('users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to remove this user?') }}')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-xl transition-all" title="{{ __('Delete User') }}">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="px-8 py-5 border-t border-slate-100 dark:border-slate-800/50 bg-slate-50/30 dark:bg-slate-800/30">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
