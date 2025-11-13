<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggaranSiswa extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Data_Pelanggaran_Siswa';
    protected $primaryKey = 'id_data_pelanggaran_siswa';
    protected $fillable = [
        'id_siswa',
        'id_pelanggaran',
        'id_guru',
        'tanggal_pelanggaran',
        'keterangan_pelanggaran'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran');
    }
}
