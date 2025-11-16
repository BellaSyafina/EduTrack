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
                    'nama_kelas' => 'required|string|max:100',
                ],

                [
                    'nama_kelas.required' => 'Nama kelas wajib diisi.',
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
                    'nama_kelas' => 'required|string|max:100',
                ],

                [
                    'nama_kelas.required' => 'Nama kelas wajib diisi.',
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
            // Hapus data kelas
            Kelas::where('id_kelas', $id)->delete();

            return redirect('/kelas')->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
