<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Laporan';
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'id_siswa',
        'id_pengguna',
        'total_poin',
        'status',
        'tanggal_cetak',
        'jenis',
        'periode'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}
