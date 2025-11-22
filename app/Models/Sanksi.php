<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanksi extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Sanksi';
    protected $primaryKey = 'id_sanksi';
    protected $guarded = ['id_sanksi'];

    public function kategoriPelanggaran()
    {
        return $this->belongsTo(KategoriPelanggaran::class, 'id_kategori_pelanggaran');
    }
}
