<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanksi extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Sanksi';
    protected $primaryKey = 'id_sanksi';
    protected $fillable = [
        'id_pelanggaran',
        'nama_sanksi',
        'keterangan'
    ];

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class, 'id_pelanggaran');
    }
}
