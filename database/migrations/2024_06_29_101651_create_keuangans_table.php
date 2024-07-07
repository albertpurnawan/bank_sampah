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
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->string('id_keuangan');
            $table->string('id_user')->references('id_user')->on('users');
            $table->string('nama_lengkap_rekening');
            $table->string('tipe_penarikan');
            $table->string('nomor_rekening')->nullable();
            $table->string('nomor')->nullable();
            $table->string('bank')->nullable();
            $table->integer('saldo');
            $table->string('status');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
