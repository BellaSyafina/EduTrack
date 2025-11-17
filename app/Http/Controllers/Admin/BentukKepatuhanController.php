<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPelanggaran;
use Illuminate\Http\Request;

class BentukKepatuhanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Bentuk Kepatuhan',
        ];

        return view('admin.bentukKepatuhan.index', $data);
    }
}
