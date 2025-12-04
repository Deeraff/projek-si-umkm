<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_operasionals', function (Blueprint $table) {
            // Menambahkan 2 kolom tanggal baru
            $table->date('tgl_libur_mulai')->nullable()->after('hari_libur');
            $table->date('tgl_libur_selesai')->nullable()->after('tgl_libur_mulai');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_operasionals', function (Blueprint $table) {
            $table->dropColumn(['tgl_libur_mulai', 'tgl_libur_selesai']);
        });
    }
};