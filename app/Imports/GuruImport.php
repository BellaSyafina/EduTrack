<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Mapping jenis kelamin
        $gender = strtoupper(trim($row['jenis_kelamin'] ?? ''));
        $jenisKelamin = $gender === 'L' ? 'Laki-laki' : ($gender === 'P' ? 'Perempuan' : null);

        return new Guru([
            'nuptk' => $row['nuptk'] ?? null,
            'nip' => $row['nip'] ?? null,
            'nama_guru' => $row['nama_guru'] ?? null,
            'jenis_kelamin' => $jenisKelamin,
            'jabatan' => $row['jabatan'] ?? null,
            'alamat' => $row['alamat'] ?? null,
        ]);
    }
}
