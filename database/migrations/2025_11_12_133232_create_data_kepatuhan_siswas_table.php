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
        Schema::create('Tabel_Data_Kepatuhan_Siswa', function (Blueprint $table) {
            $table->id('id_data_kepatuhan');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_kepatuhan');
            $table->unsignedBigInteger('id_guru');
            $table->date('tanggal_kepatuhan');
            $table->text('keterangan_kepatuhan')->nullable();

            $table->foreign('id_siswa')->references('id_siswa')->on('Tabel_Siswa')->onDelete('cascade');
            $table->foreign('id_kepatuhan')->references('id_kepatuhan')->on('Tabel_Kepatuhan')->onDelete('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('Tabel_Guru')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Data_Kepatuhan_Siswa');
    }
};
