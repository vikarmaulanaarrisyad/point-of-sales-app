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
        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->foreign('transaksi_id')
                ->references('id')
                ->on('transaksis')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('produk_id')
                ->references('id')
                ->on('produks')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_details', function (Blueprint $table) {
            $table->dropForeign('transaksi_details_transaksi_id_foreign');
            $table->dropForeign('transaksi_details_produk_id_foreign');
        });
    }
};
