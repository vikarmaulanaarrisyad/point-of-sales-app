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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->unsignedBigInteger('pulsa_id')->nullable();
            $table->string('kode_pembelian')->nullable();
            $table->integer('jumlah_pembelian')->default(0);
            $table->integer('harga_satuan')->default(0);
            $table->integer('total_harga_pembelian')->default(0);
            $table->integer('saldo_pulsa')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
