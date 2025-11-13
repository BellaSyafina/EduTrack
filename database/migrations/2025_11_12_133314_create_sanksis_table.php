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
        Schema::create('Tabel_Sanksi', function (Blueprint $table) {
            $table->id('id_sanksi');
            $table->unsignedBigInteger('id_pelanggaran');
            $table->string('nama_sanksi');
            $table->text('keterangan')->nullable();
            $table->foreign('id_pelanggaran')->references('id_pelanggaran')->on('Tabel_Pelanggaran')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Sanksi');
    }
};
