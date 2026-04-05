<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Child Profile Report') }}: {{ $child->full_name }}</title>
    <style>
        /* Margin kertas A4 yang optimal & elegan */
        @page {
            margin: 1.2cm 1.5cm;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif; 
            font-size: 10px; 
            color: #334155; 
            line-height: 1.4; 
            background: #ffffff;
        }
        
        /* Aksen Garis Atas Dokumen (Corporate Feel) */
        /* .top-accent {
            width: 100%;
            height: 4px;
            background-color: #1e3a8a; 
            margin-bottom: 15px;
        } */

        /* --- KOP SURAT --- */
        .kop-surat-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .kop-logo-cell { width: 12%; text-align: left; vertical-align: middle; }
        .kop-logo-cell img { width: 75px; height: auto; max-width: 100%; }
        .kop-text-cell { width: 88%; text-align: center; vertical-align: middle; padding-right: 12%; }
        .kop-title { font-size: 15px; font-weight: 800; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .kop-contact { font-size: 9px; color: #64748b; line-height: 1.4; }
        .kop-line-thick { border-bottom: 2px solid #1e3a8a; margin-top: 8px; }
        .kop-line-thin { border-bottom: 1px solid #1e3a8a; margin-top: 2px; margin-bottom: 15px; }
        
        /* Document Title */
        .doc-title { text-align: center; margin-bottom: 15px; background: #f8fafc; padding: 8px; border-radius: 4px; }
        .doc-title h2 { font-size: 15px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px; }
        .doc-no { font-size: 9px; color: #64748b; font-weight: 600; }
        
        /* Profile Summary Card - Full Width Modern */
        .profile-container {
            width: 100%;
            margin-bottom: 15px;
            background: linear-gradient(to right, #f8fafc, #ffffff);
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #3b82f6; /* Aksen kiri */
        }
        .profile-table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .profile-photo-cell { width: 85px; vertical-align: middle; }
        .profile-photo-box {
            width: 70px; height: 90px; overflow: hidden; border-radius: 4px; 
            border: 2px solid #ffffff; box-shadow: 0 0 0 1px #cbd5e1;
            text-align: center; background: #f1f5f9;
        }
        .profile-photo-box img { width: 70px; min-height: 90px; object-fit: cover; }
        .profile-info-cell { vertical-align: middle; padding-left: 15px; }
        .child-name { font-size: 18px; font-weight: 800; color: #0f172a; margin-bottom: 2px; }
        .child-reg { font-size: 10px; color: #3b82f6; font-weight: 700; margin-bottom: 8px; display: block; letter-spacing: 0.5px; }
        .badge { display: inline-block; padding: 4px 10px; font-size: 8px; font-weight: 800; border-radius: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-active { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .badge-graduated { background: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .badge-withdrawn { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        /* Section Header - Ribbon Style */
        .section-header { 
            font-size: 10px; font-weight: 800; color: #1e3a8a; text-transform: uppercase; 
            letter-spacing: 0.5px; margin-top: 15px; margin-bottom: 8px; 
            padding: 5px 8px; background-color: #f1f5f9; 
            border-left: 4px solid #1e3a8a; /* Efek pita / ribbon */
        }
        
        /* Data Tables - Premium Look (Zebra Striping) */
        .data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 2px; 
            table-layout: fixed; 
            border: 1px solid #cbd5e1;
        }
        .data-table th, .data-table td { 
            padding: 7px 12px; 
            vertical-align: middle; 
            border-bottom: 1px solid #e2e8f0; 
            font-size: 9px; 
            word-wrap: break-word; 
        }
        .data-table tr:nth-child(even) td, .data-table tr:nth-child(even) th { background-color: #f8fafc; }
        .data-table tr:last-child th, .data-table tr:last-child td { border-bottom: none; }
        .data-table th { 
            width: 20%; 
            text-align: left; 
            color: #475569; 
            font-weight: 700; 
            border-right: 1px solid #e2e8f0; 
            background-color: #f1f5f9;
        }
        .data-table td { 
            width: 30%; 
            color: #0f172a; 
            font-weight: 500; 
        }
        .data-table td:nth-child(2) { border-right: 1px solid #e2e8f0; }
        
        /* Documents Section */
        .doc-grid { width: 100%; margin-top: 15px; page-break-inside: avoid; text-align: center; }
        .doc-item { display: inline-block; width: 31%; margin-right: 2%; margin-bottom: 10px; vertical-align: top; }
        .doc-item:last-child { margin-right: 0; }
        .doc-label { font-weight: 800; margin-bottom: 6px; font-size: 8px; text-transform: uppercase; color: #ffffff; background: #475569; padding: 4px; border-radius: 4px; letter-spacing: 0.5px;}
        .doc-image { max-width: 100%; height: 110px; object-fit: contain; border-radius: 4px; border: 1px solid #cbd5e1; padding: 3px; background: #f8fafc; }
        .no-doc { padding: 15px 10px; font-size: 9px; color: #94a3b8; font-style: italic; border: 1px dashed #cbd5e1; border-radius: 4px; background: #f8fafc;}

        /* Footer & Signatures */
        .signature-section { width: 100%; margin-top: 40px; page-break-inside: avoid; }
        .signature-table { width: 100%; border-collapse: collapse; }
        .signature-cell { width: 35%; text-align: center; }
        .signature-date { margin-bottom: 60px; color: #334155; font-size: 9.5px; }
        .signature-name { font-weight: 800; text-decoration: underline; color: #0f172a; font-size: 10px; }
        .signature-role { font-size: 9px; color: #64748b; margin-top: 2px; }
        
        .timestamp { font-size: 8px; color: #94a3b8; text-align: center; border-top: 1px dashed #cbd5e1; padding-top: 8px; letter-spacing: 0.5px; position: fixed; bottom: 0; left: 0; right: 0; margin-bottom: -15px; }
    </style>
</head>
<body>
    <div class="top-accent"></div>

    @php
        $logoPath = public_path('images/logo-rh.png'); 
        $logoBase64 = null;
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
        }
    @endphp

    <table class="kop-surat-table">
        <tr>
            <td class="kop-logo-cell">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" alt="Logo" style="width: 75px;">
                @endif
            </td>
            <td class="kop-text-cell">
                <div class="kop-title">YAYASAN RUMAH HARAPAN</div>
                <div class="kop-contact">
                    Jl. Singaperbangsa No. 09 Nagasari, Kec. Karawang Barat, Kab. Karawang, Jawa Barat<br>
                    www.rumahharapan.org &nbsp;&bull;&nbsp; info@rumahharapan.org<br>
                    (0267) 8418974 - 081210993338
                </div>
            </td>
        </tr>
    </table>
    <div class="kop-line-thick"></div>
    <div class="kop-line-thin"></div>

    <div class="doc-title">
        <h2>{{ __('Child Profile Report') }}</h2>
        <div class="doc-no">{{ __('Document Number') }}: {{ $child->registration_number }}/LP/{{ now()->format('Y') }}</div>
    </div>

    <div class="profile-container">
        <table class="profile-table">
            <tr>
                @php
                    $profilePhoto = $child->documents->firstWhere('document_type', 'profile_photo');
                @endphp
                @if($profilePhoto && !empty($profilePhoto->base64_image))
                    <td class="profile-photo-cell" width="85">
                        <div class="profile-photo-box">
                            <img src="{{ $profilePhoto->base64_image }}" alt="Foto" width="70">
                        </div>
                    </td>
                @endif
                <td class="profile-info-cell">
                    <div class="child-name">{{ $child->full_name }}</div>
                    <span class="child-reg">{{ __('Reg. Number') }}: {{ $child->registration_number }}</span>
                    <div>
                        <span class="badge 
                            @if($child->enrollment_status == 'active') badge-active
                            @elseif($child->enrollment_status == 'graduated') badge-graduated
                            @else badge-withdrawn
                            @endif">
                            {{ __(ucfirst($child->enrollment_status)) }}
                        </span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-header">{{ __('I. Data Identitas Pribadi') }}</div>
    <table class="data-table">
        <tr>
            <th>{{ __('Full Name') }}</th>
            <td>{{ $child->full_name }}</td>
            <th>{{ __('Gender') }}</th>
            <td>{{ $child->gender == 'male' ? __('Male') : ($child->gender == 'female' ? __('Female') : '-') }}</td>
        </tr>
        <tr>
            <th>{{ __('National ID (NIK)') }}</th>
            <td>{{ $child->nik ?: '-' }}</td>
            <th>{{ __('Family Card (KK)') }}</th>
            <td>{{ $child->no_kk ?: '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('Birth Details') }}</th>
            <td>{{ $child->place_of_birth ?: '-' }}, {{ $child->date_of_birth ? \Carbon\Carbon::parse($child->date_of_birth)->translatedFormat('d M Y') : '-' }}</td>
            <th>{{ __('Category') }}</th>
            <td style="text-transform: capitalize;">
                @if($child->category == 'underprivileged') {{ __('Underprivileged (Dhuafa)') }} @else {{ $child->category ?: '-' }} @endif
            </td>
        </tr>
        <tr>
            <th>{{ __('Home Address') }}</th>
            <td colspan="3">{{ $child->address ?: '-' }}</td>
        </tr>
    </table>

    <div class="section-header">{{ __('II. Informasi Orang Tua & Wali') }}</div>
    <table class="data-table">
        <tr>
            <th>{{ __("Father's Name") }}</th>
            <td>{{ $child->father_name ?: '-' }}</td>
            <th>{{ __("Mother's Name") }}</th>
            <td>{{ $child->mother_name ?: '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('Parent/Guardian Phone') }}</th>
            <td colspan="3">{{ $child->parent_phone_number ?: '-' }}</td>
        </tr>
    </table>

    <div class="section-header">{{ __('III. Riwayat Pendidikan & Administrasi') }}</div>
    <table class="data-table">
        <tr>
            <th>{{ __('Education Level') }}</th>
            <td>
                @switch($child->education_level)
                    @case('BS') {{ __('Belum Sekolah (BS)') }} @break
                    @case('TK') {{ __('Taman Kanak-kanak') }} @break
                    @case('SD') {{ __('SD/MI') }} @break
                    @case('SMP') {{ __('SMP/MTs') }} @break
                    @case('SMA') {{ __('SMA/SMK/MA') }} @break
                    @default {{ $child->education_level ?: '-' }}
                @endswitch
            </td>
            <th>{{ __('Class Level') }}</th>
            <td>{{ $child->class_level ?: '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('Asrama Facility') }}</th>
            <td>{{ $child->asrama ? $child->asrama->nama_asrama : __('Not Assigned') }}</td>
            <th>{{ __('Economic Grade') }}</th>
            <td>{{ $child->grade ? 'Grade ' . $child->grade : '-' }}</td>
        </tr>
        <tr>
            <th>{{ __('Admission Date') }}</th>
            <td>{{ $child->admission_date ? \Carbon\Carbon::parse($child->admission_date)->translatedFormat('d M Y') : '-' }}</td>
            <th>{{ __('Recommended By') }}</th>
            <td>{{ $child->recommended_by ?: '-' }}</td>
        </tr>
    </table>

    @if($child->documents && $child->documents->where('document_type', '!=', 'profile_photo')->count() > 0)
        <div class="doc-grid">
            <div class="section-header" style="text-align: left;">{{ __('IV. Lampiran Dokumen') }}</div>
            <div style="margin-top: 10px;">
                @foreach($child->documents->where('document_type', '!=', 'profile_photo')->take(3) as $doc)
                    <div class="doc-item">
                        <div class="doc-label">
                            @if($doc->document_type == 'birth_certificate') {{ __('Birth Certificate') }}
                            @elseif($doc->document_type == 'family_card') {{ __('Family Card (KK)') }}
                            @elseif($doc->document_type == 'guardian_id') {{ __('Guardian ID (KTP)') }}
                            @else {{ strtoupper(str_replace('_', ' ', $doc->document_type)) }}
                            @endif
                        </div>
                        @if(!empty($doc->base64_image))
                            <img src="{{ $doc->base64_image }}" class="doc-image" alt="{{ $doc->document_type }}">
                        @else
                            <div class="no-doc">[ {{ __('No document preview available') }} ]</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td></td> <td class="signature-cell">
                    <div class="signature-date">{{ __('Karawang') }}, {{ now()->translatedFormat('d F Y') }}</div>
                    <div class="signature-name">{{ auth()->user()->name }}</div>
                    <div class="signature-role">{{ auth()->user()->role === 'admin' ? __('Administrator') : __('Administrative Staff') }} {{ __('Foundation') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="timestamp">
        {{ __('Automatically generated by the System on') }} {{ now()->translatedFormat('d/m/Y H:i') }} WIB &nbsp;|&nbsp; {{ __('Confidential Document') }}
    </div>
</body>
</html>