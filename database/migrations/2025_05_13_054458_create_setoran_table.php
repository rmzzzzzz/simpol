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
    $table->string('nominal_uang');
    $table->date('tanggal');
    $table->integer('total_setoran');
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
