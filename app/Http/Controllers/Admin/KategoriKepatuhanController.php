<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPelanggaran;
use Illuminate\Http\Request;

class KategoriKepatuhanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Kepatuhan',
        ];

        return view('admin.kategoriKepatuhan.index', $data);
    }
}
