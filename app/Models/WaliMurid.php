<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliMurid extends Model
{
    use HasFactory;

    protected $table = 'Tabel_Wali_Murid';
    protected $primaryKey = 'id_wali_murid';
    protected $guarded = ['id_wali_murid'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
