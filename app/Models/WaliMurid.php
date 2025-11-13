<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Wali_Murid';
    protected $primaryKey = 'id_wali_murid';
    protected $fillable = [
        'nama_wali_murid',
        'no_hp',
        'alamat',
        'id_siswa',
        'id_pengguna'
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
