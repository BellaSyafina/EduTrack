<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kelas',
        ];

        return view('admin.dataKelas.index', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Kelas',
        ];

        return view('admin.dataKelas.update', $data);
    }
}
