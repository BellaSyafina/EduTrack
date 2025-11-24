<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputSiswa extends Model
{
    protected $table = 'Tabel_Input_Siswa';
    protected $primaryKey = 'id_input_siswa';
    protected $guarded = ['id_input_siswa'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kepatuhan()
    {
        return $this->belongsTo(Kepatuhan::class, 'id_kepatuhan', 'id_kepatuhan');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id_pelanggaran');
    }
}
