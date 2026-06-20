<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Identitas Anak - {{ $child->full_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }

        /* Standard ID Card Size (CR80) */
        .id-card {
            width: 85.6mm;
            height: 53.98mm;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
            box-sizing: border-box;
            border-radius: 4mm;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        /* KTP background pattern effect */
        .id-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIiAvPgo8cmVjdCB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSIjZTE1ZDRjIiBvcGFjaXR5PSIwLjEiIC8+Cjwvc3ZnPg==');
            opacity: 0.5;
            z-index: 1;
        }

        /* Abstract shapes for premium ID look */
        .shape-1 {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
            border-radius: 50%;
            z-index: 1;
        }

        .shape-2 {
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(34, 197, 94, 0.05) 100%);
            border-radius: 50%;
            z-index: 1;
        }

        .card-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .card-header {
            background-color: #166534;
            /* Green-800 */
            color: white;
            padding: 1.5mm 4mm;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-text {
            flex: 1;
        }

        .header-title {
            font-size: 7pt;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            margin-bottom: 0.5mm;
        }

        .header-subtitle {
            font-size: 3.2pt;
            font-weight: 500;
            line-height: 1.3;
            opacity: 0.95;
        }

        .logo-placeholder {
            width: 9mm;
            height: 9mm;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1px;
            flex-shrink: 0;
        }

        .logo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Body */
        .card-body {
            display: flex;
            padding: 2mm 4mm;
            flex: 1;
            gap: 3mm;
            overflow: hidden;
            position: relative;
        }

        /* Photo Area */
        .photo-area {
            width: 19mm;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
        }

        .photo-box {
            width: 19mm;
            height: 25.3mm;
            border: 1px solid #cbd5e1;
            border-radius: 1.5mm;
            background-color: #f8fafc;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-placeholder {
            color: #94a3b8;
            font-size: 14pt;
        }

        /* Details Area */
        .details-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.8mm;
        }

        .detail-row {
            display: flex;
            font-size: 4.8pt;
            line-height: 1.25;
            color: #0f172a;
        }

        .detail-label {
            width: 14mm;
            font-weight: 700;
            color: #334155;
            flex-shrink: 0;
        }

        .detail-colon {
            width: 1.5mm;
            font-weight: 700;
            flex-shrink: 0;
        }

        .detail-value {
            flex: 1;
            font-weight: 600;
            text-transform: uppercase;
            overflow: hidden;
        }

        .name-value {
            font-size: 6pt;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5mm;
        }

        .nik-value {
            font-size: 5.5pt;
            font-weight: 800;
            letter-spacing: 0.5px;
            font-family: monospace;
        }

        /* Footer */
        .card-footer {
            padding: 1mm 4mm;
            font-size: 4pt;
            text-align: right;
            color: #64748b;
            font-weight: 600;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.8);
            flex-shrink: 0;
        }

        /* Print Settings */
        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .no-print {
                display: none !important;
            }

            .id-card {
                box-shadow: none;
                margin: 0;
                border: 0.5px solid #cbd5e1;
                /* Optional: border for cutting guide */
                page-break-inside: avoid;
            }

            @page {
                margin: 0;
                size: 85.6mm 53.98mm;
                /* exact card size */
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center p-4">

    <!-- Action Bar (Not visible in print) -->
    <div
        class="no-print bg-white p-4 rounded-2xl shadow-sm border border-slate-200 mb-8 w-full max-w-md flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-slate-800">Pratinjau Kartu Identitas</h2>
            <p class="text-xs text-slate-500">Ukuran standar CR80 (85.6mm x 53.98mm)</p>
        </div>
        <div class="flex gap-2">
            <button onclick="window.close()"
                class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold rounded-xl transition-colors">
                Tutup
            </button>
            <button onclick="window.print()"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-green-500/30 flex items-center gap-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Cetak
            </button>
        </div>
    </div>

    <!-- ID Card -->
    <div class="id-card">
        <div class="shape-1"></div>
        <div class="shape-2"></div>

        <div class="card-content">
            <div class="card-header">
                <div class="logo-placeholder">
                    @php
                        $logoPath = public_path('images/logo-rh.png');
                        $logoBase64 = null;
                        if (file_exists($logoPath)) {
                            $logoData = file_get_contents($logoPath);
                            $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
                        }
                    @endphp
                    @if($logoBase64)
                        <img src="{{ $logoBase64 }}" alt="Logo">
                    @else
                        <span style="color:#166534; font-size:6pt; font-weight:900;">RH</span>
                    @endif
                </div>
                <div class="header-text">
                    <div class="header-title">YAYASAN RUMAH HARAPAN</div>
                    <div class="header-subtitle">
                        Jl. Singaperbangsa No. 09 Nagasari, Kec. Karawang Barat, Kab. Karawang, Jawa Barat<br>
                        www.rumahharapan.org &bull; info@rumahharapan.org &bull; (0267) 8418974 - 081210993338
                    </div>
                </div>
                <!-- Empty div for balance since logo is on left, text is centered -->
                <div style="width:9mm"></div>
            </div>

            <div
                style="text-align: center; font-size: 6.5pt; font-weight: 800; padding: 1.5mm 0; background-color: #dcfce7; color: #166534; letter-spacing: 1.5px; border-bottom: 1px solid #bbf7d0;">
                KARTU IDENTITAS ANAK
            </div>

            <div class="card-body">
                <div class="photo-area">
                    <div class="photo-box">
                        @php
                            $profilePhoto = $child->documents->firstWhere('document_type', 'profile_photo');
                        @endphp
                        @if($profilePhoto && !empty($profilePhoto->base64_image))
                            <img src="{{ $profilePhoto->base64_image }}" alt="Foto">
                        @else
                            <div class="photo-placeholder">👤</div>
                        @endif
                    </div>
                </div>

                <div class="details-area">
                    <div class="detail-row mb-1">
                        <div class="detail-label">NIK / Reg</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value nik-value">{{ $child->nik ?: $child->registration_number }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Nama</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value name-value">{{ $child->full_name }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Tempat/Tgl Lahir</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $child->place_of_birth }},
                            {{ \Carbon\Carbon::parse($child->date_of_birth)->format('d-m-Y') }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value">{{ $child->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Alamat</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value" style="font-size: 4pt; line-height: 1.2;">
                            {{ Str::limit($child->address ?: '-', 60) }}</div>
                    </div>
                    <div class="detail-row mt-1">
                        <div class="detail-label" style="color: #166534">Asrama</div>
                        <div class="detail-colon">:</div>
                        <div class="detail-value" style="color: #166534">
                            {{ $child->asrama ? $child->asrama->nama_asrama : 'Non-Asrama' }}</div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div>Berlaku Hingga: Selama Menjadi Anak Asuh</div>
            </div>
        </div>
    </div>

</body>

</html>