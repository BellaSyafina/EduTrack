<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    protected $guarded = ['id_pelanggaran'];

    public function kategoriPelanggaran()
    {
        return $this->belongsTo(KategoriPelanggaran::class, 'id_kategori_pelanggaran');
    }

    public function sanksi()
    {
        return $this->belongsTo(Sanksi::class, 'id_pelanggaran');
    }

    public function inputSiswas()
    {
        return $this->hasMany(InputSiswa::class, 'id_pelanggaran', 'id_pelanggaran');
    }
}
