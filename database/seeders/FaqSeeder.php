<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::insert([
            [
                'pertanyaan' => 'Apa itu Sistem Informasi UMKM?',
                'jawaban' => 'Sistem ini digunakan untuk mendata dan memantau perkembangan UMKM secara digital.',
            ],
            [
                'pertanyaan' => 'Siapa saja yang bisa menggunakan sistem ini?',
                'jawaban' => 'Pelaku UMKM, dinas terkait, dan masyarakat umum.',
            ],
            [
                'pertanyaan' => 'Bagaimana cara mendaftar sebagai Pelaku UMKM?',
                'jawaban' => 'Cukup daftar melalui menu registrasi dengan mengisi data usaha lengkap.',
            ],
            [
                'pertanyaan' => 'Apakah data UMKM aman di sistem ini?',
                'jawaban' => 'Ya, data disimpan aman dan hanya bisa diakses oleh pihak berwenang.',
            ],
        ]);
    }
}
