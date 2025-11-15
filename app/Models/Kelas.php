<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Kelas';
    protected $primaryKey = 'id_kelas';
    protected $guarded = ['id_kelas'];
}
