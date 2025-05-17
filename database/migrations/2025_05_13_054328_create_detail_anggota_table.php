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
        Schema::create('detail_anggota', function (Blueprint $table) {
            $table->id('id_anggota');
    $table->unsignedBigInteger('user_id');
    $table->string('nama_anggota');
    $table->string('alamat');
    $table->string('no_hp', 16);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_anggota');
    }
};
