<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('children.index') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Children Data') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Add New') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-10 text-center md:text-left flex flex-col md:flex-row md:items-end justify-between gap-4 animate-fade-in">
            <div>
                <h1 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('New Child Registration') }}</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 font-medium italic">{{ __('Enter the details to register a new member to the foundation.') }}</p>
            </div>
            <div class="hidden md:block">
                <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 bg-slate-100 dark:bg-slate-800/50 px-4 py-2 rounded-full border border-slate-200 dark:border-slate-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ __('Registration System Online') }}
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden !rounded-[2.5rem] !bg-white/80 dark:!bg-slate-900/80 border-white/40 dark:border-slate-800/50 shadow-premium">
            @if ($errors->any())
                <div class="m-8 flex items-start gap-4 text-rose-700 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 border border-slate-100 dark:border-rose-500/20 p-6 rounded-[2rem] animate-shake">
                    <div class="w-10 h-10 rounded-2xl bg-rose-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black mb-2 uppercase tracking-widest">{{ __('Registration Errors') }}</p>
                        <ul class="list-disc pl-5 text-xs font-bold space-y-1 opacity-80 uppercase tracking-widest">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('children.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Section 1: Biological Identity --}}
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 bg-slate-50/50 dark:bg-slate-800/20 animate-fade-in-up">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box indigo !w-12 !h-12 !rounded-2xl shadow-lg shadow-indigo-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Biological Identity') }}</h3>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Core Personal Records') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-2">
                        <div class="md:col-span-2">
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Full Name') }}</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required placeholder="Ex: Muhammad Al-Fatih">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Gender') }}</label>
                            <select name="gender" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Category') }}</label>
                            <select name="category" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required>
                                <option value="fatherless" {{ old('category') == 'fatherless' ? 'selected' : '' }}>{{ __('Fatherless (Yatim)') }}</option>
                                <option value="motherless" {{ old('category') == 'motherless' ? 'selected' : '' }}>{{ __('Motherless (Piatu)') }}</option>
                                <option value="orphan" {{ old('category') == 'orphan' ? 'selected' : '' }}>{{ __('Orphan (Yatim Piatu)') }}</option>
                                <option value="underprivileged" {{ old('category') == 'underprivileged' ? 'selected' : '' }}>{{ __('Underprivileged (Dhuafa)') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Place of Birth') }}</label>
                            <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required placeholder="Ex: Jakarta">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Date of Birth') }}</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Family & Identity --}}
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 animate-fade-in-up delay-75">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box sky !w-12 !h-12 !rounded-2xl shadow-lg shadow-sky-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Family & Identity') }}</h3>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Legal & Guardianship Records') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-2">
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('NIK') }}</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="16-digit NIK">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Family Card Number (KK)') }}</label>
                            <input type="text" name="no_kk" value="{{ old('no_kk') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="16-digit KK Number">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Father\'s Name') }}</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="{{ __('Full Name') }}">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Mother\'s Name') }}</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="{{ __('Full Name') }}">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Parent/Guardian Phone') }}</label>
                            <input type="text" name="parent_phone_number" value="{{ old('parent_phone_number') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="Ex: 08123456789">
                        </div>
                        <div class="md:col-span-2">
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Full Address') }}</label>
                            <textarea name="address" rows="3" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="{{ __('Complete address based on KK/KTP') }}">{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Education --}}
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 bg-slate-50/50 dark:bg-slate-800/20 animate-fade-in-up delay-100">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box violet !w-12 !h-12 !rounded-2xl shadow-lg shadow-violet-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4 2.222"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Education Details') }}</h3>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Academic Information') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pb-2">
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Education Level') }}</label>
                            <select name="education_level" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20">
                                <option value="BS" {{ old('education_level') == 'BS' ? 'selected' : '' }}>{{ __('Belum Sekolah (BS)') }}</option>
                                <option value="TK" {{ old('education_level') == 'TK' ? 'selected' : '' }}>{{ __('TK') }}</option>
                                <option value="SD" {{ old('education_level') == 'SD' ? 'selected' : '' }}>{{ __('SD/MI') }}</option>
                                <option value="SMP" {{ old('education_level') == 'SMP' ? 'selected' : '' }}>{{ __('SMP/MTs') }}</option>
                                <option value="SMA" {{ old('education_level') == 'SMA' ? 'selected' : '' }}>{{ __('SMA/SMK/MA') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Class Level') }}</label>
                            <input type="text" name="class_level" value="{{ old('class_level') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="1-12 / -">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Economic Grade') }}</label>
                            <select name="grade" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20">
                                <option value="A" {{ old('grade') == 'A' ? 'selected' : '' }}>{{ __('Grade A') }}</option>
                                <option value="B" {{ old('grade') == 'B' ? 'selected' : '' }}>{{ __('Grade B') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Section 4: Administrative Details --}}
                <div class="p-8 border-b border-slate-100 dark:border-slate-800/50 animate-fade-in-up delay-[125ms]">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="icon-box emerald !w-12 !h-12 !rounded-2xl shadow-lg shadow-emerald-500/10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Administrative Records') }}</h3>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Placement & Admission') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-2">
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Asrama Facility') }}</label>
                            <select name="asrama_id" id="asrama_id" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required>
                                <option value="">-- {{ __('Select Facility') }} --</option>
                                @foreach($asramas as $asrama)
                                    <option value="{{ $asrama->id }}" {{ old('asrama_id') == $asrama->id ? 'selected' : '' }}>
                                        {{ $asrama->kode_asrama }} – {{ $asrama->nama_asrama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Registration Number') }}</label>
                            <div class="relative">
                                <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number') }}" class="form-input-modern !rounded-2xl bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 font-mono text-xs font-black tracking-widest text-indigo-600 dark:text-indigo-400" required readonly placeholder="{{ __('Auto-generated') }}">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <svg class="w-3.5 h-3.5 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Recommended By') }}</label>
                            <input type="text" name="recommended_by" value="{{ old('recommended_by') }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" placeholder="{{ __('Name of Recommender') }}">
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Enrollment Status') }}</label>
                            <select name="enrollment_status" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required>
                                <option value="active" {{ old('enrollment_status') == 'active' ? 'selected' : '' }}>{{ __('Active Membership') }}</option>
                                <option value="graduated" {{ old('enrollment_status') == 'graduated' ? 'selected' : '' }}>{{ __('Graduated') }}</option>
                                <option value="withdrawn" {{ old('enrollment_status') == 'withdrawn' ? 'selected' : '' }}>{{ __('Withdrawn') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern !text-[10px] !font-black !uppercase !tracking-[0.2em] !text-slate-400 mb-2">{{ __('Admission Date') }}</label>
                            <input type="date" name="admission_date" value="{{ old('admission_date', date('Y-m-d')) }}" class="form-input-modern !rounded-2xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 focus:!ring-indigo-500/20" required>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Official Documents --}}
                <div class="p-8 bg-slate-50/30 dark:bg-slate-800/10 animate-fade-in-up delay-150">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="icon-box amber !w-12 !h-12 !rounded-2xl shadow-lg shadow-amber-500/10">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">{{ __('Document Vault') }}</h3>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ __('Legal Attachments & Identity') }}</p>
                            </div>
                        </div>
                    </div>

                    <div id="documents-container" class="space-y-4">
                        <div class="group flex flex-col sm:flex-row items-start sm:items-center gap-4 p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all">
                            <div class="w-full sm:w-1/3">
                                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1 block">{{ __('Document Type') }}</label>
                                <select name="documents[0][type]" class="form-input-modern !rounded-xl !py-2 !text-xs font-bold border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50">
                                    <option value="profile_photo">{{ __('Profile Photo') }}</option>
                                    <option value="birth_certificate">{{ __('Birth Certificate') }}</option>
                                    <option value="family_card">{{ __('Family Card (KK)') }}</option>
                                    <option value="guardian_id">{{ __('Guardian ID (KTP)') }}</option>
                                </select>
                            </div>
                            <div class="flex-1 w-full">
                                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1 block">{{ __('Select File') }}</label>
                                <input type="file" name="documents[0][file]" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 transition-all cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addDocField()" class="mt-6 inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition-all bg-indigo-50 dark:bg-indigo-500/5 px-6 py-3 rounded-2xl border border-indigo-100 dark:border-indigo-500/20 group hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                        {{ __('Add Attachment') }}
                    </button>
                </div>

                <div class="p-8 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30 border-t border-slate-100 dark:border-slate-800/50 animate-fade-in-up delay-225">
                    <a href="{{ route('children.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-slate-600 transition-colors">{{ __('Discard Registration') }}</a>
                    <button type="submit" class="btn btn-primary !rounded-2xl px-10 !py-4 !bg-indigo-600 hover:!bg-indigo-700 shadow-xl shadow-indigo-500/20 flex items-center gap-3">
                        <span class="font-black uppercase tracking-widest text-xs">{{ __('Confirm Registration') }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let docCount = 1;
        function addDocField() {
            const container = document.getElementById('documents-container');
            const newField = document.createElement('div');
            newField.className = 'group flex flex-col sm:flex-row items-start sm:items-center gap-4 p-5 rounded-3xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all animate-fade-in-up';
            newField.innerHTML = `
                <div class="w-full sm:w-1/3">
                    <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1 block">{{ __('Document Type') }}</label>
                    <select name="documents[${docCount}][type]" class="form-input-modern !rounded-xl !py-2 !text-xs font-bold border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50">
                        <option value="profile_photo">{{ __('Profile Photo') }}</option>
                        <option value="birth_certificate">{{ __('Birth Certificate') }}</option>
                        <option value="family_card">{{ __('Family Card (KK)') }}</option>
                        <option value="guardian_id">{{ __('Guardian ID (KTP)') }}</option>
                    </select>
                </div>
                <div class="flex-1 w-full relative">
                    <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1 block">{{ __('Select File') }}</label>
                    <input type="file" name="documents[${docCount}][file]" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-600 dark:file:text-indigo-400 hover:file:bg-indigo-100 transition-all cursor-pointer">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="absolute -top-1 -right-1 p-1.5 bg-rose-50 dark:bg-rose-500/10 text-rose-500 rounded-full opacity-0 group-hover:opacity-100 transition-all hover:scale-110">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `;
            container.appendChild(newField);
            docCount++;
        }

        document.getElementById('asrama_id').addEventListener('change', function() {
            const asramaId = this.value;
            const regInput = document.getElementById('registration_number');
            
            if (!asramaId) {
                regInput.value = '';
                regInput.placeholder = "{{ __('Select Asrama first...') }}";
                return;
            }

            regInput.placeholder = "{{ __('Generating...') }}";
            
            fetch(`{{ route('children.generate_registration_number') }}?asrama_id=${asramaId}`)
                .then(response => response.json())
                .then(data => {
                    regInput.value = data.registration_number;
                })
                .catch(error => {
                    console.error('Error:', error);
                    regInput.placeholder = "{{ __('Error generating ID') }}";
                });
        });
    </script>
</x-app-layout>
