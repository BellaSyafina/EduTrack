<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\WaliMurid;
use App\Models\WaliMuridSiswa;
use Illuminate\Http\Request;

class WaliMuridController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Wali Murid',
            'waliMurid' => WaliMurid::with('user')->get(),
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

    public function store(Request $request)
    {
        $request->validate([
            'nama_wali_murid' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        try {
            // Buat user dulu
            $user = User::create([
                'username' => $request->nama_wali_murid,
                'email' => $request->email,
                'password' => bcrypt('12345678'),
                'dummy_password' => '12345678',
                'role' => 'Wali Murid',
            ]);

            // Buat data wali murid dengan id_user otomatis
            WaliMurid::create([
                'nama_wali_murid' => $request->nama_wali_murid,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'id_user' => $user->id, // otomatis!
            ]);

            return redirect()->route('wali-murid.index')->with('success', 'Wali Murid berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan wali murid: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $WaliMurid = WaliMurid::with('user')->where('id_wali_murid', $id)->firstOrFail();

        $data = [
            'title' => 'Edit Wali Murid',
            'waliMurid' => $WaliMurid,
        ];

        return view('admin.dataWaliMurid.update', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_wali_murid' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'email' => 'required|email',
        ]);

        try {
            $waliMurid = WaliMurid::with('user')->where('id_wali_murid', $id)->firstOrFail();

            // Update data user terkait
            $user = $waliMurid->user;
            $user->email = $request->email;
            $user->save();

            // Update data wali murid
            $waliMurid->nama_wali_murid = $request->nama_wali_murid;
            $waliMurid->no_hp = $request->no_hp;
            $waliMurid->alamat = $request->alamat;
            $waliMurid->save();

            return redirect()->route('wali-murid.index')->with('success', 'Wali Murid berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengupdate wali murid: ' . $e->getMessage());
        }
    }

    public function siswa($id)
    {
        $WaliMurid = WaliMurid::with('user')->where('id_wali_murid', $id)->firstOrFail();

        $data = [
            'title' => 'Data Siswa Wali Murid',
            'waliMurid' => $WaliMurid,
            'WaliMuridSiswa' => WaliMuridSiswa::where('id_wali_murid', $WaliMurid->id_wali_murid)->with('siswa')->get(),
            'siswa' => Siswa::all(),
        ];

        return view('admin.dataWaliMurid.siswa', $data);
    }

    public function actionSiswa(Request $request, $id)
    {
        $waliMurid = WaliMurid::where('id_wali_murid', $id)->first();

        $request->validate([
            'id_siswa' => 'required'
        ]);

        $coba = WaliMuridSiswa::create([
            'id_siswa' => $request->id_siswa,
            'id_wali_murid' => $waliMurid->id_wali_murid
        ]);

        return back()->with('success', 'Berhasil Menambahkan Siswa untuk Wali Murid ' . $waliMurid->nama);
    }

    public function destroySiswa($waliMuridId, $id)
    {
        $relation = WaliMuridSiswa::where('id_wali_murid_siswa', $id)
            ->where('id_wali_murid', $waliMuridId)
            ->firstOrFail();

        $relation->delete();

        return back()->with('success', 'Relasi Wali Murid dan Siswa berhasil dihapus.');
    }
}
