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
    Schema::table('pelanggan', function (Blueprint $table) {
        $table->unsignedBigInteger('teknisi_id')->nullable()->after('paket');

        // Jika Anda ingin membuat foreign key untuk relasi
        $table->foreign('teknisi_id')->references('id')->on('teknisi')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            //
        });
    }
};
