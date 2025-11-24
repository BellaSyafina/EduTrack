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
        Schema::create('Tabel_Input_Siswa', function (Blueprint $table) {
            $table->id('id_input_siswa');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kepatuhan')->nullable();
            $table->unsignedBigInteger('id_pelanggaran')->nullable();
            $table->integer('bobot_poin')->default(0);

            $table->foreign('id_siswa')->references('id_siswa')->on('Tabel_Siswa')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kepatuhan')->references('id_kepatuhan')->on('Tabel_Kepatuhan')->onDelete('set null');
            $table->foreign('id_pelanggaran')->references('id_pelanggaran')->on('Tabel_Pelanggaran')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tabel_Input_Siswa');
    }
};
