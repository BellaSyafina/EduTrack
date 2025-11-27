<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\InputSiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil ID wali murid
        $wali = $user->waliMurid;

        // Ambil daftar id siswa dari tabel pivot
        $anakIds = [];
        if ($user->role === 'Wali Murid' && $wali) {
            $anakIds = DB::table('Tabel_Wali_Murid_Siswa')->where('id_wali_murid', $wali->id_wali_murid)->pluck('id_siswa');
        }

        $laporan = InputSiswa::with(['siswa.kelas', 'pelanggaran', 'kepatuhan', 'user'])

            // Filter khusus WALI MURID → hanya data anaknya
            ->when($user->role === 'Wali Murid', function ($q) use ($anakIds) {
                $q->whereIn('id_siswa', $anakIds);
            })

            // Filter Wali Kelas → lihat data yang dia input
            ->when($user->role === 'Wali Kelas', function ($q) use ($user) {
                $q->where('id_user', $user->id);
            })

            // Filter pencarian
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('siswa', function ($s) use ($request) {
                    $s->where('nama_siswa', 'like', '%' . $request->search . '%')->orWhere('nis', 'like', '%' . $request->search . '%');
                });
            })

            // Filter kelas
            ->when($request->kelas, function ($q) use ($request) {
                $q->whereHas('siswa.kelas', function ($k) use ($request) {
                    $k->where('nama_kelas', $request->kelas);
                });
            })

            // Filter pelanggaran/kepatuhan
            ->when($request->jenis, function ($q) use ($request) {
                if ($request->jenis == 'pelanggaran') {
                    $q->whereNotNull('id_pelanggaran');
                } else {
                    $q->whereNotNull('id_kepatuhan');
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

    public function exportPDF(Request $request)
    {
        $laporan = InputSiswa::with(['siswa.kelas', 'pelanggaran', 'kepatuhan', 'user'])
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('siswa', function ($q) use ($request) {
                    $q->where('nama_siswa', 'like', '%' . $request->search . '%')->orWhere('nis', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->kelas, function ($query) use ($request) {
                $query->whereHas('siswa.kelas', function ($q) use ($request) {
                    $q->where('nama_kelas', $request->kelas);
                });
            })
            ->when($request->jenis, function ($query) use ($request) {
                if ($request->jenis == 'pelanggaran') {
                    $query->whereNotNull('id_pelanggaran');
                } elseif ($request->jenis == 'kepatuhan') {
                    $query->whereNotNull('id_kepatuhan');
                }
            })
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan'));

        return $pdf->download('laporan.pdf');
    }
}
