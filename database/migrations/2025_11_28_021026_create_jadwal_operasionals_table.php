<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_operasionals', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel data_usaha
            // Pastikan nama tabel di database kamu benar 'data_usaha'
            $table->foreignId('data_usaha_id')
                  ->constrained('data_usaha') 
                  ->onDelete('cascade'); // Kalau usaha dihapus, jadwal ikut terhapus
            
            $table->time('jam_buka')->nullable();  // Contoh: 08:00
            $table->time('jam_tutup')->nullable(); // Contoh: 21:00
            $table->string('hari_libur')->nullable(); // Contoh: "Sabtu, Minggu"
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_operasionals');
    }
};