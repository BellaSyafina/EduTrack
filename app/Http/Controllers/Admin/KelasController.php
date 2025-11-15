<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = [
            'kelas' => Kelas::all(),
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
