<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKepatuhan;
use App\Models\Kepatuhan;
use Illuminate\Http\Request;

class KategoriKepatuhanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Kepatuhan',
            'kategoriKepatuhan' => KategoriKepatuhan::all(),
        ];

        return view('admin.kategoriKepatuhan.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'nama_kategori' => 'required|string|max:255|unique:Tabel_Kategori_Kepatuhan,nama_kategori',
                ],
                [
                    'nama_kategori.required' => 'Nama kategori kepatuhan wajib diisi.',
                    'nama_kategori.unique' => 'Nama kategori kepatuhan sudah ada.',
                ],
            );

            KategoriKepatuhan::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect()->back()->with('success', 'Kategori kepatuhan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menambahkan kategori kepatuhan: ' . $e->getMessage()]);
        }
    }

    public function detail($id)
    {
        $kategori = KategoriKepatuhan::where('id_kategori_kepatuhan', $id)->first();

        $data = [
            'title' => 'Detail Kategori Kepatuhan',
            'kategori' => $kategori,
            'kepatuhan' => Kepatuhan::where('id_kategori_kepatuhan', $id)->get(),
        ];

        return view('admin.kategoriKepatuhan.detail', $data);
    }

    public function detailStore(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'nama_kepatuhan' => 'required|string|max:255',
                    'bobot_poin' => 'required|integer|min:0',
                ],
                [
                    'nama_kepatuhan.required' => 'Nama kepatuhan wajib diisi.',
                    'bobot_poin.required' => 'Bobot poin wajib diisi.',
                ],
            );

            Kepatuhan::create([
                'id_kategori_kepatuhan' => $id,
                'nama_kepatuhan' => $request->nama_kepatuhan,
                'bobot_poin' => $request->bobot_poin,
            ]);

            return redirect()->back()->with('success', 'Bentuk kepatuhan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menambahkan bentuk kepatuhan: ' . $e->getMessage()]);
        }
    }

    public function detailDestroy($kategoriId, $id)
    {
        try {
            $kepatuhan = Kepatuhan::where('id_kepatuhan', $id)->first();

            if (!$kepatuhan) {
                return redirect()->back()->withErrors(['error' => 'Bentuk kepatuhan tidak ditemukan.']);
            }

            $kepatuhan->delete();

            return redirect()->back()->with('success', 'Bentuk kepatuhan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus bentuk kepatuhan: ' . $e->getMessage()]);
        }
    }

    public function detailEdit($kategoriId, $id)
    {
        $kategori = KategoriKepatuhan::where('id_kategori_kepatuhan', $kategoriId)->first();
        $kepatuhan = Kepatuhan::where('id_kepatuhan', $id)->first();

        $data = [
            'title' => 'Edit Bentuk Kepatuhan',
            'kategori' => $kategori,
            'kepatuhan' => $kepatuhan,
        ];

        return view('admin.kategoriKepatuhan.detailUpdate', $data);
    }

    public function detailUpdate(Request $request, $kategoriId, $id)
    {
        try {
            $request->validate(
                [
                    'nama_kepatuhan' => 'required|string|max:255',
                    'bobot_poin' => 'required|integer|min:0',
                ],
                [
                    'nama_kepatuhan.required' => 'Nama kepatuhan wajib diisi.',
                    'bobot_poin.required' => 'Bobot poin wajib diisi.',
                ],
            );

            $kepatuhan = Kepatuhan::where('id_kepatuhan', $id)->first();

            if (!$kepatuhan) {
                return redirect()->back()->withErrors(['error' => 'Bentuk kepatuhan tidak ditemukan.']);
            }

            $kepatuhan->update([
                'nama_kepatuhan' => $request->nama_kepatuhan,
                'bobot_poin' => $request->bobot_poin,
            ]);

            return redirect()
                ->route('kategori-kepatuhan.detail', $kategoriId)
                ->with('success', 'Bentuk kepatuhan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui bentuk kepatuhan: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $kategori = KategoriKepatuhan::where('id_kategori_kepatuhan', $id)->first();

        $data = [
            'title' => 'Edit Kategori Kepatuhan',
            'kategoriKepatuhan' => $kategori,
        ];

        return view('admin.kategoriKepatuhan.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'nama_kategori' => 'required|string|max:255|unique:Tabel_Kategori_Kepatuhan,nama_kategori,' . $id . ',id_kategori_kepatuhan',
                ],
                [
                    'nama_kategori.required' => 'Nama kategori kepatuhan wajib diisi.',
                    'nama_kategori.unique' => 'Nama kategori kepatuhan sudah ada.',
                ],
            );

            $kategori = KategoriKepatuhan::where('id_kategori_kepatuhan', $id)->first();

            if (!$kategori) {
                return redirect()->back()->withErrors(['error' => 'Kategori kepatuhan tidak ditemukan.']);
            }

            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect('/kategori-kepatuhan')->with('success', 'Kategori kepatuhan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui kategori kepatuhan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $jumlahKepatuhan = Kepatuhan::where('id_kategori_kepatuhan', $id)->count();

            if ($jumlahKepatuhan > 0) {
                return redirect()
                    ->back()
                    ->with('error', 'Kategori kepatuhan tidak dapat dihapus karena masih memiliki bentuk kepatuhan terkait.');
            }

            $kategori = KategoriKepatuhan::where('id_kategori_kepatuhan', $id)->first();

            if (!$kategori) {
                return redirect('/kategori-kepatuhan')->withErrors(['error' => 'Kategori kepatuhan tidak ditemukan.']);
            }

            $kategori->delete();

            return redirect('/kategori-kepatuhan')->with('success', 'Kategori kepatuhan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus kategori kepatuhan: ' . $e->getMessage()]);
        }
    }
}
