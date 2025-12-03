<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\InputSiswa;
use App\Models\Kelas;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil data wali murid (jika user = wali murid)
        $wali = $user->waliMurid;

        // Ambil daftar id siswa milik wali murid dari pivot
        $anakIds = [];
        if ($user->role === 'Wali Murid' && $wali) {
            $anakIds = DB::table('Tabel_Wali_Murid_Siswa')->where('id_wali_murid', $wali->id_wali_murid)->pluck('id_siswa');
        }

        // Ambil wali kelas untuk menentukan kelas yang dia pegang
        $walikelas = WaliKelas::where('id_user', Auth::id())->first();
        $kelasWaliId = $walikelas ? $walikelas->id_kelas : null;

        $laporan = InputSiswa::with(['siswa.kelas', 'pelanggaran', 'kepatuhan', 'user'])

            // **Jika role Wali Murid → tampilkan hanya data anaknya**
            ->when($user->role === 'Wali Murid', function ($q) use ($anakIds) {
                $q->whereIn('id_siswa', $anakIds);
            })

            // **Jika role Wali Kelas → tampilkan hanya data siswa di kelas wali**
            ->when($user->role === 'Wali Kelas', function ($q) use ($kelasWaliId) {
                $q->whereHas('siswa', function ($s) use ($kelasWaliId) {
                    $s->where('id_kelas', $kelasWaliId);
                });
            })

            // Filter pencarian siswa
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

            // Filter jenis laporan (pelanggaran / kepatuhan)
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
        $user = Auth::user();

        // Ambil data wali murid (jika user = wali murid)
        $wali = $user->waliMurid;

        // Ambil daftar id siswa milik wali murid dari pivot
        $anakIds = [];
        if ($user->role === 'Wali Murid' && $wali) {
            $anakIds = DB::table('Tabel_Wali_Murid_Siswa')->where('id_wali_murid', $wali->id_wali_murid)->pluck('id_siswa');
        }

        // Ambil wali kelas untuk menentukan kelas yang dia pegang
        $walikelas = WaliKelas::where('id_user', Auth::id())->first();
        $kelasWaliId = $walikelas ? $walikelas->id_kelas : null;

        $laporan = InputSiswa::with(['siswa.kelas', 'pelanggaran', 'kepatuhan', 'user'])

            // **Jika role Wali Murid → tampilkan hanya data anaknya**
            ->when($user->role === 'Wali Murid', function ($q) use ($anakIds) {
                $q->whereIn('id_siswa', $anakIds);
            })

            // **Jika role Wali Kelas → tampilkan hanya data siswa di kelas wali**
            ->when($user->role === 'Wali Kelas', function ($q) use ($kelasWaliId) {
                $q->whereHas('siswa', function ($s) use ($kelasWaliId) {
                    $s->where('id_kelas', $kelasWaliId);
                });
            })

            // Filter pencarian siswa
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

            // Filter jenis laporan (pelanggaran / kepatuhan)
            ->when($request->jenis, function ($q) use ($request) {
                if ($request->jenis == 'pelanggaran') {
                    $q->whereNotNull('id_pelanggaran');
                } else {
                    $q->whereNotNull('id_kepatuhan');
                }
            })

            ->latest()
            ->get();

        $pdf = PDF::loadView('admin.laporan.pdf', [
            'laporan' => $laporan,
            'title' => 'Laporan',
        ]);

        // PREVIEW DI TAB BARU
        return $pdf->stream('laporan.pdf');
    }
}
