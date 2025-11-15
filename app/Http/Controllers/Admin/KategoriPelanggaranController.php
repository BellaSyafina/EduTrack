<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriPelanggaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Pelanggaran',
        ];

        return view('admin.kategoriPelanggaran.index', $data);
    }
}
