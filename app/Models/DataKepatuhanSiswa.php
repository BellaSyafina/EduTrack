<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKepatuhanSiswa extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Data_Kepatuhan_Siswa';
    protected $primaryKey = 'id_data_kepatuhan_siswa';
    protected $fillable = [
        'id_siswa',
        'id_kepatuhan',
        'id_guru',
        'tanggal_kepatuhan',
        'keterangan_kepatuhan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function kepatuhan()
    {
        return $this->belongsTo(Kepatuhan::class, 'id_kepatuhan');
    }
}
