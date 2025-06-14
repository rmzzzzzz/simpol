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
       Schema::create('produk', function (Blueprint $table) {
    $table->id('id_barang');
    $table->unsignedBigInteger('kategori_id');
    $table->string('nama_produk');
    $table->bigInteger('harga');
    $table->string('foto');
    $table->timestamps();

    $table->foreign('kategori_id')->references('id_kategori')->on('kategori')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
