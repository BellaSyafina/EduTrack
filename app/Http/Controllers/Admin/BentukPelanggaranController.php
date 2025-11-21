<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class BentukPelanggaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Bentuk Pelanggaran',
            'kategori' => KategoriPelanggaran::with('pelanggaran')->get(),
        ];

        return view('admin.bentukPelanggaran.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Bentuk Pelanggaran',
            'kategori' => KategoriPelanggaran::all(),
        ];

        return view('admin.bentukPelanggaran.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(
                [
                    'id_kategori_pelanggaran' => 'required|exists:Tabel_Kategori_Pelanggaran,id_kategori_pelanggaran',
                    'nama_pelanggaran' => 'required|string|max:255|unique:Tabel_Pelanggaran,nama_pelanggaran',
                    'bobot_poin' => 'required|integer',
                ],
                [
                    'id_kategori_pelanggaran.required' => 'Kategori pelanggaran wajib diisi.',
                    'id_kategori_pelanggaran.exists' => 'Kategori pelanggaran tidak valid.',
                    'nama_pelanggaran.required' => 'Nama pelanggaran wajib diisi.',
                    'nama_pelanggaran.string' => 'Nama pelanggaran harus berupa teks.',
                    'nama_pelanggaran.max' => 'Nama pelanggaran maksimal 255 karakter.',
                    'nama_pelanggaran.unique' => 'Nama pelanggaran sudah terdaftar.',
                    'bobot_poin.required' => 'Bobot poin wajib diisi.',
                    'bobot_poin.integer' => 'Bobot poin harus berupa angka bulat.',
                ],
            );

            Pelanggaran::create($validatedData);

            return redirect()->route('bentuk-pelanggaran.index')->with('success', 'Bentuk pelanggaran berhasil ditambahkan.')->with('kategori_id', $request->id_kategori_pelanggaran);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $pelanggaran = Pelanggaran::with('kategoriPelanggaran')->where('id_pelanggaran', $id)->first();

        $data = [
            'title' => 'Edit Bentuk Pelanggaran',
            'pelanggaran' => $pelanggaran,
            'kategori' => KategoriPelanggaran::all(),
        ];

        return view('admin.bentukPelanggaran.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate(
                [
                    'id_kategori_pelanggaran' => 'required|exists:Tabel_Kategori_Pelanggaran,id_kategori_pelanggaran',
                    'nama_pelanggaran' => 'required|string|max:255|unique:Tabel_Pelanggaran,nama_pelanggaran,' . $id . ',id_pelanggaran',
                    'bobot_poin' => 'required|integer',
                ],
                [
                    'id_kategori_pelanggaran.required' => 'Kategori pelanggaran wajib diisi.',
                    'id_kategori_pelanggaran.exists' => 'Kategori pelanggaran tidak valid.',
                    'nama_pelanggaran.required' => 'Nama pelanggaran wajib diisi.',
                    'nama_pelanggaran.string' => 'Nama pelanggaran harus berupa teks.',
                    'nama_pelanggaran.max' => 'Nama pelanggaran maksimal 255 karakter.',
                    'nama_pelanggaran.unique' => 'Nama pelanggaran sudah terdaftar.',
                    'bobot_poin.required' => 'Bobot poin wajib diisi.',
                    'bobot_poin.integer' => 'Bobot poin harus berupa angka bulat.',
                ],
            );

            Pelanggaran::where('id_pelanggaran', $id)->update($validatedData);

            return redirect()->route('bentuk-pelanggaran.index')->with('success', 'Bentuk pelanggaran berhasil diperbarui.')->with('kategori_id', $request->id_kategori_pelanggaran);
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
            // Ambil data pelanggaran terlebih dahulu
            $pelanggaran = Pelanggaran::where('id_pelanggaran', $id)->firstOrFail();

            // Simpan kategori untuk alert
            $kategoriId = $pelanggaran->id_kategori_pelanggaran;

            // Hapus data pelanggaran
            $pelanggaran->delete();

            return redirect()->route('bentuk-pelanggaran.index')->with('success', 'Bentuk pelanggaran berhasil dihapus.')->with('kategori_id', $kategoriId);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
