<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('children.index') }}" class="text-slate-500 hover:text-indigo-600 transition-colors">{{ __('Children Data') }}</a>
            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="font-semibold text-slate-800 dark:text-slate-100">{{ __('Edit') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">{{ __('Edit Child Record') }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ $child->full_name }}</p>
        </div>

        <div class="content-card">
            @if ($errors->any())
                <div class="m-6 flex items-start gap-3 text-rose-700 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 p-4 rounded-xl">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm font-semibold mb-1">{{ __('Please fix the following errors:') }}</p>
                        <ul class="list-disc pl-5 text-sm space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('children.update', $child) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="content-card-header">
                    <div class="icon-box indigo">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h3 class="section-title">{{ __('Personal Information') }}</h3>
                </div>
                <div class="content-card-body border-b border-slate-100 dark:border-slate-700">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label-modern">{{ __('Registration Number') }}</label>
                            <input type="text" name="registration_number" value="{{ old('registration_number', $child->registration_number) }}" class="form-input-modern" required>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Full Name') }}</label>
                            <input type="text" name="full_name" value="{{ old('full_name', $child->full_name) }}" class="form-input-modern" required>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Place of Birth') }}</label>
                            <input type="text" name="place_of_birth" value="{{ old('place_of_birth', $child->place_of_birth) }}" class="form-input-modern" required>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Date of Birth') }}</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $child->date_of_birth) }}" class="form-input-modern" required>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Gender') }}</label>
                            <select name="gender" class="form-input-modern" required>
                                <option value="male" {{ old('gender', $child->gender) == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                <option value="female" {{ old('gender', $child->gender) == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Category') }}</label>
                            <select name="category" class="form-input-modern" required>
                                <option value="fatherless" {{ old('category', $child->category) == 'fatherless' ? 'selected' : '' }}>{{ __('Fatherless (Yatim)') }}</option>
                                <option value="motherless" {{ old('category', $child->category) == 'motherless' ? 'selected' : '' }}>{{ __('Motherless (Piatu)') }}</option>
                                <option value="orphan" {{ old('category', $child->category) == 'orphan' ? 'selected' : '' }}>{{ __('Orphan (Yatim Piatu)') }}</option>
                                <option value="underprivileged" {{ old('category', $child->category) == 'underprivileged' ? 'selected' : '' }}>{{ __('Underprivileged (Dhuafa)') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Enrollment Status') }}</label>
                            <select name="enrollment_status" class="form-input-modern" required>
                                <option value="active" {{ old('enrollment_status', $child->enrollment_status) == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                                <option value="graduated" {{ old('enrollment_status', $child->enrollment_status) == 'graduated' ? 'selected' : '' }}>{{ __('Graduated') }}</option>
                                <option value="withdrawn" {{ old('enrollment_status', $child->enrollment_status) == 'withdrawn' ? 'selected' : '' }}>Withdrawn</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-modern">{{ __('Admission Date') }}</label>
                            <input type="date" name="admission_date" value="{{ old('admission_date', $child->admission_date) }}" class="form-input-modern" required>
                        </div>
                    </div>
                </div>

                <div class="content-card-header">
                    <div class="icon-box amber">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                    </div>
                    <h3 class="section-title">{{ __('Documents') }}</h3>
                </div>
                <div class="content-card-body border-b border-slate-100 dark:border-slate-700">
                    <div id="documents-container" class="space-y-3"></div>
                    <button type="button" onclick="addDocField()" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        {{ __('Add document') }}
                    </button>
                </div>

                <div class="content-card-body flex justify-end gap-3">
                    <a href="{{ route('children.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ __('Update Record') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let docIndex = 0;
        function addDocField() {
            const container = document.getElementById('documents-container');
            const div = document.createElement('div');
            div.className = 'flex flex-col sm:flex-row items-start sm:items-center gap-3 p-4 rounded-xl bg-slate-50/80 border border-slate-100';
            div.innerHTML = `
                <select name="documents[${docIndex}][type]" class="form-input-modern sm:w-1/3">
                    <option value="profile_photo">{{ __('Profile Photo') }}</option>
                    <option value="birth_certificate">{{ __('Birth Certificate') }}</option>
                    <option value="family_card">{{ __('Family Card (KK)') }}</option>
                    <option value="guardian_id">{{ __('Guardian ID (KTP)') }}</option>
                </select>
                <input type="file" name="documents[${docIndex}][file]" class="block flex-1 text-sm text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 file:cursor-pointer file:transition-colors">
                <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            `;
            container.appendChild(div);
            docIndex++;
        }
    </script>
</x-app-layout>
