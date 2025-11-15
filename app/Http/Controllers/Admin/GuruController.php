<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $data = [
            'guru' => Guru::all(),
            'title' => 'Data Guru',
        ];

        return view('admin.dataGuru.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Guru',
        ];

        return view('admin.dataGuru.create', $data);
    }

    public function show()
    {
        $data = [
            'title' => 'Edit Guru',
        ];

        return view('admin.dataGuru.update', $data);
    }
}
