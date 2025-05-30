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
        Schema::create('distribusi', function (Blueprint $table) {
    $table->id('id_distribusi');
    $table->unsignedBigInteger('pesanan_id');
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('anggota_id');
    $table->enum('status', ['dikirim', 'selesai']);
    $table->timestamps();

    $table->foreign('pesanan_id')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('anggota_id')->references('id_anggota')->on('detail_anggota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distibusi');
    }
};
