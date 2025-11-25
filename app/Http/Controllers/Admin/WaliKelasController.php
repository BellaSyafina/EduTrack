<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Wali Kelas',
            'waliKelas' => WaliKelas::with(['user', 'guru'])->get(),
            'guru' => Guru::all(),
        ];

        return view('admin.waliKelas.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'id_guru' => 'required|unique:Tabel_Wali_Kelas,id_guru',
            ],
            [
                'id_guru.required' => 'Guru wajib dipilih.',
                'id_guru.unique' => 'Guru ini sudah menjadi wali kelas.',
            ],
        );

        try {
            $guru = Guru::where('id_guru', $request->id_guru)->first();

            // cek apakah user sudah ada
            $user = User::where('email', strtolower(str_replace(' ', '.', $guru->nama_guru)) . '@edutrack.com')->first();

            // kalau belum ada, buat
            if (!$user) {
                $user = User::create([
                    'username' => $guru->nama_guru,
                    'email' => strtolower(str_replace(' ', '.', $guru->nama_guru)) . '@edutrack.com',
                    'password' => bcrypt($guru->nip),
                    'dummy_password' => $guru->nip,
                    'role' => 'Wali Kelas',
                ]);
            }

            WaliKelas::create([
                'id_user' => $user->id,
                'id_guru' => $request->id_guru,
            ]);

            $guru->update([
                'jabatan' => 'Wali Kelas',
            ]);

            return back()->with('success', 'Wali Kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $waliKelas = WaliKelas::where('id_wali_kelas', $id)->first();
            $userId = $waliKelas->id_user;

            // Hapus wali kelas
            $waliKelas->delete();

            // Hapus user terkait
            User::where('id', $userId)->delete();

            return back()->with('success', 'Wali Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
