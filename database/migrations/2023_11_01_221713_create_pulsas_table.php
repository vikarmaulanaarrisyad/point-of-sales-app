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
        Schema::create('pulsas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('nominal');
            $table->integer('harga_beli')->default(0);
            $table->integer('harga_jual')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->cascadeOnDelete()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pulsas');
    }
};
