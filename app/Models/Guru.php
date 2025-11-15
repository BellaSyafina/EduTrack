<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Guru';
    protected $primaryKey = 'id_guru';
    protected $guarded = ['id_guru'];

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
