<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Kategori_Pelanggaran';
    protected $primaryKey = 'id_kategori_pelanggaran';
    protected $fillable = ['nama_kategori'];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_kategori_pelanggaran');
    }

    public function sanksi()
    {
        return $this->hasMany(Sanksi::class, 'id_kategori_pelanggaran');
    }
}
