<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // ================= HANDLE KELAS =================
        $kelasNama = trim($row['kelas'] ?? '');

        $kelasNama = str_ireplace('kelas', '', $kelasNama);
        $kelasNama = trim($kelasNama);

        $kelas = Kelas::whereRaw('LOWER(TRIM(nama_kelas)) = ?', [strtolower($kelasNama)])
            ->orWhereRaw('LOWER(TRIM(nama_kelas)) = ?', [strtolower('Kelas ' . $kelasNama)])
            ->first();

        if (!$kelas) {
            logger()->error('Kelas tidak ditemukan', ['kelas_excel' => $row['kelas']]);
            return null;
        }

        // ================= HANDLE JENIS KELAMIN =================
        $gender = strtoupper(trim($row['jenis_kelamin'] ?? ''));
        $jenisKelamin = $gender === 'L' ? 'Laki-laki' : ($gender === 'P' ? 'Perempuan' : null);

        // ================= HANDLE STATUS =================
        $status = strtoupper(trim($row['status'] ?? 'Aktif'));
        $statusSiswa = $status === 'NONAKTIF' ? 'Nonaktif' : 'Aktif';

        return new Siswa([
            'nisn' => $row['nisn'],
            'nis' => $row['nis'],
            'nama_siswa' => $row['nama_siswa'],
            'jenis_kelamin' => $jenisKelamin,
            'alamat' => $row['alamat'],
            'status' => $statusSiswa,
            'id_kelas' => $kelas->id_kelas,
        ]);
    }
}
