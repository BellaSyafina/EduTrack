<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sanksi;
use Illuminate\Http\Request;

class SanksiPelanggaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sanksi Pelanggaran',
        ];

        return view('admin.sanksiPelanggaran.index', $data);
    }
}
