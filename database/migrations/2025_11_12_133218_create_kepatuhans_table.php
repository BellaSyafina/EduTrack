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
        Schema::create('Tabel_Kepatuhan', function (Blueprint $table) {
            $table->id('id_kepatuhan');
            $table->unsignedBigInteger('id_kategori_kepatuhan');
            $table->string('nama_kepatuhan');
            $table->text('deskripsi_kepatuhan')->nullable();
            $table->integer('bobot_poin')->default(0);
            $table->foreign('id_kategori_kepatuhan')->references('id_kategori_kepatuhan')->on('Tabel_Kategori_Kepatuhan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Kepatuhan');
    }
};
