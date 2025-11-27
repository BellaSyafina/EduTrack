<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'Tabel_Wali_Kelas';
    protected $primaryKey = 'id_wali_kelas';
    protected $guarded = ['id_wali_kelas'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
