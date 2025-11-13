<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    protected $fillable = [
        'id_kategori_pelanggaran',
        'nama_pelanggaran',
        'deskripsi_pelanggaran',
        'bobot_poin'
    ];

    public function kategoriPelanggaran()
    {
        return $this->belongsTo(KategoriPelanggaran::class, 'id_kategori_pelanggaran');
    }

    public function dataPelanggaranSiswa()
    {
        return $this->hasMany(DataPelanggaranSiswa::class, 'id_pelanggaran');
    }

    public function sanksi()
    {
        return $this->belongsTo(Sanksi::class, 'id_pelanggaran');
    }
}
