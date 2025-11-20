<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Siswa';
    protected $primaryKey = 'id_siswa';
    protected $guarded = ['id_siswa'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function waliMuridSiswa()
    {
        return $this->hasMany(WaliMuridSiswa::class, 'id_siswa');
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
