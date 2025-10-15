<?php

namespace App\Http\Controllers;

use App\Models\Message; // Wajib: Untuk berinteraksi dengan tabel 'messages'
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menyimpan pesan baru yang dikirim dari form kontak.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ], [
            // Pesan error kustom (Opsional, tapi direkomendasikan)
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
        ]);

        try {
            // 2. Simpan data ke database menggunakan Model Message
            // (Memerlukan $fillable di Model Message.php)
            Message::create($validatedData);

            // 3. Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirimkan!');

        } catch (\Exception $e) {
            // Jika terjadi error (misalnya koneksi database), kembali dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
        }
    }
}
