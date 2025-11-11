<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'username' => 'wali_kelas',
                'email' => 'walikelas@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'wali kelas',
                'email_verified_at' => now(),
            ],
            [
                'username' => 'wali_murid',
                'email' => 'walimurid@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'wali murid',
                'email_verified_at' => now(),
            ],
        ]);
    }
}
