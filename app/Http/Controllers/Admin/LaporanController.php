<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporann;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan',
        ];

        return view('admin.laporan.index', $data);
    }
}
