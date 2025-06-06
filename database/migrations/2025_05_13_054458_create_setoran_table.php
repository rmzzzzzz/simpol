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
       Schema::create('setoran', function (Blueprint $table) {
    $table->id('id_setoran');
    $table->unsignedBigInteger('pesanan_id');
    $table->bigInteger('nominal_uang');
    $table->bigInteger('denda')->nullable();
    $table->string('snap_token')->nullable();
    $table->enum('status', ['proses', 'gagal', 'berhasil'])->default('proses');
    $table->timestamps();

    $table->foreign('pesanan_id')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran');
    }
};
