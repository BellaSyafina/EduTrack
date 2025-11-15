<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tabel_kelas')->insert([
            [
                'nama_kelas' => 'Kelas VII - A',
            ],
            [
                'nama_kelas' => 'Kelas VII - B',
            ],
            [
                'nama_kelas' => 'Kelas VII - C',
            ],
            [
                'nama_kelas' => 'Kelas VII - D',
            ],
            [
                'nama_kelas' => 'Kelas VIII - A',
            ],
            [
                'nama_kelas' => 'Kelas VIII - B',
            ],
            [
                'nama_kelas' => 'Kelas VIII - C',
            ],
            [
                'nama_kelas' => 'Kelas IX - A',
            ],
            [
                'nama_kelas' => 'Kelas IX - B',
            ],
            [
                'nama_kelas' => 'Kelas IX - C',
            ],
            [
                'nama_kelas' => 'Kelas IX - D',
            ],
        ]);
    }
}
