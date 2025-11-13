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
        Schema::create('Tabel_Laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_pengguna');
            $table->integer('total_poin')->default(0);
            $table->string('status')->nullable();
            $table->date('tanggal_cetak')->nullable();
            $table->string('jenis')->nullable();
            $table->string('periode')->nullable();

            $table->foreign('id_siswa')->references('id_siswa')->on('Tabel_Siswa')->onDelete('cascade');
            $table->foreign('id_pengguna')->references('id_pengguna')->on('Tabel_Pengguna')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Laporan');
    }
};
