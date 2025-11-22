<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriKepatuhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Tabel_Kategori_Kepatuhan')->insert([
            [
                'nama_kategori' => 'Akademik',
            ],
            [
                'nama_kategori' => 'Non-Akademik',
            ],
        ]);
    }
}
