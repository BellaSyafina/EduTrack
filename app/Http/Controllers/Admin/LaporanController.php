<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputSiswa;
use App\Models\Kelas;
use App\Models\Laporann;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); // ambil user login

        $laporan = InputSiswa::with(['siswa.kelas', 'pelanggaran', 'kepatuhan', 'user'])
            ->when($user->role === 'Wali Kelas', function ($q) use ($user) {
                // ✅ wali kelas hanya lihat data yang dia input
                $q->where('id_user', $user->id);
            })
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('siswa', function ($s) use ($request) {
                    $s->where('nama_siswa', 'like', '%' . $request->search . '%')->orWhere('nis', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->kelas, function ($q) use ($request) {
                $q->whereHas('siswa.kelas', function ($k) use ($request) {
                    $k->where('nama_kelas', $request->kelas);
                });
            })
            ->when($request->jenis, function ($q) use ($request) {
                if ($request->jenis == 'pelanggaran') {
                    $q->whereNotNull('pelanggaran_id');
                } elseif ($request->jenis == 'kepatuhan') {
                    $q->whereNotNull('kepatuhan_id');
                }
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('admin.laporan.index', [
            'title' => 'Laporan',
            'kelas' => Kelas::all(),
            'laporan' => $laporan,
            'no' => ($laporan->currentPage() - 1) * $laporan->perPage() + 1,
        ]);
    }
}
