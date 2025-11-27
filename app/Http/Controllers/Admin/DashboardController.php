<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\InputSiswa;
use App\Models\Kelas;
use App\Models\Kepatuhan;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\WaliMurid;
use App\Models\WaliMuridSiswa;
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

            $pelanggaranTerbaruWaliKelas = InputSiswa::with(['siswa', 'pelanggaran'])
                ->whereNotNull('id_pelanggaran')
                ->whereHas('siswa', function ($query) use ($wali) {
                    $query->where('id_kelas', $wali->id_kelas);
                })
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->limit(5)
                ->get();

            $kepatuhanTerbaruWaliKelas = InputSiswa::with(['siswa', 'kepatuhan'])
                ->whereNotNull('id_kepatuhan')
                ->whereHas('siswa', function ($query) use ($wali) {
                    $query->where('id_kelas', $wali->id_kelas);
                })
                ->whereDate('created_at', Carbon::today())
                ->latest()
                ->limit(5)
                ->get();

            // dd($pelanggaranTerbaruWaliKelas);
        } elseif (Auth::user()->role == 'Wali Murid') {
            // Ambil data wali murid sesuai user login
            $waliMurid = WaliMurid::where('id_user', Auth::id())->first();

            // Ambil semua relasi WaliMuridSiswa + data siswa + kelas
            $siswaList = WaliMuridSiswa::with(['siswa.kelas'])
                ->where('id_wali_murid', $waliMurid->id_wali_murid)
                ->get();

            // Hitung total pelanggaran & kepatuhan untuk semua anak
            $totalPelanggaranWaliMurid = 0;
            $totalKepatuhanWaliMurid = 0;

            foreach ($siswaList as $item) {
                $totalPelanggaranWaliMurid += InputSiswa::where('id_siswa', $item->id_siswa)->count();
                $totalKepatuhanWaliMurid += InputSiswa::where('id_siswa', $item->id_siswa)->count();
            }

            $riwayatPelanggaran = InputSiswa::with(['siswa', 'pelanggaran'])
                ->whereNotNull('id_pelanggaran')
                ->whereIn('id_siswa', $siswaList->pluck('id_siswa'))
                ->latest()
                ->limit(5)
                ->get();

            $riwayatKepatuhan = InputSiswa::with(['siswa', 'kepatuhan'])
                ->whereNotNull('id_kepatuhan')
                ->whereIn('id_siswa', $siswaList->pluck('id_siswa'))
                ->latest()
                ->limit(5)
                ->get();
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
            'pelanggaranTerbaruWaliKelas' => $pelanggaranTerbaruWaliKelas ?? [],
            'kepatuhanTerbaruWaliKelas' => $kepatuhanTerbaruWaliKelas ?? [],
            'siswaList' => $siswaList ?? [],
            'totalPelanggaranWaliMurid' => $totalPelanggaranWaliMurid ?? 0,
            'totalKepatuhanWaliMurid' => $totalKepatuhanWaliMurid ?? 0,
            'riwayatPelanggaran' => $riwayatPelanggaran ?? [],
            'riwayatKepatuhan' => $riwayatKepatuhan ?? [],
        ];

        return view('admin.dashboard.index', $data);
    }
}
