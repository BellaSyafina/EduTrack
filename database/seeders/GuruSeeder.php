<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tabel_guru')->insert([
            [
                'nip' => '1987654321',
                'nama_guru' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Guru Matematika',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            ],
            [
                'nip' => '1987654322',
                'nama_guru' => 'Siti Aminah',
                'jenis_kelamin' => 'Perempuan',
                'jabatan' => 'Guru Bahasa Indonesia',
                'alamat' => 'Jl. Sudirman No. 20, Bandung',
            ],
            [
                'nip' => '1987654323',
                'nama_guru' => 'Andi Wijaya',
                'jenis_kelamin' => 'Laki-laki',
                'jabatan' => 'Guru IPA',
                'alamat' => 'Jl. Diponegoro No. 15, Surabaya',
            ],
        ]);
    }
}
