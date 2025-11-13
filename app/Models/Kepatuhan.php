<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepatuhan extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Kepatuhan';
    protected $primaryKey = 'id_kepatuhan';
    protected $fillable = [
        'id_kategori_kepatuhan',
        'nama_kepatuhan',
        'deskripsi_kepatuhan',
        'bobot_poin'
    ];

    public function kategoriKepatuhan()
    {
        return $this->belongsTo(KategoriKepatuhan::class, 'id_kategori_kepatuhan');
    }

    public function dataKepatuhanSiswa()
    {
        return $this->hasMany(DataKepatuhanSiswa::class, 'id_kepatuhan');
    }
}
