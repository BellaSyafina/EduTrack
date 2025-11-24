<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputSiswa;
use App\Models\KategoriKepatuhan;
use App\Models\Kelas;
use App\Models\Kepatuhan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputKepatuhanController extends Controller
{
    public function index()
    {
        $id = Auth::id(); // lebih ringkas

        $data = [
            'title' => 'Input Kepatuhan Siswa',
            'kelas' => Kelas::all(),
            'kategori' => KategoriKepatuhan::with('kepatuhan')->get(),
            'inputKepatuhan' => InputSiswa::with(['siswa', 'kepatuhan', 'user'])
                ->where('id_user', $id)
                ->whereNotNull('id_kepatuhan') // ✅ hanya data kepatuhan
                ->get(),
            'no' => 1,
        ];

        return view('admin.inputKepatuhan.index', $data);
    }

    public function getByKategori($id)
    {
        $data = Kepatuhan::where('id_kategori_kepatuhan', $id)->select('id_kepatuhan', 'nama_kepatuhan', 'bobot_poin')->get();

        return response()->json($data);
    }

    public function getSiswa($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return response()->json([
                'status' => false,
            ]);
        }

        return response()->json([
            'status' => true,
            'nama_siswa' => $siswa->nama_siswa,
            'kelas' => $siswa->kelas->nama_kelas ?? null, // kalau pakai relasi
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'nis' => 'required|exists:Tabel_Siswa,nis',
                    'bentuk_kepatuhan' => 'required|exists:Tabel_Kepatuhan,id_kepatuhan',
                    'tanggal_waktu' => 'required|date',
                ],
                [
                    'nis.required' => 'NIS wajib diisi.',
                    'nis.exists' => 'NIS tidak ditemukan.',
                    'bentuk_kepatuhan.required' => 'Bentuk Kepatuhan wajib diisi.',
                    'bentuk_kepatuhan.exists' => 'Bentuk Kepatuhan tidak valid.',
                    'tanggal_waktu.required' => 'Tanggal dan Waktu wajib diisi.',
                    'tanggal_waktu.date' => 'Format Tanggal dan Waktu tidak valid.',
                ],
            );

            $siswa = Siswa::where('nis', $request->nis)->first();

            if (!$siswa) {
                return back()
                    ->withErrors(['nis' => 'NIS tidak ditemukan.'])
                    ->withInput();
            }

            $kepatuhan = Kepatuhan::find($request->bentuk_kepatuhan);

            InputSiswa::create([
                'id_siswa' => $siswa->id_siswa,
                'id_user' => Auth::user()->id,
                'id_kepatuhan' => $kepatuhan->id_kepatuhan,
                'bobot_poin' => $kepatuhan->bobot_poin,
                'created_at' => $request->tanggal_waktu,
            ]);

            return redirect('/input-kepatuhan')->with('success', 'Data Kepatuhan Siswa berhasil disimpan!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $inputKepatuhan = InputSiswa::where('id_input_siswa', $id)->firstOrFail();
            $inputKepatuhan->delete();

            return redirect('/input-kepatuhan')->with('success', 'Data Kepatuhan Siswa berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
