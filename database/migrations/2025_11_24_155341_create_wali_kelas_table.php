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
        Schema::create('Tabel_Wali_Kelas', function (Blueprint $table) {
            $table->id('id_wali_kelas');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_kelas');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('Tabel_Guru')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('Tabel_Kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Wali_Kelas');
    }
};
