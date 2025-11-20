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
        Schema::create('Tabel_Wali_Murid_Siswa', function (Blueprint $table) {
            $table->id('id_wali_murid_siswa');
            $table->unsignedBigInteger('id_wali_murid');
            $table->unsignedBigInteger('id_siswa');

            $table->foreign('id_wali_murid')->references('id_wali_murid')->on('Tabel_Wali_Murid')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('Tabel_Siswa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Wali_Murid_Siswa');
    }
};
