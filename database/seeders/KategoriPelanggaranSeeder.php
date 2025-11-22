<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Tabel_Kategori_Pelanggaran')->insert([
            [
                'nama_kategori' => 'Ringan',
            ],
            [
                'nama_kategori' => 'Sedang',
            ],
            [
                'nama_kategori' => 'Berat',
            ],
        ]);
    }
}
