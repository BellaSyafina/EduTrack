<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaliMuridController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Wali Murid',
        ];

        return view('admin.dataWaliMurid.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Wali Murid',
        ];

        return view('admin.dataWaliMurid.create', $data);
    }

    public function show()
    {
        $data = [
            'title' => 'Edit Wali Murid',
        ];

        return view('admin.dataWaliMurid.update', $data);
    }

    public function siswa()
    {
        $data = [
            'title' => 'Data Siswa Wali Murid',
        ];

        return view('admin.dataWaliMurid.siswa', $data);
    }
}
