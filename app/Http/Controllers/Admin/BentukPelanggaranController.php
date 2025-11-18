<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class BentukPelanggaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Bentuk Pelanggaran',
        ];

        return view('admin.bentukPelanggaran.index', $data);
    }
}
