<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil data user login
        $user = Auth::user();

        return view('admin.profile.index', [
            'user'  => $user,
            'title' => 'Profil Pengguna'
        ]);
    }
}
