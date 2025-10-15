<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::insert([
            [
                'judul' => 'Pelatihan Digital Marketing untuk UMKM',
                'isi' => 'Dinas Koperasi mengadakan pelatihan digital marketing bagi pelaku UMKM pada tanggal 20 Oktober 2025 di Aula Balai Kota.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Bantuan Modal Usaha Tahap II',
                'isi' => 'Program bantuan modal usaha tahap II telah dibuka. Pendaftaran dibuka hingga 31 Oktober 2025 melalui website resmi pemerintah kota.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Lomba Inovasi Produk UMKM 2025',
                'isi' => 'Ikuti lomba inovasi produk UMKM untuk memenangkan hadiah menarik dan pendampingan bisnis profesional.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
