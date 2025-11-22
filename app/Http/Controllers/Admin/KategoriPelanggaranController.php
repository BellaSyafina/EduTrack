<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class KategoriPelanggaranController extends Controller
{
    public function index()
    {
        $lastNumber = KategoriPelanggaran::max('sampai_poin') ?? 0;
        $data = [
            'title' => 'Kategori Pelanggaran',
            'kategoriPelanggaran' => KategoriPelanggaran::all(),
            'nextNumber' => $lastNumber + 1,
        ];

        return view('admin.kategoriPelanggaran.index', $data);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nama_kategori' => 'required|string|max:100|unique:Tabel_Kategori_Pelanggaran,nama_kategori',
                    'dari_poin' => 'required|integer',
                    'sampai_poin' => 'required|integer',
                ],
                [
                    'nama_kategori.required' => 'Kategori pelanggaran wajib diisi.',
                    'nama_kategori.unique' => 'Kategori pelanggaran sudah terdaftar.',
                    'dari_poin.required' => 'Poin awal wajib diisi.',
                    'dari_poin.integer' => 'Poin awal harus berupa angka.',
                    'sampai_poin.required' => 'Poin akhir wajib diisi.',
                    'sampai_poin.integer' => 'Poin akhir harus berupa angka.',
                ],
            );

            // Simpan data kategori pelanggaran baru
            KategoriPelanggaran::create($validatedData);

            return redirect()->back()->with('success', 'Kategori pelanggaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function detail($id)
    {
        $kategori = KategoriPelanggaran::where('id_kategori_pelanggaran', $id)->first();
        $data = [
            'title' => 'Detail Kategori Pelanggaran',
            'kategori' => $kategori,
            'pelanggaran' => Pelanggaran::where('id_kategori_pelanggaran', $id)->get(),
        ];

        return view('admin.kategoriPelanggaran.detail', $data);
    }

    public function actionDetail(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nama_pelanggaran' => 'required|string|max:100',
                    'bobot_poin' => 'required|integer',
                ],
                [
                    'nama_pelanggaran.required' => 'Nama pelanggaran wajib diisi.',
                    'bobot_poin.required' => 'Poin wajib diisi.',
                    'bobot_poin.integer' => 'Poin harus berupa angka.',
                ],
            );

            // Simpan data pelanggaran baru
            $validatedData['id_kategori_pelanggaran'] = $id;
            Pelanggaran::create($validatedData);

            return redirect()->back()->with('success', 'Data pelanggaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function detailShow($kategoriId, $pelanggaranId)
    {
        $kategori = KategoriPelanggaran::where('id_kategori_pelanggaran', $kategoriId)->first();
        $pelanggaran = Pelanggaran::where('id_pelanggaran', $pelanggaranId)->first();
        $data = [
            'title' => 'Edit Bentuk Pelanggaran',
            'kategori' => $kategori,
            'pelanggaran' => $pelanggaran,
        ];

        return view('admin.kategoriPelanggaran.detailUpdate', $data);
    }

    public function detailUpdate(Request $request, $kategoriId, $pelanggaranId)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nama_pelanggaran' => 'required|string|max:100',
                    'bobot_poin' => 'required|integer',
                ],
                [
                    'nama_pelanggaran.required' => 'Nama pelanggaran wajib diisi.',
                    'bobot_poin.required' => 'Poin wajib diisi.',
                    'bobot_poin.integer' => 'Poin harus berupa angka.',
                ],
            );

            // Update data pelanggaran
            Pelanggaran::where('id_pelanggaran', $pelanggaranId)->update($validatedData);

            return redirect()
                ->route('kategori-pelanggaran.detail', ['id' => $kategoriId])
                ->with('success', 'Data pelanggaran berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function detailDestroy($kategoriId, $pelanggaranId)
    {
        try {
            // Hapus data pelanggaran
            Pelanggaran::where('id_pelanggaran', $pelanggaranId)->delete();

            return redirect()
                ->route('kategori-pelanggaran.detail', ['id' => $kategoriId])
                ->with('success', 'Data pelanggaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $kategori = KategoriPelanggaran::where('id_kategori_pelanggaran', $id)->first();
        $isLast = $kategori->id_kategori_pelanggaran === KategoriPelanggaran::max('id_kategori_pelanggaran');
        
        $data = [
            'title' => 'Edit Kategori Pelanggaran',
            'kategori' => $kategori,
            'isLast' => $isLast,
        ];

        return view('admin.kategoriPelanggaran.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nama_kategori' => 'required|string|max:100|unique:Tabel_Kategori_Pelanggaran,nama_kategori,' . $id . ',id_kategori_pelanggaran',
                ],
                [
                    'nama_kategori.required' => 'Kategori pelanggaran wajib diisi.',
                    'nama_kategori.unique' => 'Kategori pelanggaran sudah terdaftar.',
                ],
            );

            // Update data kategori pelanggaran
            KategoriPelanggaran::where('id_kategori_pelanggaran', $id)->update($validatedData);

            return redirect('/kategori-pelanggaran')->with('success', 'Data kategori pelanggaran berhasil diperbarui.');
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
            // Cek apakah kategori masih memiliki data pelanggaran
            $jumlahPelanggaran = Pelanggaran::where('id_kategori_pelanggaran', $id)->count();

            if ($jumlahPelanggaran > 0) {
                return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki data bentuk pelanggaran.');
            }

            // Jika tidak ada pelanggaran, baru hapus
            KategoriPelanggaran::where('id_kategori_pelanggaran', $id)->delete();

            return redirect('/kategori-pelanggaran')->with('success', 'Data kategori pelanggaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
                ]);
        }
    }
}
