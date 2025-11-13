<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKepatuhan extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Kategori_Kepatuhan';
    protected $primaryKey = 'id_kategori_kepatuhan';
    protected $fillable = ['nama_kategori'];

    public function kepatuhan()
    {
        return $this->hasMany(Kepatuhan::class, 'id_kategori_kepatuhan');
    }
}
