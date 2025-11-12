<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemilikUmkm;
use App\Models\DataUsaha;
use App\Models\LegalitasUsaha;
use App\Models\KategoriJenisUsaha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    public function create()
    {
        $user = Auth::User();
        
        // 1. Ambil data pemilik (bersama relasi DataUsaha dan LegalitasUsaha)
        // Asumsi relasi di PemilikUmkm sudah didefinisikan: hasOne(DataUsaha) dan hasOne(LegalitasUsaha)
        $pemilikUmkm = PemilikUmkm::where('email', $user->email)
                                 ->with(['dataUsaha.legalitasUsaha']) // Load Usaha dan Legalitasnya
                                 ->first();
        
        // Siapkan variabel untuk view
        $usaha = $pemilikUmkm->dataUsaha ?? null;
        $legalitas = $usaha->legalitasUsaha ?? null;
        $jenisUsaha = KategoriJenisUsaha::all(); 
    
        return view('umkm.create', [
            'pemilik' => $pemilikUmkm,
            'usaha' => $usaha,
            'legalitas' => $legalitas,
            'jenisUsaha' => $jenisUsaha,
        ]);
    }

    public function index()
    {
        $user = Auth::user();
    
        // Ambil data pemilik & usaha beserta relasi lengkap
        $pemilik = PemilikUmkm::where('email', $user->email)
            ->with(['usaha.legalitasUsaha', 'usaha.jenisUsaha'])
            ->first();
    
        // Jika user belum memiliki data usaha → arahkan ke form pendaftaran
        if (!$pemilik || !$pemilik->usaha) {
            return redirect()->route('umkm.form')
                ->with('error', 'Anda belum mendaftarkan data usaha. Silakan isi formulir terlebih dahulu.');
        }
    
        $usaha = $pemilik->usaha;
        $legalitas = $usaha->legalitasUsaha;
    
        // 🔹 Logika berdasarkan status_umkm
        switch ($usaha->status_umkm) {
            case 'unverified':
                // Jika masih menunggu verifikasi
                return view('umkm.pending', compact('pemilik', 'usaha', 'legalitas'));
    
            case 'ditolak':
                // Jika ditolak, tampilkan halaman khusus dengan alasan_tolak
                // Pastikan view ini menggunakan file yang sudah diperbarui di atas
                return view('umkm.rejected', compact('pemilik', 'usaha', 'legalitas'));
    
            case 'verified':
            default:
                // Jika sudah diverifikasi, tampilkan halaman utama UMKM
                return view('umkm.index', compact('pemilik', 'usaha', 'legalitas'));
        }
    }

    public function showForm()
    {
        // Ambil semua jenis usaha untuk dropdown
        $jenisUsaha = KategoriJenisUsaha::all();
        return view('umkm.daftar-umkm', compact('jenisUsaha'));
    }


    public function store(Request $request)
    {
        // Cek apakah user sudah login. Jika tidak (walaupun ada middleware auth), hentikan.
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login untuk mendaftar UMKM.']);
        }
    
        // 1. Validasi
        $validated = $request->validate([
            // Step 1: Pemilik (Data yang ada di form, bukan data users)
            'nama_lengkap' => 'required|string|max:150',
            'nik' => 'required|size:16',
            'no_kk' => 'nullable|size:16', 
            'npwp' => 'nullable|string|max:25', 
            'no_hp' => 'required|string|max:20',
            'alamat_domisili' => 'required|string',
    
            // Step 2: Usaha
            'nama_usaha' => 'required|string|max:150',
            'jenis_usaha_id' => 'required|exists:kategori_jenis_usaha,id',
            'bentuk_usaha' => 'required|string|max:50',
            'alamat_usaha' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'no_telp_usaha' => 'required|string|max:20',
            'status_tempat' => 'required|in:milik sendiri,sewa,pinjam',
            'tenaga_kerja_l' => 'nullable|integer|min:0',
            'tenaga_kerja_p' => 'nullable|integer|min:0',
            
            // Step 3: Legalitas (opsional)
            'nib' => 'nullable|string|max:50',
            'iumk' => 'nullable|string|max:50',
            'sertifikat_halal' => 'nullable|string|max:100',
            'sertifikat_merek' => 'nullable|string|max:100',
        ]);
    
        // 2. Proses Logo (jika ada)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('umkm_logos', 'public');
        }
        
        // Ambil user yang login
        $user = Auth::user();
    
        try {
            DB::transaction(function () use ($validated, $user, $logoPath, $request) {
                
                // =======================================================
                // STEP 1: Update atau Buat Pemilik (Menggunakan Email sebagai unik)
                // =======================================================
                // Mencari berdasarkan 'email', jika tidak ada, buat baru
                $pemilik = PemilikUmkm::updateOrCreate(
                    ['email' => $user->email], // Kriteria pencarian
                    [
                        // Data yang akan di-update atau di-create
                        'nama_lengkap' => $validated['nama_lengkap'],
                        'nik' => $validated['nik'],
                        'no_kk' => $validated['no_kk'] ?? null,
                        'npwp' => $validated['npwp'] ?? null,
                        'no_hp' => $validated['no_hp'],
                        'alamat_domisili' => $validated['alamat_domisili'],
                    ]
                );
    
                // =======================================================
                // STEP 2 & 3: Simpan Data Usaha & Legalitas
                // Mencari Data Usaha yang sudah ada (Diasumsikan 1 pemilik = 1 usaha)
                // =======================================================
                
                // Cek apakah data usaha sudah ada untuk pemilik ini
                $usaha = DataUsaha::where('pemilik_id', $pemilik->id)->first();
                
                // Data umum untuk usaha
                $usahaData = [
                    'nama_usaha' => $validated['nama_usaha'],
                    'logo' => $logoPath ?? $usaha->logo ?? null, // Pertahankan logo lama jika tidak ada yang baru
                    'jenis_usaha_id' => $validated['jenis_usaha_id'],
                    'bentuk_usaha' => $validated['bentuk_usaha'],
                    'alamat_usaha' => $validated['alamat_usaha'],
                    'latitude' => $validated['latitude'] ?? null,
                    'longitude' => $validated['longitude'] ?? null,
                    'no_telp_usaha' => $validated['no_telp_usaha'],
                    'status_tempat' => $validated['status_tempat'],
                    'tenaga_kerja_l' => $validated['tenaga_kerja_l'] ?? 0,
                    'tenaga_kerja_p' => $validated['tenaga_kerja_p'] ?? 0,
                    
                    // Penting: Ketika data diperbarui, status harus direset menjadi 'unverified'
                    'status_umkm' => 'unverified', 
                    // Alasan tolak dikosongkan jika user submit form
                    'alasan_tolak' => null, 
                ];
                
                if ($usaha) {
                    // UPDATE Data Usaha yang sudah ada
                    $usaha->update($usahaData);
                } else {
                    // CREATE Data Usaha baru
                    $usahaData['pemilik_id'] = $pemilik->id; // Tambahkan Foreign Key
                    $usaha = DataUsaha::create($usahaData);
                }
                
                // Simpan Legalitas (Relasi Legalitas ke Data Usaha)
                LegalitasUsaha::updateOrCreate(
                    ['usaha_id' => $usaha->id], // Kriteria pencarian
                    [
                        'nib' => $validated['nib'] ?? null,
                        'iumk' => $validated['iumk'] ?? null,
                        'sertifikat_halal' => $validated['sertifikat_halal'] ?? null,
                        'sertifikat_merek' => $validated['sertifikat_merek'] ?? null,
                    ]
                );
            });
    
            // 4. Redirect ke halaman kelola UMKM
            return redirect()->route('kelola.umkm')->with('success', 'Data UMKM berhasil disimpan dan diajukan ulang! Menunggu verifikasi.');
            
        } catch (\Throwable $e) {
            // Log error untuk debugging
            Log::error('Gagal menyimpan data UMKM: ' . $e->getMessage());
            
            // Hapus logo yang mungkin sudah terupload jika transaksi gagal
            if ($logoPath && isset($usaha) && !$usaha) {
                Storage::disk('public')->delete($logoPath);
            }
            
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Pastikan semua input benar. Pesan Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Metode baru untuk mereset status UMKM menjadi 'unverified' dan mengosongkan alasan_tolak.
     * Dipanggil saat user mengklik 'Ajukan Pendaftaran Ulang' dari halaman ditolak.
     */
    public function resetStatus($usaha_id)
    {
        $user = Auth::user();
        
        // 1. Cari Pemilik UMKM berdasarkan user yang login (melalui email)
        $pemilik = PemilikUmkm::where('email', $user->email)->first();
        
        if (!$pemilik) {
            return back()->with('error', 'Data pemilik UMKM tidak ditemukan.');
        }
        
        // 2. Cari Data Usaha berdasarkan ID dan pastikan dimiliki oleh Pemilik ini (keamanan)
        $usaha = DataUsaha::where('id', $usaha_id)
                          ->where('pemilik_id', $pemilik->id)
                          ->first();

        if (!$usaha) {
            return back()->with('error', 'Data usaha tidak valid atau tidak ditemukan.');
        }

        // 3. Update status dan alasan
        $usaha->status_umkm = 'unverified';
        $usaha->alasan_tolak = null;
        $usaha->save();

        // 4. Redirect ke form pendaftaran agar user bisa langsung mengedit (jika perlu)
        return redirect()->route('umkm.form')->with('success', 'Status pendaftaran UMKM Anda berhasil diubah menjadi Menunggu Verifikasi. Silakan perbarui data Anda jika diperlukan.');
    }

    public function show($id)
    {
        // Ambil data usaha berdasarkan ID (misal tabel data_usaha)
        $usaha = \App\Models\DataUsaha::with(['pemilik', 'legalitasUsaha', 'jenisUsaha'])->findOrFail($id);

        return view('umkm.show', compact('usaha'));
    }
}