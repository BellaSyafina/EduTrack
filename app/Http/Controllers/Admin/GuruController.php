<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

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
        // Validasi input
        $validatedData = $request->validate([
            'nip' => 'required|unique:Tabel_Guru,nip|max:20',
            'nama_guru' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:50',
            'alamat' => 'required|string',
        ],
        [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        // Simpan data guru baru
        Guru::create($validatedData);

        return redirect('/guru')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function show()
    {
        $data = [
            'title' => 'Edit Guru',
        ];

        return view('admin.dataGuru.update', $data);
    }
}
