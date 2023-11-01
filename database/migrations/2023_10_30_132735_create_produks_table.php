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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->string('nama_produk');
            $table->integer('harga_jual')->default(0);
            $table->integer('harga_beli')->default(0);
            $table->integer('stok_awal')->default(0);
            $table->integer('stok_akhir')->default(0);
            $table->integer('stok_saat_ini')->default(0);
            $table->integer('laba')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
