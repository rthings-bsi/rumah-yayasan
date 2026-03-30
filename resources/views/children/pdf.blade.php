<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Anak: {{ $child->full_name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #1e293b; line-height: 1.5; }
        
        /* Header */
        .header { padding: 25px 30px; border-bottom: 3px solid #4f46e5; margin-bottom: 0; }
        .header-inner { display: table; width: 100%; }
        .header-left { display: table-cell; vertical-align: middle; }
        .header-right { display: table-cell; vertical-align: middle; text-align: right; }
        .org-name { font-size: 20px; font-weight: bold; color: #1e1b4b; letter-spacing: 0.5px; }
        .org-sub { font-size: 10px; color: #6366f1; margin-top: 2px; letter-spacing: 1px; text-transform: uppercase; }
        .doc-type { font-size: 12px; font-weight: bold; color: #4f46e5; text-transform: uppercase; letter-spacing: 1.5px; }
        .doc-date { font-size: 9px; color: #94a3b8; margin-top: 4px; }
        
        /* Content */
        .content { padding: 20px 30px; }
        
        /* Section */
        .section { margin-bottom: 22px; }
        .section-label { 
            font-size: 11px; font-weight: bold; color: #4f46e5; 
            text-transform: uppercase; letter-spacing: 1.5px; 
            padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; 
            margin-bottom: 12px; 
        }
        
        /* Info Table */
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table tr { border-bottom: 1px solid #f1f5f9; }
        .info-table tr:last-child { border-bottom: none; }
        .info-table th { 
            text-align: left; padding: 7px 12px; font-size: 10px; 
            color: #64748b; font-weight: 600; width: 30%; 
            background: #f8fafc; vertical-align: top;
        }
        .info-table td { 
            padding: 7px 12px; font-size: 11px; color: #1e293b; 
            font-weight: 500; 
        }
        
        /* Badge */
        .badge { 
            display: inline-block; padding: 2px 10px; border-radius: 10px; 
            font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .badge-active { background: #dcfce7; color: #15803d; }
        .badge-graduated { background: #dbeafe; color: #1d4ed8; }
        .badge-withdrawn { background: #ffe4e6; color: #be123c; }
        .capitalize { text-transform: capitalize; }
        
        /* Profile Photo */
        .profile-section { display: table; width: 100%; margin-bottom: 20px; }
        .profile-photo { display: table-cell; width: 120px; vertical-align: top; padding-right: 20px; }
        .profile-photo img { width: 110px; height: 140px; object-fit: cover; border: 2px solid #e2e8f0; border-radius: 6px; }
        .profile-info { display: table-cell; vertical-align: top; }
        .child-name { font-size: 18px; font-weight: bold; color: #1e1b4b; }
        .child-reg { font-size: 10px; color: #6366f1; font-weight: 600; margin-top: 2px; letter-spacing: 0.5px; }
        .child-status { margin-top: 8px; }

        /* Documents */
        .doc-grid { width: 100%; }
        .doc-item { text-align: center; page-break-inside: avoid; margin-bottom: 18px; padding: 12px; border: 1px solid #e2e8f0; border-radius: 6px; background: #fafbfc; }
        .doc-item img { max-width: 90%; max-height: 450px; height: auto; border-radius: 4px; }
        .doc-label { font-size: 10px; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
        .doc-nopreview { color: #94a3b8; font-style: italic; font-size: 10px; padding: 25px; }

        /* Footer */
        .footer { 
            position: fixed; bottom: 0; left: 0; right: 0;
            text-align: center; padding: 10px 30px; 
            border-top: 1px solid #e2e8f0; 
            font-size: 8px; color: #94a3b8; 
            background: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-inner">
            <div class="header-left">
                <div class="org-name">Yayasan Rumah Harapan</div>
                <div class="org-sub">Sistem Manajemen Anak Asuh</div>
            </div>
            <div class="header-right">
                <div class="doc-type">Laporan Profil Anak</div>
                <div class="doc-date">Dicetak: {{ now()->format('d F Y, H:i') }} WIB</div>
            </div>
        </div>
    </div>

    <div class="content">
        <!-- Profile Header -->
        <div class="profile-section">
            @php
                $profilePhoto = $child->documents->firstWhere('document_type', 'profile_photo');
            @endphp
            @if($profilePhoto && !empty($profilePhoto->base64_image))
                <div class="profile-photo">
                    <img src="{{ $profilePhoto->base64_image }}" alt="Foto Profil">
                </div>
            @endif
            <div class="profile-info">
                <div class="child-name">{{ $child->full_name }}</div>
                <div class="child-reg">No. Registrasi: {{ $child->registration_number }}</div>
                <div class="child-status">
                    <span class="badge 
                        @if($child->enrollment_status == 'active') badge-active
                        @elseif($child->enrollment_status == 'graduated') badge-graduated
                        @else badge-withdrawn
                        @endif">
                        @if($child->enrollment_status == 'active') Aktif
                        @elseif($child->enrollment_status == 'graduated') Lulus
                        @else Keluar
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Data Pribadi -->
        <div class="section">
            <div class="section-label">Data Pribadi</div>
            <table class="info-table">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $child->full_name }}</td>
                </tr>
                <tr>
                    <th>Nomor Registrasi</th>
                    <td>{{ $child->registration_number }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $child->place_of_birth }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ \Carbon\Carbon::parse($child->date_of_birth)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $child->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>
                        @if($child->category == 'fatherless') Yatim
                        @elseif($child->category == 'motherless') Piatu
                        @elseif($child->category == 'orphan') Yatim Piatu
                        @else Dhuafa
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge 
                            @if($child->enrollment_status == 'active') badge-active
                            @elseif($child->enrollment_status == 'graduated') badge-graduated
                            @else badge-withdrawn
                            @endif">
                            @if($child->enrollment_status == 'active') Aktif
                            @elseif($child->enrollment_status == 'graduated') Lulus
                            @else Keluar
                            @endif
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ \Carbon\Carbon::parse($child->admission_date)->format('d F Y') }}</td>
                </tr>
            </table>
        </div>

        <!-- Dokumen Terlampir -->
        @if($child->documents->count() > 0)
            <div class="section">
                <div class="section-label">Dokumen Terlampir</div>
                @foreach($child->documents as $doc)
                    <div class="doc-item">
                        <div class="doc-label">
                            @if($doc->document_type == 'profile_photo') Foto Profil
                            @elseif($doc->document_type == 'birth_certificate') Akta Kelahiran
                            @elseif($doc->document_type == 'family_card') Kartu Keluarga (KK)
                            @elseif($doc->document_type == 'guardian_id') KTP Wali
                            @else {{ str_replace('_', ' ', $doc->document_type) }}
                            @endif
                        </div>
                        @if(!empty($doc->base64_image))
                            <img src="{{ $doc->base64_image }}" alt="{{ $doc->document_type }}">
                        @else
                            <div class="doc-nopreview">Format dokumen tidak dapat ditampilkan (file PDF)</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh Sistem Manajemen Yayasan Rumah Harapan &mdash; {{ now()->format('d F Y') }}
    </div>
</body>
</html>
