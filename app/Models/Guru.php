<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Guru';
    protected $primaryKey = 'id_guru';
    protected $fillable = [
        'nip',
        'nama_guru',
        'jenis_kelamin',
        'jabatan',
        'alamat',
        'id_pengguna'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_guru');
    }

    public function dataKepatuhanSiswa()
    {
        return $this->hasMany(DataKepatuhanSiswa::class, 'id_guru');
    }

    public function dataPelanggaranSiswa()
    {
        return $this->hasMany(DataPelanggaranSiswa::class, 'id_guru');
    }
}
