<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputSiswa;
use App\Models\KategoriPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputPelanggaranController extends Controller
{
    public function index()
    {
        $id = Auth::id(); // lebih ringkas

        $data = [
            'title' => 'Input Pelanggaran Siswa',
            'kelas' => Kelas::all(),
            'kategori' => KategoriPelanggaran::with('pelanggaran')->get(),
            'inputPelanggaran' => InputSiswa::with(['siswa', 'pelanggaran', 'user'])
                ->where('id_user', $id)
                ->whereNotNull('id_pelanggaran') // ✅ hanya data pelanggaran
                ->get(),
            'no' => 1,
        ];

        return view('admin.inputPelanggaran.index', $data);
    }

    public function getByKategori($id)
    {
        $data = Pelanggaran::where('id_kategori_pelanggaran', $id)->select('id_pelanggaran', 'nama_pelanggaran', 'bobot_poin')->get();

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
                    'bentuk_pelanggaran' => 'required|exists:Tabel_Pelanggaran,id_pelanggaran',
                    'tanggal_waktu' => 'required|date',
                ],
                [
                    'nis.required' => 'NIS wajib diisi.',
                    'nis.exists' => 'NIS tidak ditemukan.',
                    'bentuk_pelanggaran.required' => 'Bentuk Pelanggaran wajib diisi.',
                    'bentuk_pelanggaran.exists' => 'Bentuk Pelanggaran tidak valid.',
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

            $pelanggaran = Pelanggaran::find($request->bentuk_pelanggaran);

            InputSiswa::create([
                'id_siswa' => $siswa->id_siswa,
                'id_user' => Auth::id(),
                'id_pelanggaran' => $pelanggaran->id_pelanggaran,
                'bobot_poin' => $pelanggaran->bobot_poin,
                'created_at' => $request->tanggal_waktu,
            ]);

            return redirect('/input-pelanggaran')->with('success', 'Data Pelanggaran Siswa berhasil disimpan!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $inputPelanggaran = InputSiswa::where('id_input_siswa', $id)->firstOrFail();
            $inputPelanggaran->delete();

            return redirect('/input-pelanggaran')->with('success', 'Data Pelanggaran Siswa berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
