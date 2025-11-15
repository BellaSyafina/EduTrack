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
                'nama_kelas' => 'Kelas 10 IPA 1',
            ],
            [
                'nama_kelas' => 'Kelas 10 IPA 2',
            ],
            [
                'nama_kelas' => 'Kelas 11 IPS 1',
            ],
            [
                'nama_kelas' => 'Kelas 12 Bahasa 1',
            ],
        ]);
    }
}
