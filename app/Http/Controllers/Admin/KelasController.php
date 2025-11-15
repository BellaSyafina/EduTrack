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
        // Validasi input
        $validatedData = $request->validate(
            [
                'nama_kelas' => 'required|string|max:100',
            ],

            [
                'nama_kelas.required' => 'Nama kelas wajib diisi.',
            ]
        );

        // Simpan data kelas baru
        Kelas::create($validatedData);

        return redirect('/kelas')->with('success', 'Data kelas berhasil ditambahkan.');
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
        // Validasi input
        $validatedData = $request->validate(
            [
                'nama_kelas' => 'required|string|max:100',
            ],

            [
                'nama_kelas.required' => 'Nama kelas wajib diisi.',
            ]
        );

        // Update data kelas
        Kelas::where('id_kelas', $id)->update($validatedData);

        return redirect('/kelas')->with('success', 'Data Kelas berhasil diperbarui.');
    }
}
