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
       Schema::create('pesanan', function (Blueprint $table) {
    $table->id('id_pesanan');
    $table->unsignedBigInteger('detail_anggota_id');
    $table->unsignedBigInteger('produk_id');
    $table->integer('jumlah');
    $table->date('tanggal');
    $table->bigInteger('total');
    $table->timestamps();

    $table->foreign('detail_anggota_id')->references('id_anggota')->on('detail_anggota')->onDelete('cascade');
    $table->foreign('produk_id')->references('id_barang')->on('produk')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
