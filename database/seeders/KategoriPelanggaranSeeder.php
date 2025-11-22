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
                'dari_poin' => 1,
                'sampai_poin' => 3,
            ],
            [
                'nama_kategori' => 'Sedang',
                'dari_poin' => 4,
                'sampai_poin' => 6,
            ],
            [
                'nama_kategori' => 'Berat',
                'dari_poin' => 7,
                'sampai_poin' => 10,
            ],
        ]);
    }
}
