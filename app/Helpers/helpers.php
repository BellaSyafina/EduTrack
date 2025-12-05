<?php

use App\Models\InputSiswa;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Support\Facades\Auth;

function getNotif()
{
    $user = Auth::user();

    // ========== ADMIN ==========
    if ($user->role == 'Admin') {
        return InputSiswa::with(['siswa', 'pelanggaran', 'kepatuhan'])
            ->latest()
            ->take(4)
            ->get();
    }

    // ========== WALI KELAS ==========
    if ($user->role == 'Wali Kelas') {
        // Ambil wali kelas berdasarkan id_user (yang benar)
        $waliKelas = WaliKelas::where('id_user', $user->id)->first();

        if (!$waliKelas) return collect();

        // Ambil semua siswa di kelas tersebut
        $idSiswa = Siswa::where('id_kelas', $waliKelas->id_kelas)
            ->pluck('id_siswa');

        return InputSiswa::with(['siswa', 'pelanggaran', 'kepatuhan'])
            ->whereIn('id_siswa', $idSiswa)
            ->latest()
            ->take(4)
            ->get();
    }

    // ========== WALI MURID ==========
    if ($user->role == 'Wali Murid') {

        if (!$user->waliMurid) return collect();

        // Ambil semua id siswa dari tabel wali_murid_siswa
        $id_siswa = $user->waliMurid->waliMuridSiswa->pluck('id_siswa');

        return InputSiswa::with(['siswa', 'pelanggaran', 'kepatuhan'])
            ->whereIn('id_siswa', $id_siswa)
            ->latest()
            ->take(5)
            ->get();
    }

    return collect();
}

function getNotifCount()
{
    $user = Auth::user();

    if ($user->role == 'Admin') {
        return InputSiswa::count();
    }

    if ($user->role == 'Wali Kelas') {
        $id_kelas = $user->waliKelas->id_kelas;

        $id_siswa = Siswa::where('id_kelas', $id_kelas)->pluck('id_siswa');

        return InputSiswa::whereIn('id_siswa', $id_siswa)->count();
    }

    if ($user->role == 'Wali Murid') {
        $id_siswa = $user->waliMurid->siswa->pluck('id_siswa');

        return InputSiswa::whereIn('id_siswa', $id_siswa)->count();
    }

    return 0;
}
