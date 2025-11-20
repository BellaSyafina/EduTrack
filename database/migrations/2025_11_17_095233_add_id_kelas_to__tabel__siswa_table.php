<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('Tabel_Siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kelas')->after('id_siswa');

            $table->foreign('id_kelas')->references('id_kelas')->on('Tabel_Kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Tabel_Siswa', function (Blueprint $table) {
            // Drop foreign keys berdasarkan kolom
            $table->dropForeign(['id_kelas']);

            // Drop kolom
            $table->dropColumn(['id_kelas']);
        });
    }
};
