<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_usaha', function (Blueprint $table) {
            $table->string('jam_buka')->nullable()->default('08:00');
            $table->string('jam_tutup')->nullable()->default('20:00');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_usaha', function (Blueprint $table) {
            //
        });
    }
};
