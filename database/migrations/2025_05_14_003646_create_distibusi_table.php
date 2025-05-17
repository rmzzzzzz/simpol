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
        Schema::create('distibusi', function (Blueprint $table) {
    $table->id('id_distribusi');
    $table->unsignedBigInteger('pesanan_id');
    $table->enum('status', ['dikirim', 'selesai']);
    $table->timestamps();

    $table->foreign('pesanan_id')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
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
