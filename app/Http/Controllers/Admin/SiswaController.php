<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Siswa',
        ];

        return view('admin.dataSiswa.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Siswa',
        ];

        return view('admin.dataSiswa.create', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Siswa',
        ];

        return view('admin.dataSiswa.update', $data);
    }
}
