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
        Schema::create('setoran_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('id_setoran_sampah');
            $table->string('id_tipe_setoran')->references('id_tipe_setoran')->on('tipe_setorans');
            $table->string('id_user')->references('id_user')->on('users');
            $table->string('nama');
            $table->date('tanggal');
            $table->string('nomor');
            $table->string('status');
            $table->string('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran_sampahs');
    }
};
