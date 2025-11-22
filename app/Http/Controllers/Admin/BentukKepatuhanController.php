<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKepatuhan;
use App\Models\Kepatuhan;
use Illuminate\Http\Request;

class BentukKepatuhanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Bentuk Kepatuhan',
            'kategori' => KategoriKepatuhan::with('kepatuhan')->get(),
        ];

        return view('admin.bentukKepatuhan.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Bentuk Kepatuhan',
            'kategori' => KategoriKepatuhan::all(),
        ];

        return view('admin.bentukKepatuhan.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(
                [
                    'id_kategori_kepatuhan' => 'required|exists:Tabel_Kategori_Kepatuhan,id_kategori_kepatuhan',
                    'nama_kepatuhan' => 'required|string|max:255',
                    'bobot_poin' => 'required|integer|min:0',
                    'penghargaan' => 'nullable|string|max:255',
                ],
                [
                    'id_kategori_kepatuhan.required' => 'Kategori Kepatuhan wajib diisi.',
                    'id_kategori_kepatuhan.exists' => 'Kategori Kepatuhan tidak valid.',
                    'nama_kepatuhan.required' => 'Nama Kepatuhan wajib diisi.',
                    'bobot_poin.required' => 'Bobot Poin wajib diisi.',
                    'bobot_poin.integer' => 'Bobot Poin harus berupa angka.',
                    'bobot_poin.min' => 'Bobot Poin tidak boleh kurang dari 0.',
                ],
            );

            Kepatuhan::create($validatedData);

            return redirect('/bentuk-kepatuhan')->with('success', 'Bentuk Kepatuhan berhasil ditambahkan!')->with('kategori_id', $request->id_kategori_kepatuhan);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $bentukKepatuhan = Kepatuhan::findOrFail($id);

        $data = [
            'title' => 'Update Bentuk Kepatuhan',
            'bentukKepatuhan' => $bentukKepatuhan,
        ];

        return view('admin.bentukKepatuhan.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
        $bentukKepatuhan = Kepatuhan::where('id_kepatuhan', $id)->firstOrFail();

        $validatedData = $request->validate(
            [
                'nama_kepatuhan' => 'required|string|max:255',
                'bobot_poin' => 'required|integer|min:0',
                'penghargaan' => 'nullable|string|max:255',
            ],
            [
                'nama_kepatuhan.required' => 'Nama Kepatuhan wajib diisi.',
                'bobot_poin.required' => 'Bobot Poin wajib diisi.',
                'bobot_poin.integer' => 'Bobot Poin harus berupa angka.',
                'bobot_poin.min' => 'Bobot Poin tidak boleh kurang dari 0.',
            ],
        );

        $bentukKepatuhan->update($validatedData);

        return redirect('/bentuk-kepatuhan')->with('success', 'Bentuk Kepatuhan berhasil diperbarui!')->with('kategori_id', $request->id_kategori_kepatuhan);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $bentukKepatuhan = Kepatuhan::where('id_kepatuhan', $id)->firstOrFail();
            $kategoriId = $bentukKepatuhan->id_kategori_kepatuhan;
            $bentukKepatuhan->delete();

            return redirect('/bentuk-kepatuhan')->with('success', 'Bentuk Kepatuhan berhasil dihapus!')->with('kategori_id', $kategoriId);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
