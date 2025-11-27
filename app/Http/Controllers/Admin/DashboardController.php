<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\InputSiswa;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\WaliMurid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $siswa = Siswa::all();
            $kelas = Kelas::all();
            $guru = Guru::all();
            $waliMurid = WaliMurid::all();
            // Pelanggaran per bulan
            $pelanggaranPerBulan = DB::table('Tabel_Input_Siswa')->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')->whereNotNull('id_pelanggaran')->groupBy('bulan')->pluck('total', 'bulan')->toArray();

            // Format 12 bulan (Jan–Des)
            $dataPelanggaran = [];
            for ($i = 1; $i <= 12; $i++) {
                $dataPelanggaran[] = $pelanggaranPerBulan[$i] ?? 0;
            }

            // Kepatuhan per bulan
            $kepatuhanPerBulan = DB::table('Tabel_Input_Siswa')->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')->whereNotNull('id_kepatuhan')->groupBy('bulan')->pluck('total', 'bulan')->toArray();

            // Format 12 bulan (Jan–Des)
            $dataKepatuhan = [];
            for ($i = 1; $i <= 12; $i++) {
                $dataKepatuhan[] = $kepatuhanPerBulan[$i] ?? 0;
            }

            // Pelanggaran terbaru hari ini
            $pelanggaranTerbaru = InputSiswa::with(['siswa', 'pelanggaran'])
                ->whereNotNull('id_pelanggaran')
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->limit(5)
                ->get();

            // Kepatuhan terbaru hari ini
            $kepatuhanTerbaru = InputSiswa::with(['siswa', 'kepatuhan'])
                ->whereNotNull('id_kepatuhan')
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->limit(5)
                ->get();
        } elseif (Auth::user()->role == 'Wali Kelas') {
            // Ambil kelas yang dipegang wali kelas
            $wali = WaliKelas::where('id_user', Auth::id())->first();
            // dd($wali);
            if ($wali) {
                $idKelas = $wali->id_kelas;

                $pelanggaranPerBulanWaliKelas = DB::table('Tabel_Input_Siswa')->join('Tabel_Siswa', 'Tabel_Input_Siswa.id_siswa', '=', 'Tabel_Siswa.id_siswa')->selectRaw('MONTH(Tabel_Input_Siswa.created_at) as bulan, COUNT(*) as total')->whereNotNull('Tabel_Input_Siswa.id_pelanggaran')->where('Tabel_Siswa.id_kelas', $idKelas)->groupBy('bulan')->pluck('total', 'bulan')->toArray();
                // dd($pelanggaranPerBulanWaliKelas);

                // Buat format 12 bulan
                $dataPelanggaranWaliKelas = [];
                for ($i = 1; $i <= 12; $i++) {
                    $dataPelanggaranWaliKelas[] = $pelanggaranPerBulanWaliKelas[$i] ?? 0;
                }
            } else {
                // jika wali kelas belum dikaitkan ke kelas
                $dataPelanggaranWaliKelas = array_fill(0, 12, 0);
            }
        }

        $data = [
            'title' => 'Dashboard',
            'totalSiswa' => isset($siswa) ? $siswa->count() : 0,
            'totalKelas' => isset($kelas) ? $kelas->count() : 0,
            'totalGuru' => isset($guru) ? $guru->count() : 0,
            'totalWaliMurid' => isset($waliMurid) ? $waliMurid->count() : 0,
            'dataPelanggaran' => $dataPelanggaran ?? [],
            'dataKepatuhan' => $dataKepatuhan ?? [],
            'pelanggaranTerbaru' => $pelanggaranTerbaru ?? [],
            'kepatuhanTerbaru' => $kepatuhanTerbaru ?? [],
            'dataPelanggaranWaliKelas' => $dataPelanggaranWaliKelas ?? [],
        ];

        return view('admin.dashboard.index', $data);
    }
}
