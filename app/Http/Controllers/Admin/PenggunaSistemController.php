<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PenggunaSistemController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengguna Sistem',
        ];

        return view('admin.penggunaSistem.index', $data);
    }
}
