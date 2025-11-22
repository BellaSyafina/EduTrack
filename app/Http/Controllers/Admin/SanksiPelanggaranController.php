<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPelanggaran;
use App\Models\Sanksi;
use Illuminate\Http\Request;

class SanksiPelanggaranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sanksi Pelanggaran',
            'kategori' => KategoriPelanggaran::with('sanksi')->get(),
        ];

        return view('admin.sanksiPelanggaran.index', $data);
    }

    public function destroy($id)
    {
        try {
            $sanksi = Sanksi::where('id_sanksi', $id)->first();

            $kategoriId = $sanksi->id_kategori_pelanggaran;

            $sanksi->delete();

            return back()->with('success', 'Sanksi berhasil dihapus.')->with('kategori_id', $kategoriId);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Sanksi Pelanggaran',
            'kategori' => KategoriPelanggaran::all(),
        ];

        return view('admin.sanksiPelanggaran.create', $data);
    }

    public function store(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'id_kategori_pelanggaran' => 'required|exists:Tabel_Kategori_Pelanggaran,id_kategori_pelanggaran',
            'nama_sanksi' => 'required|string|max:255',
        ],
        [
            'id_kategori_pelanggaran.required' => 'Kategori Pelanggaran wajib diisi.',
            'id_kategori_pelanggaran.exists' => 'Kategori Pelanggaran tidak valid.',
            'nama_sanksi.required' => 'Nama Sanksi wajib diisi.',
            'nama_sanksi.string' => 'Nama Sanksi harus berupa teks.',
            'nama_sanksi.max' => 'Nama Sanksi maksimal 255 karakter.',
        ]);

        Sanksi::create($validatedData);

        return redirect('/sanksi-pelanggaran')->with('success', 'Sanksi Pelanggaran berhasil ditambahkan.')->with('kategori_id', $request->id_kategori_pelanggaran);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $sanksi = Sanksi::where('id_sanksi', $id)->first();

        $data = [
            'title' => 'Edit Sanksi Pelanggaran',
            'sanksi' => $sanksi,
            'kategori' => KategoriPelanggaran::all(),
        ];

        return view('admin.sanksiPelanggaran.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'id_kategori_pelanggaran' => 'required|exists:Tabel_Kategori_Pelanggaran,id_kategori_pelanggaran',
                'nama_sanksi' => 'required|string|max:255',
            ],
            [
                'id_kategori_pelanggaran.required' => 'Kategori Pelanggaran wajib diisi.',
                'id_kategori_pelanggaran.exists' => 'Kategori Pelanggaran tidak valid.',
                'nama_sanksi.required' => 'Nama Sanksi wajib diisi.',
                'nama_sanksi.string' => 'Nama Sanksi harus berupa teks.',
                'nama_sanksi.max' => 'Nama Sanksi maksimal 255 karakter.',
            ]);

            Sanksi::where('id_sanksi', $id)->update($validatedData);

            return redirect('/sanksi-pelanggaran')->with('success', 'Sanksi Pelanggaran berhasil diperbarui.')->with('kategori_id', $request->id_kategori_pelanggaran);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
