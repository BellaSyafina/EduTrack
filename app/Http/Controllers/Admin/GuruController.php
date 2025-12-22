<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\GuruImport;
use App\Models\Guru;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function index()
    {
        $data = [
            'guru' => Guru::all(),
            'title' => 'Data Guru',
        ];

        return view('admin.dataGuru.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Guru',
        ];

        return view('admin.dataGuru.create', $data);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nuptk' => 'required|unique:Tabel_Guru,nuptk|max:50',
                    'nip' => 'required|unique:Tabel_Guru,nip|max:20',
                    'nama_guru' => 'required|string|max:100',
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'jabatan' => 'required|string|max:50',
                    'alamat' => 'required|string',
                ],
                [
                    'nuptk.unique' => 'NUPTK sudah terdaftar.',
                    'nuptk.required' => 'NUPTK wajib diisi.',
                    'nuptk.max' => 'NUPTK maksimal 50 karakter.',
                    'nip.required' => 'NIP wajib diisi.',
                    'nip.unique' => 'NIP sudah terdaftar.',
                    'nama_guru.required' => 'Nama guru wajib diisi.',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                    'jabatan.required' => 'Jabatan wajib diisi.',
                    'alamat.required' => 'Alamat wajib diisi.',
                ],
            );

            // Simpan data guru baru
            Guru::create($validatedData);

            return redirect('/guru')->with('success', 'Data guru berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show($id)
    {
        $guru = Guru::where('id_guru', $id)->first();

        $data = [
            'title' => 'Edit Guru',
            'guru' => $guru,
        ];

        return view('admin.dataGuru.update', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate(
                [
                    'nuptk' => 'required|max:50|unique:Tabel_Guru,nuptk,' . $id . ',id_guru',
                    'nip' => 'required|max:20|unique:Tabel_Guru,nip,' . $id . ',id_guru',
                    'nama_guru' => 'required|string|max:100',
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'jabatan' => 'required|string|max:50',
                    'alamat' => 'required|string',
                ],
                [
                    'nuptk.unique' => 'NUPTK sudah terdaftar.',
                    'nuptk.required' => 'NUPTK wajib diisi.',
                    'nuptk.max' => 'NUPTK maksimal 50 karakter.',
                    'nip.required' => 'NIP wajib diisi.',
                    'nip.unique' => 'NIP sudah terdaftar.',
                    'nama_guru.required' => 'Nama guru wajib diisi.',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                    'jabatan.required' => 'Jabatan wajib diisi.',
                    'alamat.required' => 'Alamat wajib diisi.',
                ],
            );

            // Update data guru
            Guru::where('id_guru', $id)->update($validatedData);

            return redirect('/guru')->with('success', 'Data guru berhasil diperbarui.');
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
            // Hapus data guru
            Guru::where('id_guru', $id)->delete();

            return redirect('/guru')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ],
        [
            'file.required' => 'File wajib diunggah.',
            'file.mimes' => 'Format file harus berupa xls atau xlsx.',
        ]);

        try {
            Excel::import(new GuruImport, $request->file('file'));

            return back()->with('success', 'Data guru berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
