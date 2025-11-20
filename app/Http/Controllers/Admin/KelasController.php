<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = [
            'kelas' => Kelas::all(),
            'title' => 'Data Kelas',
        ];

        return view('admin.dataKelas.index', $data);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nama_kelas' => 'required|string|max:100|unique:Tabel_Kelas,nama_kelas',
                ],

                [
                    'nama_kelas.required' => 'Nama kelas wajib diisi.',
                    'nama_kelas.unique' => 'Nama kelas sudah terdaftar.',
                ],
            );

            // Simpan data kelas baru
            Kelas::create($validatedData);

            return redirect('/kelas')->with('success', 'Data kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show($id)
    {
        $kelas = Kelas::where('id_kelas', $id)->first();
        $data = [
            'title' => 'Edit Kelas',
            'kelas' => $kelas,
        ];

        return view('admin.dataKelas.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nama_kelas' => 'required|string|max:100|unique:Tabel_Kelas,nama_kelas,' . $id . ',id_kelas',
                ],

                [
                    'nama_kelas.required' => 'Nama kelas wajib diisi.',
                    'nama_kelas.unique' => 'Nama kelas sudah terdaftar.',
                ],
            );

            // Update data kelas
            Kelas::where('id_kelas', $id)->update($validatedData);

            return redirect('/kelas')->with('success', 'Data kelas berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            // Ambil kelas
            $kelas = Kelas::where('id_kelas', $id)->first();

            if (!$kelas) {
                return redirect('/kelas')->withErrors(['error' => 'Kelas tidak ditemukan.']);
            }

            // Cek apakah kelas punya siswa
            $jumlahSiswa = $kelas->siswa()->count();

            if ($jumlahSiswa > 0) {
                return redirect()
                    ->back()
                    ->with(['error' => 'Kelas tidak dapat dihapus karena masih memiliki data siswa.']);
            }

            // Jika aman, hapus
            $kelas->delete();

            return redirect('/kelas')->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
