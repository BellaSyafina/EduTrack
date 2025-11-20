<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliMuridSiswa extends Model
{
    protected $table = 'Tabel_Wali_Murid_Siswa';
    protected $primaryKey = 'id_wali_murid_siswa';
    protected $guarded = ['id_wali_murid_siswa'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
