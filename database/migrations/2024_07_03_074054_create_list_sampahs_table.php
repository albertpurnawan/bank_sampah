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
        Schema::create('list_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('id_list_sampah');
            $table->string('id_setoran_sampah');
            $table->string('id_penjualan')->nullable();
            $table->string('id_jenis_sampah');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_sampahs');
    }
};
