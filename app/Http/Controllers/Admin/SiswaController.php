<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliMurid;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with('kelas');

        // FILTER KELAS
        if ($request->kelas) {
            $query->where('id_kelas', $request->kelas);
        }

        $data = [
            'title' => 'Data Siswa',
            'siswa' => $query->get(),
            'kelas' => Kelas::all(),
        ];

        return view('admin.dataSiswa.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Siswa',
            'kelas' => Kelas::all(),
        ];

        return view('admin.dataSiswa.create', $data);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nis' => 'required|unique:Tabel_Siswa,nis|max:20',
                    'nama_siswa' => 'required|string|max:100',
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'id_kelas' => 'required|exists:Tabel_Kelas,id_kelas',
                    'alamat' => 'required|string',
                    'status' => 'required|in:Aktif,Nonaktif',
                ],
                [
                    'nis.required' => 'NIS wajib diisi.',
                    'nis.unique' => 'NIS sudah terdaftar.',
                    'nama_siswa.required' => 'Nama siswa wajib diisi.',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                    'id_kelas.required' => 'Kelas wajib dipilih.',
                    'alamat.required' => 'Alamat wajib diisi.',
                ],
            );

            // Simpan data siswa baru
            Siswa::create($validatedData);

            return redirect('/siswa')->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::where('id_siswa', $id)->first();

        $data = [
            'title' => 'Edit Siswa',
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
            'waliMurid' => WaliMurid::all(),
        ];

        return view('admin.dataSiswa.update', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nis' => 'required|max:20|unique:Tabel_Siswa,nis,' . $id . ',id_siswa',
                    'nama_siswa' => 'required|string|max:100',
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'id_kelas' => 'required|exists:Tabel_Kelas,id_kelas',
                    'id_wali_murid' => 'required|exists:Tabel_Wali_Murid,id_wali_murid',
                    'alamat' => 'required|string',
                    'status' => 'required|in:Aktif,Nonaktif',
                ],
                [
                    'nis.required' => 'NIS wajib diisi.',
                    'nis.unique' => 'NIS sudah terdaftar.',
                    'nama_siswa.required' => 'Nama siswa wajib diisi.',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                    'id_kelas.required' => 'Kelas wajib dipilih.',
                    'id_wali_murid.required' => 'Wali murid wajib dipilih.',
                    'alamat.required' => 'Alamat wajib diisi.',
                ],
            );

            // Update data siswa
            Siswa::where('id_siswa', $id)->update($validatedData);

            return redirect('/siswa')->with('success', 'Data siswa berhasil diperbarui.');
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
            // Hapus data siswa
            Siswa::where('id_siswa', $id)->delete();

            return redirect('/siswa')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
