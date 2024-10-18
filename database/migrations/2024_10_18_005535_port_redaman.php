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
        Schema::create('port_redaman', function (Blueprint $table) {
            $table->id();
            $table->string('port', 100);
            $table->string('redaman', 100);
            $table->integer('id_pelanggan');
            $table->string('nama', 100);
            $table->string('alamat', 255);
            $table->string('paket', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_redaman');
    }
};
