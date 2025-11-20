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
        $request->validate(
            [
                'nama_wali_murid' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15|unique:Tabel_Wali_Murid,no_hp',
                'alamat' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ],
            [
                'nama_wali_murid.required' => 'Nama wali murid wajib diisi.',
                'nama_wali_murid.string' => 'Nama wali murid harus berupa teks.',
                'nama_wali_murid.max' => 'Nama wali murid maksimal 255 karakter.',

                'no_hp.required' => 'Nomor HP wajib diisi.',
                'no_hp.string' => 'Nomor HP harus berupa teks.',
                'no_hp.max' => 'Nomor HP maksimal 15 karakter.',
                'no_hp.unique' => 'Nomor HP sudah terdaftar.',

                'alamat.required' => 'Alamat wajib diisi.',
                'alamat.string' => 'Alamat harus berupa teks.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
            ],
        );

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
        $waliMurid = WaliMurid::with('user')->where('id_wali_murid', $id)->firstOrFail();
        $idUser = $waliMurid->id_user;

        // VALIDASI (jangan taruh dalam try)
        $request->validate(
            [
                'nama_wali_murid' => 'required|string|max:255',

                'no_hp' => 'required|string|max:15|unique:Tabel_Wali_Murid,no_hp,' . $id . ',id_wali_murid',

                'alamat' => 'required|string',

                'email' => 'required|email|unique:users,email,' . $idUser . ',id',
            ],
            [
                'nama_wali_murid.required' => 'Nama wali murid wajib diisi.',
                'no_hp.required' => 'Nomor HP wajib diisi.',
                'no_hp.unique' => 'Nomor HP sudah terdaftar.',
                'alamat.required' => 'Alamat wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
            ],
        );

        // PROSES UPDATE DALAM TRY-CATCH (validasi dilewati)
        try {
            // Update user
            $user = $waliMurid->user;
            $user->email = $request->email;
            $user->save();

            // Update wali murid
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
            'id_siswa' => 'required',
        ]);

        $coba = WaliMuridSiswa::create([
            'id_siswa' => $request->id_siswa,
            'id_wali_murid' => $waliMurid->id_wali_murid,
        ]);

        return back()->with('success', 'Berhasil Menambahkan Siswa untuk Wali Murid ' . $waliMurid->nama);
    }

    public function destroySiswa($waliMuridId, $id)
    {
        $relation = WaliMuridSiswa::where('id_wali_murid_siswa', $id)->where('id_wali_murid', $waliMuridId)->firstOrFail();

        $relation->delete();

        return back()->with('success', 'Relasi Wali Murid dan Siswa berhasil dihapus.');
    }

    public function destroy($id)
    {
        $waliMurid = WaliMurid::with('siswa')->where('id_wali_murid', $id)->firstOrFail();

        // Cek apakah wali murid memiliki siswa
        if ($waliMurid->siswa->count() > 0) {
            return redirect()
                ->back()
                ->with(['error' => 'Wali murid tidak dapat dihapus karena masih memiliki siswa.']);
        }

        // Jika tidak ada siswa, hapus data wali murid + user-nya
        $waliMurid->delete();

        return redirect('/wali-murid')->with('success', 'Data wali murid berhasil dihapus.');
    }
}
