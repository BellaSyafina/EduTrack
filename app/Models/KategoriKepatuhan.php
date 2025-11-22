<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKepatuhan extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Kategori_Kepatuhan';
    protected $primaryKey = 'id_kategori_kepatuhan';
    protected $guarded = ['id_kategori_kepatuhan'];

    public function kepatuhan()
    {
        return $this->hasMany(Kepatuhan::class, 'id_kategori_kepatuhan');
    }
}
