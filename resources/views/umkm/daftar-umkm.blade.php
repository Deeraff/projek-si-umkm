@extends('layouts.umkm')

@section('title', 'Daftar UMKM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<style>
    .step-indicator {
        display: flex;
        justify-content: center;
        gap: 1.25rem;
        margin-bottom: 2.5rem;
    }
    .step-indicator div {
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 50%;
        background: #e5e7eb;
        color: #374151;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .step-indicator div.active {
        background: linear-gradient(135deg, var(--green-500), var(--green-600));
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(34,197,94,0.3);
    }
    .step {
        display: none;
        animation: fadeInUp .4s ease forwards;
    }
    .step.active { display: block; }

    /* 🌍 Map */
    #map {
        height: 300px;
        width: 100%;
        border-radius: 10px;
        border: 2px solid #d1d5db;
        margin-top: .75rem;
    }
</style>
@endpush
@if (session('success'))
    <div class="alert alert-success" style="background:#d1fae5;color:#065f46;padding:1rem;border-radius:8px;margin-bottom:1rem;">
        {{ session('success') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info" style="background:#bfdbfe;color:#1e3a8a;padding:1rem;border-radius:8px;margin-bottom:1rem;">
        {{ session('info') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" style="background:#fee2e2;color:#991b1b;padding:1rem;border-radius:8px;margin-bottom:1rem;">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin-top:0.5rem;">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
<div class="landing-container py-10">
    <div class="content-card">
        <h2 class="section-title-gradient">Form Pendaftaran UMKM</h2>
        <p class="text-gray-600 text-center mb-8">Lengkapi data berikut langkah demi langkah dengan benar.</p>

        {{-- ✅ Alert --}}
        @if (session('success'))
            <div class="alert alert-success" style="background:#d1fae5;color:#065f46;padding:1rem;border-radius:8px;margin-bottom:1rem;">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" style="background:#fee2e2;color:#991b1b;padding:1rem;border-radius:8px;margin-bottom:1rem;">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin-top:0.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Step Indicator --}}
        <div class="step-indicator">
            <div id="indicator-1" class="active">1</div>
            <div id="indicator-2">2</div>
            <div id="indicator-3">3</div>
        </div>

        {{-- Form --}}
        <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" id="umkmForm">
            @csrf

            {{-- STEP 1: DATA PEMILIK --}}
            <div class="step active" id="step-1">
                <h3 class="section-title"><i class="fa-solid fa-user text-green-600"></i> Data Pemilik</h3>
                <div class="form-section">
                    <div class="form-grid">
                        {{-- Semua form tetap utuh --}}
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap Pemilik <span class="required">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-input"
                                placeholder="Contoh: Budi Santoso"
                                value="{{ old('nama_lengkap', $pemilik->nama_lengkap ?? Auth::User()->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor KTP / NIK <span class="required">*</span></label>
                            <input type="text" name="nik" class="form-input" maxlength="16" pattern="[0-9]{16}"
                                placeholder="16 digit NIK" required
                                value="{{ old('nik', $pemilik->nik ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor KK</label>
                            <input type="text" name="no_kk" class="form-input" maxlength="16"
                                placeholder="Opsional, 16 digit"
                                value="{{ old('no_kk', $pemilik->no_kk ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">NPWP</label>
                            <input type="text" name="npwp" class="form-input"
                                placeholder="Contoh: 12.345.678.9-012.345"
                                value="{{ old('npwp', $pemilik->npwp ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                            <input type="tel" name="no_hp" class="form-input"
                                placeholder="Contoh: 081234567890"
                                required value="{{ old('no_hp', $pemilik->no_hp ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Aktif <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input bg-gray-100" readonly
                                placeholder="contoh@email.com"
                                value="{{ old('email', Auth::user()->email) }}">
                        </div>

                        <div class="form-group form-group-full">
                            <label class="form-label">Alamat Domisili <span class="required">*</span></label>
                            <textarea name="alamat_domisili" rows="2" class="form-input" required
                                placeholder="Masukkan alamat lengkap sesuai KTP">{{ old('alamat_domisili', $pemilik->alamat_domisili ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- STEP 2: DATA USAHA --}}
            <div class="step" id="step-2">
                <h3 class="section-title"><i class="fa-solid fa-store text-green-600"></i> Data Usaha</h3>
                <div class="form-section">
                    <div class="form-grid">
                        {{-- Semua form tetap utuh --}}
                        <div class="form-group">
                            <label class="form-label">Nama Usaha / Brand <span class="required">*</span></label>
                            <input type="text" name="nama_usaha" class="form-input"
                                placeholder="Contoh: Dapoer Nenek"
                                required value="{{ old('nama_usaha') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Logo Usaha</label>
                            <input type="file" name="logo" accept="image/*" class="form-input"
                                placeholder="Unggah logo usaha (opsional)">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jenis Usaha <span class="required">*</span></label>
                            <select name="jenis_usaha_id" class="form-input" required>
                                <option value="">-- Pilih Jenis Usaha --</option>
                                @foreach($jenisUsaha as $jenis)
                                    <option value="{{ $jenis->id }}" {{ old('jenis_usaha_id') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bentuk Usaha <span class="required">*</span></label>
                            <select name="bentuk_usaha" class="form-input" required>
                                <option value="">-- Pilih Bentuk Usaha --</option>
                                <option value="perorangan">Perorangan</option>
                                <option value="cv">CV</option>
                                <option value="pt">PT</option>
                                <option value="koperasi">Koperasi</option>
                                <option value="firma">Firma</option>
                            </select>
                        </div>

                        <div class="form-group form-group-full">
                            <label class="form-label">Alamat Tempat Usaha <span class="required">*</span></label>
                            <textarea name="alamat_usaha" rows="2" class="form-input" required
                                placeholder="Masukkan alamat lengkap tempat usaha">{{ old('alamat_usaha') }}</textarea>
                        </div>

                        {{-- 🌍 Tambahan Map --}}
                        <div class="form-group form-group-full">
                            <label class="form-label">Pilih Lokasi Usaha di Peta</label>
                            <div id="map"></div>
                            <small class="text-gray-500">Klik lokasi di peta untuk mengisi otomatis Latitude & Longitude.</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Latitude</label>
                            <input type="text" id="latitude" name="latitude" class="form-input"
                                placeholder="-7.967"
                                value="{{ old('latitude') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Longitude</label>
                            <input type="text" id="longitude" name="longitude" class="form-input"
                                placeholder="112.635"
                                value="{{ old('longitude') }}">
                        </div>

                        {{-- Sisanya tetap --}}
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon Usaha <span class="required">*</span></label>
                            <input type="text" name="no_telp_usaha" class="form-input"
                                placeholder="Contoh: 0311234567"
                                required value="{{ old('no_telp_usaha') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Status Tempat Usaha <span class="required">*</span></label>
                            <select name="status_tempat" class="form-input" required>
                                <option value="">-- Pilih Status Tempat --</option>
                                <option value="milik sendiri">Milik Sendiri</option>
                                <option value="sewa">Sewa</option>
                                <option value="pinjam">Pinjam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tenaga Kerja Laki-laki</label>
                            <input type="number" name="tenaga_kerja_l" class="form-input" min="0"
                                placeholder="Contoh: 2"
                                value="{{ old('tenaga_kerja_l', 0) }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tenaga Kerja Perempuan</label>
                            <input type="number" name="tenaga_kerja_p" class="form-input" min="0"
                                placeholder="Contoh: 3"
                                value="{{ old('tenaga_kerja_p', 0) }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- STEP 3: LEGALITAS --}}
            <div class="step" id="step-3">
                <h3 class="section-title"><i class="fa-solid fa-file-signature text-green-600"></i> Legalitas Usaha</h3>
                <div class="form-section">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">NIB</label>
                            <input type="text" name="nib" class="form-input"
                                placeholder="Nomor Induk Berusaha"
                                value="{{ old('nib') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">IUMK</label>
                            <input type="text" name="iumk" class="form-input"
                                placeholder="Nomor Izin Usaha Mikro Kecil"
                                value="{{ old('iumk') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sertifikat Halal</label>
                            <input type="text" name="sertifikat_halal" class="form-input"
                                placeholder="Nomor sertifikat halal (jika ada)"
                                value="{{ old('sertifikat_halal') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sertifikat Merek</label>
                            <input type="text" name="sertifikat_merek" class="form-input"
                                placeholder="Nomor sertifikat merek (jika ada)"
                                value="{{ old('sertifikat_merek') }}">
                        </div>
                    </div>
                </div>
            </div>

            
            {{-- Navigasi --}}
            <div class="form-actions">
                <button type="button" id="prevBtn" class="btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Sebelumnya
                </button>
                <div class="flex gap-2">
                    <button type="button" id="nextBtn" class="btn-primary">
                        Selanjutnya <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <button type="submit" id="submitBtn" class="btn-primary hidden">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Pendaftaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    const steps = document.querySelectorAll('.step');

    // Fungsi untuk tampilkan step
    const showStep = (step) => {
        steps.forEach((el, i) => el.classList.toggle('active', i + 1 === step));
        document.querySelectorAll('.step-indicator div').forEach((el, i) => el.classList.toggle('active', i + 1 === step));
        document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-flex';
        document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-flex';
        document.getElementById('submitBtn').classList.toggle('hidden', step !== totalSteps);

        // 🌍 Re-render map agar tampil sempurna di Step 2
        if (step === 2 && typeof map !== 'undefined') {
            setTimeout(() => map.invalidateSize(), 300);
        }
    };

    // Fungsi validasi field wajib
    const validateStep = (step) => {
        const currentForm = document.querySelector(`#step-${step}`);
        const requiredInputs = currentForm.querySelectorAll('[required]');
        let isValid = true;

        // Hapus pesan error lama
        currentForm.querySelectorAll('.error-message').forEach(el => el.remove());

        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;

                // Tambah pesan error di bawah input kosong
                const error = document.createElement('small');
                error.classList.add('error-message');
                error.style.color = '#dc2626';
                error.style.fontSize = '0.875rem';
                error.textContent = 'Kolom ini wajib diisi';
                input.insertAdjacentElement('afterend', error);

                // Highlight border merah
                input.classList.add('border-red-500');
                input.addEventListener('input', () => input.classList.remove('border-red-500'));
            }
        });

        return isValid;
    };

    // Event navigasi step
    document.getElementById('nextBtn').addEventListener('click', () => {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        } else {
            // Scroll ke atas agar error kelihatan
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    showStep(currentStep);

    // 🌍 Leaflet map setup
    const map = L.map('map').setView([-7.967, 112.635], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
        if (marker) marker.setLatLng(e.latlng);
        else marker = L.marker(e.latlng).addTo(map);
    });
});
</script>
@endpush
@endsection