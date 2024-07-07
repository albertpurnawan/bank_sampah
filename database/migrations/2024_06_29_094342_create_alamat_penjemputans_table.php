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
        Schema::create('alamat_penjemputans', function (Blueprint $table) {
            $table->id();
            $table->string('id_alamat_penjemputan');
            $table->string('id_jadwal_pengambilan')->references('id_jadwal_pengambilan')->on('jadwal_pengambilans');
            $table->string('id_setoran_sampah')->references('id_setoran_sampah')->on('setoran_sampahs');
            $table->string('nama');
            $table->string('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat_penjemputans');
    }
};
