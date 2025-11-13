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
        Schema::create('Tabel_Data_Pelanggaran_Siswa', function (Blueprint $table) {
            $table->id('id_data_pelanggaran');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_pelanggaran');
            $table->unsignedBigInteger('id_guru');
            $table->date('tanggal_pelanggaran');
            $table->text('keterangan_pelanggaran')->nullable();

            $table->foreign('id_siswa')->references('id_siswa')->on('Tabel_Siswa')->onDelete('cascade');
            $table->foreign('id_pelanggaran')->references('id_pelanggaran')->on('Tabel_Pelanggaran')->onDelete('cascade');
            $table->foreign('id_guru')->references('id_guru')->on('Tabel_Guru')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Data_Pelanggaran_Siswa');
    }
};
