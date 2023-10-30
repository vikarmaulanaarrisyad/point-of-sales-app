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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe_transaksi', ['Masuk', 'Keluar']);
            $table->enum('jenis_transaksi',[1,2,3])->comment('1:pulsa, 2: token, 3:lainya');
            $table->integer('total_harga')->default(0);
            $table->string('metode_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
