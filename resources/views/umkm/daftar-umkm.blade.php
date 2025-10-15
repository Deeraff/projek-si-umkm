@extends('layouts.app')

@section('title', 'Daftar UMKM')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<style>
.step { display: none; }
.step.active { display: block; }
.step-indicator { display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem; }
.step-indicator div { width: 2rem; height: 2rem; border-radius: 50%; background: #d1d5db; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; }
.step-indicator div.active { background: #22c55e; }
.form-error { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; }
</style>
@endpush

@section('content')
<div class="content-card">
    <h2 class="section-title text-center">Form Pendaftaran UMKM</h2>
    <p class="text-gray-600 text-center mb-8">Silakan lengkapi data di bawah ini langkah demi langkah.</p>

    {{-- Step Indicator --}}
    <div class="step-indicator">
        <div id="indicator-1" class="active">1</div>
        <div id="indicator-2">2</div>
        <div id="indicator-3">3</div>
    </div>

    <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" id="umkmForm">
        @csrf

        {{-- ================= STEP 1: DATA PEMILIK ================= --}}
        <div class="step active" id="step-1">
            <h3 class="section-title"><i class="fa-solid fa-user title-icon"></i> Data Pemilik / Perorangan</h3>
            <div class="content-grid">
                <div>
                    <label>Nama Lengkap Pemilik <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" class="form-input" placeholder="Contoh: Budi Santoso" required value="{{ old('nama_lengkap') }}">
                    @error('nama_lengkap') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Nomor KTP / NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" class="form-input" placeholder="16 digit NIK" maxlength="16" pattern="[0-9]{16}" required value="{{ old('nik') }}">
                    @error('nik') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Nomor KK</label>
                    <input type="text" name="no_kk" class="form-input" placeholder="Opsional, 16 digit" maxlength="16" pattern="[0-9]{16}" value="{{ old('no_kk') }}">
                </div>

                <div>
                    <label>NPWP</label>
                    <input type="text" name="npwp" class="form-input" placeholder="Opsional, contoh: 12.345.678.9-012.345" value="{{ old('npwp') }}">
                </div>

                <div>
                    <label>Nomor HP / WhatsApp <span class="text-red-500">*</span></label>
                    <input type="tel" name="no_hp" class="form-input" placeholder="Contoh: 081234567890" pattern="[0-9]{10,13}" required value="{{ old('no_hp') }}">
                    @error('no_hp') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Email Aktif <span class="text-red-500">*</span></label>
                    <input type="email" name="email" class="form-input" placeholder="contoh@email.com" required value="{{ old('email') }}">
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-full">
                    <label>Alamat Domisili <span class="text-red-500">*</span></label>
                    <textarea name="alamat_domisili" rows="2" class="form-input" placeholder="Masukkan alamat lengkap sesuai KTP" required>{{ old('alamat_domisili') }}</textarea>
                    @error('alamat_domisili') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ================= STEP 2: DATA USAHA ================= --}}
        <div class="step" id="step-2">
            <h3 class="section-title"><i class="fa-solid fa-store title-icon"></i> Data Usaha</h3>
            <div class="content-grid">
                <div>
                    <label>Nama Usaha / Brand <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_usaha" class="form-input" placeholder="Contoh: Dapoer Nenek" required value="{{ old('nama_usaha') }}">
                    @error('nama_usaha') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Logo Usaha</label>
                    <input type="file" name="logo" accept="image/jpeg,image/png,image/jpg" class="form-input" id="logoInput">
                </div>

                <div>
                    <label>Jenis Usaha <span class="text-red-500">*</span></label>
                    <select name="jenis_usaha" class="form-input" required>
                        <option value="">-- Pilih Jenis Usaha --</option>
                        @foreach($jenisUsaha as $jenis)
                            <option value="{{ $jenis->nama_jenis }}" {{ old('jenis_usaha') == $jenis->nama_jenis ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_usaha') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label>Bentuk Usaha <span class="text-red-500">*</span></label>
                    <select name="bentuk_usaha" class="form-input" required>
                        <option value="">-- Pilih Bentuk Usaha --</option>
                        <option value="perorangan">Perorangan</option>
                        <option value="cv">CV</option>
                        <option value="pt">PT</option>
                        <option value="koperasi">Koperasi</option>
                        <option value="firma">Firma</option>
                    </select>
                    @error('bentuk_usaha') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-full">
                    <label>Alamat Tempat Usaha <span class="text-red-500">*</span></label>
                    <textarea name="alamat_usaha" rows="2" class="form-input" placeholder="Masukkan alamat lengkap tempat usaha" required>{{ old('alamat_usaha') }}</textarea>
                </div>

                <div>
                    <label>Latitude</label>
                    <input type="text" name="latitude" class="form-input" placeholder="-7.967" value="{{ old('latitude') }}">
                </div>

                <div>
                    <label>Longitude</label>
                    <input type="text" name="longitude" class="form-input" placeholder="112.635" value="{{ old('longitude') }}">
                </div>

                <div>
                    <label>Nomor Telepon Usaha <span class="text-red-500">*</span></label>
                    <input type="tel" name="no_telp_usaha" class="form-input" placeholder="Contoh: 0311234567" required value="{{ old('no_telp_usaha') }}">
                </div>

                <div>
                    <label>Desa / Kelurahan <span class="text-red-500">*</span></label>
                    <input type="text" name="desa_kelurahan" class="form-input" placeholder="Contoh: Sukorame" required value="{{ old('desa_kelurahan') }}">
                </div>

                <div>
                    <label>Kecamatan <span class="text-red-500">*</span></label>
                    <input type="text" name="kecamatan" class="form-input" placeholder="Contoh: Kediri Barat" required value="{{ old('kecamatan') }}">
                </div>

                <div>
                    <label>Kota / Kabupaten <span class="text-red-500">*</span></label>
                    <input type="text" name="kota_kabupaten" class="form-input" placeholder="Contoh: Kediri" required value="{{ old('kota_kabupaten') }}">
                </div>

                <div>
                    <label>Status Tempat Usaha <span class="text-red-500">*</span></label>
                    <select name="status_tempat" class="form-input" required>
                        <option value="">-- Pilih Status Tempat --</option>
                        <option value="milik sendiri">Milik Sendiri</option>
                        <option value="sewa">Sewa</option>
                        <option value="pinjam">Pinjam</option>
                    </select>
                </div>

                <div>
                    <label>Tenaga Kerja Laki-laki</label>
                    <input type="number" name="tenaga_kerja_l" class="form-input" min="0" value="{{ old('tenaga_kerja_l', 0) }}">
                </div>

                <div>
                    <label>Tenaga Kerja Perempuan</label>
                    <input type="number" name="tenaga_kerja_p" class="form-input" min="0" value="{{ old('tenaga_kerja_p', 0) }}">
                </div>
            </div>
        </div>

        {{-- ================= STEP 3: LEGALITAS USAHA ================= --}}
        <div class="step" id="step-3">
            <h3 class="section-title"><i class="fa-solid fa-file-signature title-icon"></i> Legalitas Usaha</h3>
            <div class="content-grid">
                <div>
                    <label>NIB</label>
                    <input type="text" name="nib" class="form-input" placeholder="Nomor Induk Berusaha" value="{{ old('nib') }}">
                </div>
                <div>
                    <label>IUMK</label>
                    <input type="text" name="iumk" class="form-input" placeholder="Nomor Izin Usaha Mikro Kecil" value="{{ old('iumk') }}">
                </div>
                <div>
                    <label>Sertifikat Halal</label>
                    <input type="text" name="sertifikat_halal" class="form-input" placeholder="Nomor sertifikat halal (jika ada)" value="{{ old('sertifikat_halal') }}">
                </div>
                <div>
                    <label>Sertifikat Merek</label>
                    <input type="text" name="sertifikat_merek" class="form-input" placeholder="Nomor sertifikat merek (jika ada)" value="{{ old('sertifikat_merek') }}">
                </div>
            </div>
        </div>

        {{-- Navigation Buttons --}}
        <div class="text-right mt-8">
            <button type="button" id="prevBtn" class="form-input" style="width:auto;background:#e5e7eb;color:#374151;">
                <i class="fa-solid fa-arrow-left"></i> Sebelumnya
            </button>
            <button type="button" id="nextBtn" class="form-input" style="width:auto;background:#22c55e;color:#fff;border:none;">
                Selanjutnya <i class="fa-solid fa-arrow-right"></i>
            </button>
            <button type="submit" id="submitBtn" class="form-input" style="display:none;width:auto;background:#22c55e;color:#fff;border:none;">
                <i class="fa-solid fa-paper-plane"></i> Kirim Pendaftaran
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    const steps = document.querySelectorAll('.step');

    const showStep = (step) => {
        steps.forEach((el, index) => {
            el.classList.toggle('active', index + 1 === step);
        });
        document.querySelectorAll('.step-indicator div').forEach((el, index) => {
            el.classList.toggle('active', index + 1 === step);
        });
        document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
        document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
        document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';
    };

    // Fungsi validasi step saat ini
    const validateStep = (step) => {
        let valid = true;
        const stepElement = document.getElementById(`step-${step}`);
        const requiredFields = stepElement.querySelectorAll('[required]');
        
        requiredFields.forEach(input => {
            // hapus error lama
            let error = input.parentElement.querySelector('.form-error');
            if (error) error.remove();
            input.classList.remove('border-red-500');

            if (!input.value.trim()) {
                valid = false;
                input.classList.add('border-red-500');
                const errorMsg = document.createElement('p');
                errorMsg.classList.add('form-error');
                errorMsg.textContent = 'Kolom ini wajib diisi.';
                input.parentElement.appendChild(errorMsg);
            } else if (input.pattern && !new RegExp(input.pattern).test(input.value)) {
                valid = false;
                input.classList.add('border-red-500');
                const errorMsg = document.createElement('p');
                errorMsg.classList.add('form-error');
                errorMsg.textContent = 'Format input tidak valid.';
                input.parentElement.appendChild(errorMsg);
            }
        });

        return valid;
    };

    document.getElementById('nextBtn').addEventListener('click', function() {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        } else {
            // jika invalid, fokus ke atas form step itu
            window.scrollTo({ top: document.getElementById(`step-${currentStep}`).offsetTop - 100, behavior: 'smooth' });
        }
    });

    document.getElementById('prevBtn').addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });

    showStep(currentStep);
});
</script>
@endpush

@endsection
