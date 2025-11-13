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
        Schema::create('Tabel_Pelanggaran', function (Blueprint $table) {
            $table->id('id_pelanggaran');
            $table->unsignedBigInteger('id_kategori_pelanggaran');
            $table->string('nama_pelanggaran');
            $table->text('deskripsi_pelanggaran')->nullable();
            $table->integer('bobot_poin')->default(0);
            $table->foreign('id_kategori_pelanggaran')->references('id_kategori_pelanggaran')->on('Tabel_Kategori_Pelanggaran')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Pelanggaran');
    }
};
