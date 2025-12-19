<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_usaha', function (Blueprint $table) {
            $table->string('link_shopee')->nullable()->after('tenaga_kerja_p');
            $table->string('link_grab')->nullable()->after('link_shopee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('data_usaha', function (Blueprint $table) {
            $table->dropColumn(['link_shopee', 'link_grab']);
        });
    }
};
