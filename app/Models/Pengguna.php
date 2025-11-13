<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'nama_pengguna',
        'username',
        'password',
        'role'
    ];

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_pengguna');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id_pengguna');
    }

    public function waliMurid()
    {
        return $this->hasOne(WaliMurid::class, 'id_pengguna');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'id_pengguna');
    }
}
