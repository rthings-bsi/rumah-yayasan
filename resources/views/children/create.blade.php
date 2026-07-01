<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('children.index') }}"
                class="hover:opacity-80 transition-colors" style="color: #7a877a;">{{ __('Children Data') }}</a>
            <i data-lucide="chevron-right" class="w-4 h-4" style="color: #d6e0d6;"></i>
            <span class="font-semibold" style="color: #2b4c30;">{{ __('Add New') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12 px-4 sm:px-6 lg:px-8" style="background-color: #f4f1ed; min-height: 100%;">
        <div class="mb-8 text-center md:text-left flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight" style="color: #2b4c30;">
                    {{ __('New Child Registration') }}</h1>
                <p class="text-sm mt-2 font-medium" style="color: #7a877a;">
                    {{ __('Enter the details to register a new member to the foundation.') }}</p>
            </div>
            <div class="hidden md:block">
                <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.375rem 0.75rem; background-color: #eef3ee; border: 1px solid #d6e0d6; border-radius: 9999px; font-size: 0.625rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.15em; color: #2b4c30;">
                    <span style="width: 0.5rem; height: 0.5rem; border-radius: 50%; background-color: #2b4c30;"></span>
                    {{ __('Registration System Online') }}
                </div>
            </div>
        </div>

        <div style="background: #ffffff; border: 1px solid #e8eae8; border-radius: 16px; overflow: hidden;">
            @if ($errors->any())
                <div class="m-6 p-4 rounded-lg flex items-start gap-3" style="background-color: #fdf2f2; border: 1px solid #f5c6cb;">
                    <div style="width: 2rem; height: 2rem; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background-color: #f5c6cb;">
                        <i data-lucide="alert-circle" class="w-5 h-5" style="color: #c0392b;"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold mb-1" style="color: #c0392b; text-transform: uppercase; letter-spacing: 0.05em;">{{ __('Registration Errors') }}</p>
                        <ul class="list-disc pl-5 text-xs font-medium" style="color: #7a877a;">
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
                <div style="padding: 1.5rem; border-bottom: 1px solid #e8eae8;">
                    <div class="flex items-center gap-3 mb-6">
                        <div style="width: 2.5rem; height: 2.5rem; border-radius: 10px; display: flex; align-items: center; justify-content: center; background-color: #eef3ee; color: #2b4c30;">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold" style="color: #2b4c30;">{{ __('Biological Identity') }}</h3>
                            <p class="text-xs font-semibold uppercase tracking-widest" style="color: #7a877a;">{{ __('Core Personal Records') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Full Name') }}</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required placeholder="Ex: Muhammad Al-Fatih">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Gender') }}</label>
                            <select name="gender"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}
                                </option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                    {{ __('Female') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Category') }}</label>
                            <select name="category"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required>
                                <option value="fatherless" {{ old('category') == 'fatherless' ? 'selected' : '' }}>{{ __('fatherless') }}</option>
                                <option value="motherless" {{ old('category') == 'motherless' ? 'selected' : '' }}>{{ __('motherless') }}</option>
                                <option value="orphan" {{ old('category') == 'orphan' ? 'selected' : '' }}>{{ __('orphan') }}</option>
                                <option value="underprivileged" {{ old('category') == 'underprivileged' ? 'selected' : '' }}>{{ __('underprivileged') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Place of Birth') }}</label>
                            <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required placeholder="Ex: Jakarta">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Date of Birth') }}</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Family & Identity --}}
                <div style="padding: 1.5rem; border-bottom: 1px solid #e8eae8;">
                    <div class="flex items-center gap-3 mb-6">
                        <div style="width: 2.5rem; height: 2.5rem; border-radius: 10px; display: flex; align-items: center; justify-content: center; background-color: #eef3ee; color: #2b4c30;">
                            <i data-lucide="users" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold" style="color: #2b4c30;">{{ __('Family & Identity') }}</h3>
                            <p class="text-xs font-semibold uppercase tracking-widest" style="color: #7a877a;">{{ __('Legal & Guardianship Records') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('NIK') }}</label>
                            <input type="text" name="nik" value="{{ old('nik') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="16-digit NIK">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Family Card Number (KK)') }}</label>
                            <input type="text" name="no_kk" value="{{ old('no_kk') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="16-digit KK Number">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Father\'s Name') }}</label>
                            <input type="text" name="father_name" value="{{ old('father_name') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="{{ __('Full Name') }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Mother\'s Name') }}</label>
                            <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="{{ __('Full Name') }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Parent/Guardian Phone') }}</label>
                            <input type="text" name="parent_phone_number" value="{{ old('parent_phone_number') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="Ex: 08123456789">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Full Address') }}</label>
                            <textarea name="address" rows="3" 
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="{{ __('Complete address based on KK/KTP') }}">{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Education --}}
                <div style="padding: 1.5rem; border-bottom: 1px solid #e8eae8;">
                    <div class="flex items-center gap-3 mb-6">
                        <div style="width: 2.5rem; height: 2.5rem; border-radius: 10px; display: flex; align-items: center; justify-content: center; background-color: #eef3ee; color: #2b4c30;">
                            <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold" style="color: #2b4c30;">{{ __('Education Details') }}</h3>
                            <p class="text-xs font-semibold uppercase tracking-widest" style="color: #7a877a;">{{ __('Academic Information') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Education Level') }}</label>
                            <select name="education_level"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;">
                                <option value="BS" {{ old('education_level') == 'BS' ? 'selected' : '' }}>{{ __('Belum Sekolah (BS)') }}</option>
                                <option value="TK" {{ old('education_level') == 'TK' ? 'selected' : '' }}>{{ __('TK') }}</option>
                                <option value="SD" {{ old('education_level') == 'SD' ? 'selected' : '' }}>{{ __('SD/MI') }}</option>
                                <option value="SMP" {{ old('education_level') == 'SMP' ? 'selected' : '' }}>{{ __('SMP/MTs') }}</option>
                                <option value="SMA" {{ old('education_level') == 'SMA' ? 'selected' : '' }}>{{ __('SMA/SMK/MA') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Class Level') }}</label>
                            <input type="text" name="class_level" value="{{ old('class_level') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="1-12 / -">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Economic Grade') }}</label>
                            <select name="grade"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;">
                                <option value="A" {{ old('grade') == 'A' ? 'selected' : '' }}>{{ __('Grade A') }}</option>
                                <option value="B" {{ old('grade') == 'B' ? 'selected' : '' }}>{{ __('Grade B') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Section 4: Administrative Details --}}
                <div style="padding: 1.5rem; border-bottom: 1px solid #e8eae8;">
                    <div class="flex items-center gap-3 mb-6">
                        <div style="width: 2.5rem; height: 2.5rem; border-radius: 10px; display: flex; align-items: center; justify-content: center; background-color: #eef3ee; color: #2b4c30;">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold" style="color: #2b4c30;">{{ __('Administrative Records') }}</h3>
                            <p class="text-xs font-semibold uppercase tracking-widest" style="color: #7a877a;">{{ __('Placement & Admission') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Asrama Facility') }}</label>
                            <select name="asrama_id" id="asrama_id"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required>
                                <option value="">-- {{ __('Select Facility') }} --</option>
                                @foreach($asramas as $asrama)
                                    <option value="{{ $asrama->id }}" {{ (old('asrama_id', $selected_asrama_id ?? '') == $asrama->id) ? 'selected' : '' }}>
                                        {{ $asrama->kode_asrama }} – {{ $asrama->nama_asrama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Registration Number') }}</label>
                            <div style="position: relative;">
                                <input type="text" name="registration_number" id="registration_number"
                                    value="{{ old('registration_number') }}"
                                    style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.75rem; color: #2b4c30; background-color: #f4f1ed; font-family: monospace; font-weight: 600; letter-spacing: 0.05em;"
                                    required readonly placeholder="{{ __('Auto-generated') }}">
                                <div style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%);">
                                    <i data-lucide="lock" class="w-3.5 h-3.5" style="color: #7a877a;"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Recommended By') }}</label>
                            <input type="text" name="recommended_by" value="{{ old('recommended_by') }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                placeholder="{{ __('Name of Recommender') }}">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Enrollment Status') }}</label>
                            <select name="enrollment_status"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required>
                                <option value="active" {{ old('enrollment_status') == 'active' ? 'selected' : '' }}>{{ __('Active Membership') }}</option>
                                <option value="graduated" {{ old('enrollment_status') == 'graduated' ? 'selected' : '' }}>{{ __('Graduated') }}</option>
                                <option value="withdrawn" {{ old('enrollment_status') == 'withdrawn' ? 'selected' : '' }}>{{ __('Withdrawn') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a877a;">{{ __('Admission Date') }}</label>
                            <input type="date" name="admission_date" value="{{ old('admission_date', date('Y-m-d')) }}"
                                style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #e8eae8; border-radius: 10px; font-size: 0.875rem; color: #2b4c30; background-color: #fafafa;"
                                required>
                        </div>
                    </div>
                </div>

                {{-- Section 5: Official Documents --}}
                <div style="padding: 1.5rem; border-bottom: 1px solid #e8eae8;">
                    <div class="flex items-center gap-3 mb-6">
                        <div style="width: 2.5rem; height: 2.5rem; border-radius: 10px; display: flex; align-items: center; justify-content: center; background-color: #eef3ee; color: #2b4c30;">
                            <i data-lucide="paperclip" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold" style="color: #2b4c30;">{{ __('Document Vault') }}</h3>
                            <p class="text-xs font-semibold uppercase tracking-widest" style="color: #7a877a;">{{ __('Legal Attachments & Identity') }}</p>
                        </div>
                    </div>

                    <div id="documents-container" class="space-y-3">
                        <div style="display: flex; flex-direction: column; gap: 0.75rem; padding: 1rem; background-color: #fafafa; border: 1px solid #e8eae8; border-radius: 12px;">
                            <div class="w-full sm:w-1/3">
                                <label class="block text-xs font-semibold uppercase tracking-wider mb-1" style="color: #7a877a;">{{ __('Document Type') }}</label>
                                <select name="documents[0][type]"
                                    style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e8eae8; border-radius: 8px; font-size: 0.75rem; font-weight: 600; color: #2b4c30; background-color: #f4f1ed;">
                                    <option value="profile_photo">{{ __('Profile Photo') }}</option>
                                    <option value="birth_certificate">{{ __('Birth Certificate') }}</option>
                                    <option value="family_card">{{ __('Family Card (KK)') }}</option>
                                    <option value="guardian_id">{{ __('Guardian ID (KTP)') }}</option>
                                </select>
                            </div>
                            <div class="flex-1 w-full">
                                <label class="block text-xs font-semibold uppercase tracking-wider mb-1" style="color: #7a877a;">{{ __('Select File') }}</label>
                                <input type="file" name="documents[0][file]"
                                    style="font-size: 0.75rem; color: #7a877a;">
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addDocField()"
                        style="margin-top: 1rem; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #eef3ee; border: 1px solid #d6e0d6; border-radius: 10px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #2b4c30; cursor: pointer; transition: background-color 0.2s ease;"
                        onmouseover="this.style.backgroundColor='#d6e0d6'" onmouseout="this.style.backgroundColor='#eef3ee'">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        {{ __('Add Attachment') }}
                    </button>
                </div>

                {{-- Footer Actions --}}
                <div style="padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #e8eae8;">
                    <a href="{{ route('children.index') }}"
                        style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #7a877a; text-decoration: none; transition: color 0.2s ease;"
                        onmouseover="this.style.color='#2b4c30'" onmouseout="this.style.color='#7a877a'">{{ __('Discard Registration') }}</a>
                    <button type="submit"
                        style="padding: 0.625rem 1.5rem; background-color: #2b4c30; color: #ffffff; border: none; border-radius: 10px; font-size: 0.8125rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: background-color 0.2s ease;"
                        onmouseover="this.style.backgroundColor='#1f3a24'" onmouseout="this.style.backgroundColor='#2b4c30'">
                        <span>{{ __('Confirm Registration') }}</span>
                        <i data-lucide="check" class="w-4 h-4"></i>
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
            newField.style.cssText = 'display: flex; flex-direction: column; gap: 0.75rem; padding: 1rem; background-color: #fafafa; border: 1px solid #e8eae8; border-radius: 12px;';
            newField.innerHTML = `
                <div style="width: 100%;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; color: #7a877a;">{{ __('Document Type') }}</label>
                    <select name="documents[${docCount}][type]" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e8eae8; border-radius: 8px; font-size: 0.75rem; font-weight: 600; color: #2b4c30; background-color: #f4f1ed;">
                        <option value="profile_photo">{{ __('Profile Photo') }}</option>
                        <option value="birth_certificate">{{ __('Birth Certificate') }}</option>
                        <option value="family_card">{{ __('Family Card (KK)') }}</option>
                        <option value="guardian_id">{{ __('Guardian ID (KTP)') }}</option>
                    </select>
                </div>
                <div style="flex: 1; width: 100%; position: relative;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem; color: #7a877a;">{{ __('Select File') }}</label>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="file" name="documents[${docCount}][file]" style="font-size: 0.75rem; color: #7a877a; flex: 1;">
                        <button type="button" onclick="this.parentElement.parentElement.parentElement.remove()" style="padding: 0.375rem; background-color: #fdf2f2; color: #c0392b; border: 1px solid #f5c6cb; border-radius: 6px; cursor: pointer;">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newField);
            docCount++;
        }

        document.getElementById('asrama_id').addEventListener('change', function () {
            generateRegistrationNumber(this.value);
        });

        function generateRegistrationNumber(asramaId) {
            const regInput = document.getElementById('registration_number');

            if (!asramaId) {
                regInput.value = '';
                regInput.placeholder = "{{ __('Select Asrama first...') }}";
                return;
            }

            regInput.placeholder = "{{ __('Generating...') }}";

            fetch(`/children/generate-registration-number?asrama_id=${asramaId}`)
                .then(response => response.json())
                .then(data => {
                    regInput.value = data.registration_number;
                })
                .catch(error => {
                    console.error('Error:', error);
                    regInput.placeholder = "{{ __('Error generating ID') }}";
                });
        }

        window.addEventListener('DOMContentLoaded', (event) => {
            const initialAsramaId = document.getElementById('asrama_id').value;
            if (initialAsramaId) {
                generateRegistrationNumber(initialAsramaId);
            }
        });
    </script>
</x-app-layout>
