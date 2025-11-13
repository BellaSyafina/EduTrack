<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = [
        'nis',
        'nama_siswa',
        'jenis_kelamin',
        'kelas',
        'alamat',
        'status'
    ];

    public function waliMurid()
    {
        return $this->hasOne(WaliMurid::class, 'id_siswa');
    }

    public function dataKepatuhanSiswa()
    {
        return $this->hasMany(DataKepatuhanSiswa::class, 'id_siswa');
    }

    public function dataPelanggaranSiswa()
    {
        return $this->hasMany(DataPelanggaranSiswa::class, 'id_siswa');
    }
}
